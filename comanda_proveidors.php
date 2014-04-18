<?
	include_once('capcelera_segura.php');
	include_once('ProducteComanda.php');
	include_once('LiniaComanda.php');
	include_once('Data.php');	

	$smartyObj = new Smarty;
	$smartyObj -> assign("membre", $_SESSION["membre"]);
	
	if(!isset($_REQUEST["data"]) || $_REQUEST["data"] == "") {
		$data = Data::comandaActual();
	}
	else 
		$data = $_REQUEST["data"];

	if(isset($_REQUEST["data_direccio"])) {
		if($_REQUEST["data_direccio"] == "1")
			$data = Data::comandaAnterior($data);
		else if($_REQUEST["data_direccio"] == "2")
			$data = Data::comandaSeguent($data);
	}

	$smartyObj -> assign("dia", $data);
	$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
	
	if($_REQUEST["action"] != "") {
	
	}
 	
	if($data != "")   // show orders for day.....
		$smartyObj -> assign("productes",LiniaComanda::comandaSumari($data));
	
	$smartyObj -> display("comanda_proveidors.tpl");
	
?>
