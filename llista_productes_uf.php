<?

	include_once('capcelera_segura.php');

	include_once('LiniaComanda.php');
	include_once('Data.php');
	
	if ($_REQUEST['accio'] != "") {
		$insertarlos = array();
		foreach (array_keys($_REQUEST) as $variable) {
			if (!strncmp($variable,"prod_",5) )
				$insertarlos[substr($variable,5)] = $_REQUEST[$variable];
		}
		LiniaComanda::insertarProductesComanda($_SESSION["membre"]["memuf"],$insertarlos,$_REQUEST["datDia"]);
	    $comanda_ok = true;
	} 

	$strData = Data::getBestDateForComanda();
	if ($_SESSION["debug"]) echo "Actual comanda: $strData <br/>";
	//get_current_date();
	if($strData == "") {
		echo "Error: No s'ha trobat cap data bona per fer comanda!<br/> "
			."Recorda, no es pot fer una comanda per aquesta setmana (ha de ser pel futur). <br/>"
			."S'ha de donar d'alta una data de comanda o triar una data correcte. <br/>" .
					"Continua a <a href=\"vendes.php\">vendes</a> <br/>" .
					"Afegir dia de compra <a href=\"mostra_productes.php\"><b>AQUI</b></a>";
		exit(0);
	}	
	
	$datanext = Data::comandaSeguent($strData);
	$datalast = Data::comandaAnterior($strData);
	
	if($datalast <= Data::comandaActual()) $datalast = "";
	
/*
	if ($_REQUEST['data_direccio'] == '1') {
		$strData = Data::comandaAnterior($strData);
	} elseif ($_REQUEST['data_direccio'] == '2') {
		$segData = Data::comandaSeguent($strData);
		if($segData != "")
			$strData = $segData;
	}
*/	
	$smartyObj = new Smarty;
	$smartyObj -> assign("productes", LiniaComanda::llistatProductes($_SESSION["membre"]["memuf"],$strData, "prodisstock=0 AND p.prodid in (select pcprodid from ProducteComanda where pcdata='$strData') or prodisstock=-1"));
	$smartyObj -> assign("datanext",$datanext);
	$smartyObj -> assign("datalast",$datalast);
	$smartyObj -> assign("dia",$strData);
	$smartyObj -> assign("proveidor",0);
	$smartyObj -> assign("uf",$_SESSION["membre"]["memuf"]);
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> assign("confirm_exit","true");
	$smartyObj -> assign("comanda_ok", $comanda_ok);
	$smartyObj -> display("llista_productes_uf.tpl");
	

?>
