<?
	include_once("capcelera_segura.php");
	include_once("Membre.php");
	include_once("Proveidor.php");
	include_once("Producte.php");
	include_once("UnitatFamiliar.php");

	$provs = Proveidor::getAll();
	
?>

<html>
<body>
<script> 
function show(show) {
	e = document.getElementsByTagName('div');
	for(var i=0; i<e.length;i++){ e[i].style.display='none'; } 
	document.getElementById(show).style.display = '';
}
</script>
<a href="?add=products">products</a><br>
<a href="?add=ufs">unitats familiars</a><br>

<? if($_REQUEST["add"] == "products") { ?>

<form  name="prods" method="POST">
<select name="prodprov">
<? foreach($provs as $prov) { ?>
	<option value="<?=$prov["provid"]?>"><?=$prov["provnom"]?></option>
<? } ?>
</select>
<br><br>
<textarea cols="100" rows="20" name="products"></textarea>
<br>
<input type="submit" value="go">
<? } 

elseif ($_REQUEST["add"] == "ufs") {
?>

<form name="ufs" method="POST">
<br>
<textarea cols="100" rows="20" name="ufs"></textarea>
<br>
<input type="submit" value="go">
</form>

<? } ?>

</body>
</html>

<?


if(isset($_POST["products"])){
	$lines = explode("\n", $_POST["products"]);
	
	foreach($lines as $line) {
		$prodinput = explode(",",$line);
		echo "<br>$_POST[prodprov], $prodinput[1], , $prodinput[2], $prodinput[0], 0,0,0";
		Producte::create($_POST["prodprov"], $prodinput[1], "", $prodinput[2], $prodinput[0], 0,0,0);
	}
}
elseif(isset($_POST["ufs"])){
	$lines = explode("\n", $_POST["ufs"]);
	
	foreach($lines as $line) {
		$ufinfo = explode(",",$line);
//		echo "<br>$_POST[ufs], $ufinfo[0], $ufinfo[1], $ufinfo[3]";
		$ufinfo["ufid"] = $ufinfo[0];
		$ufinfo["ufname"] = $ufinfo[1];
		$ufinfo["ufcontact"] = $ufinfo[2];
		$ufinfo["ufaddress"] = $ufinfo[3];
		//$ufArray[ufid], '$ufArray[ufname]', '$ufArray[ufcontact]', '$ufArray[ufaddress]'
		UnitatFamiliar::add($ufinfo);
	}
}
?>