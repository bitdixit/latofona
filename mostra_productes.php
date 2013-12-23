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
	

	if (($_REQUEST['year'] != "") && ($_REQUEST['month'] != "") && ($_REQUEST['day'] != "")) { //we're trying to create a new order day....
		Data::createOrderDay($_REQUEST['year'], $_REQUEST['month'], $_REQUEST['day']);
		$_SESSION["datavenda"] = $year."-".$month."-".$day;
		echo $_SESSION["datavenda"];
	}
	
	if ($_REQUEST['accio'] == "send") {
		if(ProducteComanda::insertarProductesAComanda($_REQUEST["prod"],$_REQUEST["datDia"]))
			$smartyObj -> assign("message", "s'ha verificat els productes al dia de la comanda.");
		else 
			$smartyObj -> assign("message", "no s'ha pogut insertar els productes al dia de la comanda");
	} 
	
	


	$currDate = Data::getBestDateForComanda();
			
	if ($_REQUEST["data_direccio"] == 1) {
		$strData = Data::comandaAnterior($currDate);
	}
	else if ($_REQUEST["data_direccio"] == 2) {
		$strData = Data::comandaSeguent($currDate);
		if($strData == "") { // $_REQUEST['data'] is already the last order date.
			$nextweek = Data::nextWeekFromDate($currDate);
			if($nextweek != "") {
				$creatingNewOrderDate = true;
				list($year, $month, $day) = explode("-", $nextweek);	
			}
			else
				echo "Error al crear un nou dia de comanda<br>";
		}
	}
	else {	
		if ($currDate == "") {
			$creatingNewOrderDate = true;
			$nextweek = Data::nextWeekFromDate("");
			list($year, $month, $day) = explode("-", $nextweek);
			$currDate = Data::getLastDayActiveComanda();	
		}
		else
			$strData = $currDate;
	}

	if ($creatingNewOrderDate) {
		$smartyObj -> assign("lastdate", $currDate);
		$smartyObj -> assign("year",$year);
		$smartyObj -> assign("month",$month);
		$smartyObj -> assign("day",$day);
		$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
		$smartyObj -> display("creardiacomanda.tpl");
	}
	else {
		

		$smartyObj -> assign("productes", ProducteComanda::llistatProductesMarcatsProveidor ($strData,$provid));
		$smartyObj -> assign("datacomandes",Data::getAll("datdata > '".$_REQUEST["data"]."' order by datdata asc"));
		$smartyObj -> assign("dia",$strData);
		$accio = "send";
		$smartyObj -> assign("accio",$accio);
		$smartyObj -> display("mostra_productes.tpl");
	}

?>
