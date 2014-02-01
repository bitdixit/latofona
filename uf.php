<?

include_once('capcelera_segura.php');
include_once('UnitatFamiliar.php');
include_once('Membre.php');

$smartyObj = new Smarty;
$smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
$smartyObj -> assign("membre",$_SESSION["membre"]);
$smartyObj -> assign("dia", get_current_date());

if (($_REQUEST["action"] == "ingres")) {
	$smartyObj -> assign("uf", UnitatFamiliar::get($_REQUEST["ufid"]));
	$smartyObj -> assign("action", "ingressar");
	$smartyObj -> display("ufingres.tpl");
}
else if (($_REQUEST["action"] == "ingressar")) {
	if (!UnitatFamiliar::ingressar($_REQUEST["inuf"], $_REQUEST["inquantitat"], $_REQUEST["inmemid"], $_REQUEST["innota"]))
		$smartyObj -> assign("message", "no s'ha pogut ingressar la UF...<br>");
	else
		$smartyObj -> assign("message", "s'ha ingressat $_REQUEST[inquantitat] &euro; a la compte de la UF $_REQUEST[inuf]<br>");
		
	$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
	$smartyObj -> display("uflist.tpl");
}
else if (($_REQUEST["action"] == "edit") && ($_REQUEST["ufid"] > 0)) {
	$smartyObj -> assign("uf", UnitatFamiliar::get($_REQUEST["ufid"]));
	$smartyObj -> assign("action", "modify");
	$smartyObj -> display("ufedit.tpl");
}
else if (($_REQUEST["action"] == "modify")) {
	if (!UnitatFamiliar::modify($_REQUEST["ufid"], $_REQUEST["ufname"], $_REQUEST["ufcontact"], $_REQUEST["ufaddress"]))
		$smartyObj -> assign("message", "no s'ha pogut afegir la UF...<br>");
	else
		$smartyObj -> assign("message", "s'ha modificat la UF $_REQUEST[ufid] - $_REQUEST[ufname]...<br>");
	$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
	$smartyObj -> display("uflist.tpl");
}
else if (($_REQUEST["action"] == "new")) {
	$smartyObj -> assign("action", "add");
	$smartyObj -> display("ufedit.tpl");
}
else if (($_REQUEST["action"] == "add")) {
	if (!UnitatFamiliar::add($_REQUEST))
		$smartyObj -> assign("message", "no s'ha pogut afegir la UF...<br>");;
	$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
	$smartyObj -> display("uflist.tpl");
}
else { // show list of all ufs..
	$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
	$smartyObj -> assign("membres",Membre::getAll());
	$smartyObj -> display("uflist.tpl");
}


?>
