<?

	include_once('capcelera_segura.php');

	include_once('LiniaComanda.php');
	include_once('Data.php');

	$strData = Data::getBestDateForComanda();
	
	if ($_REQUEST['accio'] != "")
	{
		$insertarlos = array();
		foreach (array_keys($_REQUEST) as $variable) {
			if (!strncmp($variable,"prod_",5) )
				$insertarlos[substr($variable,5)] = $_REQUEST[$variable];
		}
		LiniaComanda::insertarProductesComanda($_SESSION["membre"]["memuf"],$insertarlos,$_REQUEST["datDia"]);

		$productesTots = LiniaComanda::llistatProductes($_SESSION["membre"]["memuf"],$strData, "prodisstock=0 AND lcquantitat>0 AND p.prodid in (select pcprodid from ProducteComanda where pcdata='$strData') or prodisstock=-1");
		$productesSeleccionats = array();
		foreach ($productesTots as $producte)
			if ($producte[3]!=0) array_push($productesSeleccionats,$producte);
		
		$smartyObj = new Smarty;
		$smartyObj -> assign("productes", $productesSeleccionats );
		$smartyObj -> assign("dia",$strData);
		$smartyObj -> assign("proveidor",0);
		$smartyObj -> assign("uf",$_SESSION["membre"]["memuf"]);
		$smartyObj -> assign("membre",$_SESSION["membre"]);
		$smartyObj -> assign("confirm_exit","true");

		$smartyObj -> display("comanda_cistella_resum.tpl");
		exit(0);
	} 

	if ($_SESSION["debug"]) echo "Actual comanda: $strData <br/>";

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
	

	$smartyObj = new Smarty;
	$smartyObj -> assign("productes", LiniaComanda::llistatProductes($_SESSION["membre"]["memuf"],$strData, "prodisstock=0 AND p.prodid in (select pcprodid from ProducteComanda where pcdata='$strData') or prodisstock=-1"));
	$smartyObj -> assign("datanext",$datanext);
	$smartyObj -> assign("datalast",$datalast);
	$smartyObj -> assign("dia",$strData);
	$smartyObj -> assign("proveidor",0);
	$smartyObj -> assign("uf",$_SESSION["membre"]["memuf"]);
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> assign("confirm_exit","true");

	$smartyObj -> display("comanda_cistella_editar.tpl");

?>
