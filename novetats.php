<?
	include_once('capcelera_segura.php');
	include_once('Membre.php');
        include_once('Producte.php');
        include_once('ProducteComanda.php');
        include_once('ProducteHistoric.php');

        $changes = ProducteHistoric::generaDiferenciesProducteHistoric();
	$smartyObj = new Smarty;
	$smartyObj -> assign("changes", $changes);
	$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> display("novetats.tpl");

?>
