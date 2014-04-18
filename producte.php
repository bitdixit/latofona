
<?
	include_once("capcelera_segura.php");
	include_once("Membre.php");
	include_once("Proveidor.php");
	include_once("Producte.php");

	$smartyObj = new Smarty;
	$smartyObj -> assign("membre", $_SESSION["membre"]);
	$smartyObj -> assign("dia", get_current_date());

	$provid =  $_REQUEST["provid"];
	$proveidor =  Proveidor::getById($_REQUEST["provid"]);
	$smartyObj -> assign("provnom", $proveidor["provnom"] );
	$smartyObj -> assign("provid", $provid );


		if($_REQUEST["action"] == "add"){
			$smartyObj -> assign("action", "create");
			$smartyObj -> assign("provs",Proveidor::getAll());
			$smartyObj -> assign("provid",$_REQUEST["provid"]);
			$smartyObj -> assign("message","omple els camps per afegir un nou producte...");
			$smartyObj -> display("producte.tpl");
		}
		else if ($_REQUEST["action"] == "create") {
			if(($_REQUEST["prodnom"] != "") && ($_REQUEST["prodpreu"] != "")) {
				if(Producte::create($_REQUEST["prodprov"],$_REQUEST["prodnom"],$_REQUEST["prodcode"],$_REQUEST["prodpreuinicial"],$_REQUEST["prodiva"],$_REQUEST["prodpreu"],$_REQUEST["prodisstock"],$_REQUEST["prodstockmin"],$_REQUEST["prodstockmax"],$_REQUEST["prodstockactual"]))
					$smartyObj -> assign("message","Producte creat");
				else
					$smartyObj -> assign("message","No s'ha pogut crear el producte...");
				
				$smartyObj -> assign("productes", Producte::llistatProductesProveidor($provid ));
				$smartyObj -> display("producteseditar.tpl");
				
			}	
			else { // creating, but there are missing parameters.
				$smartyObj -> assign("action", "create");
				$smartyObj -> assign("provs",Proveidor::getAll());
				$smartyObj -> assign("provid", $_REQUEST["prodprov"]);
				$smartyObj -> assign("prodnom",$_REQUEST["prodnom"]);
				$smartyObj -> assign("prodcode",$_REQUEST["prodcode"]);
				$smartyObj -> assign("prodpreu",$_REQUEST["prodpreu"]);
				$stockselect = ((!$_REQUEST["prodisstock"]) ? "<option value=\"0\">no</option>" : "");
				$smartyObj -> assign("stockselect", $stockselect);
				$smartyObj -> assign("prodstockmin",$_REQUEST["prodstockmin"]);
				$smartyObj -> assign("prodstockmax",$_REQUEST["prodstockmax"]);
				$smartyObj -> assign("prodstockactual",$_REQUEST["prodstockactual"]);
				$smartyObj -> assign("message","nom i preu han de ser-hi!");
				$smartyObj -> display("producte.tpl");
			}
		}
		else if ($_REQUEST["action"] == "modify") {
			if(($_REQUEST["prodnom"] != "") && ($_REQUEST["prodpreu"] != "")) {
				if(Producte::modify(
				$_REQUEST[prodid], 
				$_REQUEST[prodprov], 
				$_REQUEST[prodnom], 
				$_REQUEST[prodcode], 
				$_REQUEST[prodpreuinicial], 
				$_REQUEST[prodiva], 
				$_REQUEST[prodpreu], 
				$_REQUEST[prodisstock], 
				$_REQUEST[prodstockmin], 
				$_REQUEST[prodstockmax], 
				$_REQUEST[prodstockactual]
				))
					$smartyObj -> assign("message","Producte modificat");
				else
					$smartyObj -> assign("message","No s'ha pogut modificar el producte...");
				
				$smartyObj -> assign("productes", Producte::llistatProductesProveidor($provid ));
				$smartyObj -> display("producteseditar.tpl");
			}
			else { // modifying, but there are missing parameters.
				$smartyObj -> assign("action", "modify");
				$smartyObj -> assign("provs",Proveidor::getAll());
				$smartyObj -> assign("provid", $_REQUEST["prodprov"]);
				$smartyObj -> assign("prodnom",$_REQUEST["prodnom"]);
				$smartyObj -> assign("prodcode",$_REQUEST["prodcode"]);
				$smartyObj -> assign("prodpreu",$_REQUEST["prodpreu"]);
				if($_REQUEST["prodisstock"] == 0)
					$stockselect = "<option value=\"0\">fresc</option>";
				else if($_REQUEST["prodisstock"] == -1)
					$stockselect = "<option value=\"-1\">fresc permanent (cada setmana)</option>";
				$smartyObj -> assign("stockselect", $stockselect);
				$smartyObj -> assign("prodstockmin",$_REQUEST["prodstockmin"]);
				$smartyObj -> assign("prodstockmax",$_REQUEST["prodstockmax"]);
				$smartyObj -> assign("prodstockactual",$_REQUEST["prodstockactual"]);
				$smartyObj -> assign("message","nom i preu han de ser-hi!");
				$smartyObj -> display("producte.tpl");
			}
			
		}
		else if ($_REQUEST["action"] == "edit" && isset($_REQUEST["prodid"])) {
			
			$prod = Producte::get($_REQUEST["prodid"]);
					
			foreach($prod as $key=>$value) {
				$smartyObj -> assign($key, $value);
			}
			
			if($prod["prodisstock"] == 0)
				$stockselect = "<option value=\"0\">fresc</option>";
			else if($prod["prodisstock"] == -1)
				$stockselect = "<option value=\"-1\">fresc permanent (cada setmana)</option>";
			
			$smartyObj -> assign("stockselect", $stockselect);
			$smartyObj -> assign("message", "edita aquest producte...");
			$smartyObj -> assign("action", "modify");
			$smartyObj -> assign("provid", $prod["prodprov"]);
			$smartyObj -> assign("provs",Proveidor::getAll());
			$smartyObj -> display("producte.tpl");
		}
		else if(($_REQUEST["action"] == "delete") && ($_REQUEST["prodid"] != "")) {
			if(Producte::remove($_REQUEST["prodid"]))
				$smartyObj -> assign("message", "Producte eliminat...<br>");
			else
				$smartyObj -> assign("message", "Producte NO eliminat!<br>");
			
			$smartyObj -> assign("productes", Producte::llistatProductesProveidor($provid ));
			$smartyObj -> display("producteseditar.tpl");
		}
		else if(($_REQUEST["action"] == "stockupdate") && is_array($_REQUEST["prod"])) {
			foreach($_REQUEST["prod"] as $prodid => $stocktoadd) {
				if(is_numeric(trim(sql_float($stocktoadd)))) {
					if(!Producte::addStock($prodid, $stocktoadd, $_SESSION["membre"]["memid"]))
						$message = "Ha hagut un problema amb la inserci� d'estoc...<br>";
				}
			}
			
			if($message == "") $message = "S'ha agfegit estoc<br/>";
			
			$smartyObj -> assign("message", $message);
			$smartyObj -> assign("productes", Producte::llistatProductesProveidor($provid ));
			$smartyObj -> display("producteseditar.tpl");
		}
		else {		
				$smartyObj -> assign("productes", Producte::llistatProductesProveidor($provid ));
				if($_REQUEST["stockedit"] == 'true') 
					$smartyObj -> assign("stockedit", "true");
				$smartyObj -> display("producteseditar.tpl");
		}
?>
