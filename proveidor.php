<?

include_once('capcelera_segura.php');
include_once('Proveidor.php');

$smartyObj = new Smarty;
$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
$smartyObj -> assign("membre",$_SESSION["membre"]);
$smartyObj -> assign("dia", get_current_date());

if (($_REQUEST["action"] == "edit")) {
	$smartyObj -> assign("prov", Proveidor::getById($_REQUEST["provid"]));
	$smartyObj -> assign("action", "modify");
	$smartyObj -> display("proveidoredit.tpl");
}
else if (($_REQUEST["action"] == "modify")) {
	if (!Proveidor::modify($_REQUEST["provid"], $_REQUEST["provnom"], $_REQUEST["provtelefon"], $_REQUEST["provfax"], $_REQUEST["provextrainfo"], $_REQUEST["provresponsable"], $_REQUEST["provtelefonresponsable"]))
		$smartyObj -> assign("message", "no s'ha pogut afegir el proveidor...<br>");
	else
		$smartyObj -> assign("message", "s'ha modificat el proveidor $_REQUEST[provnom]...<br>");
		$smartyObj -> assign("provs",Proveidor::getAll());
		$smartyObj -> display("proveidorlist.tpl");
}
else if (($_REQUEST["action"] == "new")) {
	$smartyObj -> assign("action", "add");
	$smartyObj -> display("proveidoredit.tpl");
}
else if (($_REQUEST["action"] == "add")) {
	if (!Proveidor::add($_REQUEST))
		$smartyObj -> assign("message", "no s'ha pogut afegir el proveidor...<br>");
	$smartyObj -> assign("provs",Proveidor::getAll());
	$smartyObj -> display("proveidorlist.tpl");
}
else { // show list of all provs..
	$smartyObj -> assign("provs",Proveidor::getAll());
	$smartyObj -> display("proveidorlist.tpl");
}


?>