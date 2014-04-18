<?
	include_once('capcelera_segura.php');
	include_once('ProducteComanda.php');
	include_once('LiniaComanda.php');
	include_once('lib/Proveidor.php');
	include_once('Data.php');	

	$provid = $_REQUEST["provid"];	

	$smartyObj = new Smarty;
	$smartyObj -> assign("membre", $_SESSION["membre"]);
	$smartyObj -> assign("dia", get_current_date());
	$smartyObj -> assign("provid", $provid );
	//$proveidor =  Proveidor::getById($provid);
	//$smartyObj -> assign("provnom", $proveidor["provnom"] );
	

	if ($_REQUEST['accio'] == "send") {
		if(ProducteComanda::insertarProductesAComanda($provid,$_REQUEST["prod"],$_REQUEST["datDia"]))
			$smartyObj -> assign("message", "s'ha verificat els productes al dia de la comanda.");
		else 
			$smartyObj -> assign("message", "no s'ha pogut insertar els productes al dia de la comanda");
	} 
	
        if (array_key_exists("data",$_REQUEST))
	  $currDate = $_REQUEST["data"];
        else
          $currDate = Data::getBestDateForComanda();
			
	if ($_REQUEST["data_direccio"] == 1) {
		$strData = Data::comandaAnterior($currDate);
	}
	else if ($_REQUEST["data_direccio"] == 2) {
		$strData = Data::comandaSeguent($currDate);
		if($strData == "")
                 {
$strData = $currDate;		
}
	}
	else {	
			$strData = $currDate;
	}


		$smartyObj -> assign("productes", ProducteComanda::llistatProductesMarcatsProveidor ($strData,$provid));
		$smartyObj -> assign("datacomandes",Data::getAll("datdata > '".$_REQUEST["data"]."' order by datdata asc"));
		$smartyObj -> assign("dia",$strData);
		$accio = "send";
		$smartyObj -> assign("accio",$accio);
		$smartyObj -> display("mostra_productes.tpl");

?>
