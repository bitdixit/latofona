<?
	include_once('capcelera_segura.php');

	include_once('LiniaComanda.php');
	include_once('Data.php');
        
        $dates = Data::getAll("datestat & ".Data::FERCOMANDA." !=0");
        if (count($dates)==0) error("No hi ha cap data per fer comanda.");
        else if (count($dates)>1) error("Hi ha mes d'una data per fer comanda  activada.");
	
        $strData = $dates[0]["datdata"];
	
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

	$smartyObj = new Smarty;
	$smartyObj -> assign("productes", LiniaComanda::llistatProductes($_SESSION["membre"]["memuf"],$strData, "prodisstock=0 AND p.prodid in (select pcprodid from ProducteComanda where pcdata='$strData') or prodisstock=-1"));
	$smartyObj -> assign("dia",$strData);
	$smartyObj -> assign("proveidor",0);
	$smartyObj -> assign("uf",$_SESSION["membre"]["memuf"]);
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> assign("confirm_exit","true");

	$smartyObj -> display("comanda_cistella_editar.tpl");
?>
