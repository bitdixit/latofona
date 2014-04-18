<?
	include_once('capcelera_segura.php');
	$smartyObj = new Smarty;
	$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> display("inici.tpl");

?>
