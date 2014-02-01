<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
  		<title>Afegir/Modificar Productes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
	</head>
{literal}
<script>

function toggleView(elmname) {
	elm = document.getElementById(elmname);
	elm.style.display = (elm.style.display == '') ? "none" : "";
}

function calculateTotalPrice() {
	percent = document.getElementById('iva').value / 100;
	var preufinal = 0;
	preufinal = parseFloat(commaReplace(document.forms[0].preuinicial.value)) + parseFloat(commaReplace(document.forms[0].preuinicial.value) * percent);
	document.getElementById('prodpreu').value = preufinal.toFixed(2);
}
function commaReplace(orig) {
	regX = /,/gi;
	return orig.replace(regX, ".");
}

</script>
{/literal}
	<link href="css/taula.css" rel="stylesheet" type="text/css" />
	<body>
	{include file="menu.tpl"}
<h1>Alta/Modificació d'un producte</h1>
	<br/>
		<font color="red">{$message}</font><br><br>
		<table>		
		<form action="producte.php" method="POST">
			<input type="hidden" name="action" value="{$action}"/>
			<input type="hidden" name="prodid" value="{$prodid}"/>
			<input type="hidden" name="provid" value="{$provid}"/>			
			<tr>
				<td>Proveidor</td>
				<td>
					<select name="prodprov">
					<!--{foreach from=$provs item=prov name=llistatprovs}-->
						<!--{if $provid == $prov.provid}-->
							<option value="{$prov.provid}" selected>{$prov.provnom}</option>
						<!--{/if}-->
					<!--{/foreach}-->
					</select>
				</td>
			</tr>
			<tr>
				<td>Nom i descripció breu del producte</td>
				<td><input type="text" name="prodnom" value="{$prodnom}" size="110"/></td></tr>
			<tr><td>Codi del producte</td><td><input type="text" name="prodcode" value="{$prodcode}" size="20"/></td></tr>
			<tr>
				<td>Preu sense IVA</td>
				<td><input id="preuinicial" type="text" name="prodpreuinicial" value="{$prodpreuinicial}" size="10" onkeyup="javascript:calculateTotalPrice()"/> &euro;</td>
			</tr>
			<tr>
				<td>IVA aplicable al preu</td>
				<td><input id="iva" type="text" name="prodiva" value="{$prodiva}" size="2" onkeyup="javascript:calculateTotalPrice()"/>%</td>
			</tr>
			<tr>
				<td>Preu amb IVA</td>
				<td><input type="text" id="prodpreu" name="prodpreu" value="{$prodpreu}" size="10" readonly="readonly"/> &euro;</td>
			</tr>
			<tr><td>Producte estoc?</td>
				<td>
				<select name="prodisstock">
					{$stockselect}
					<option value="1">Estoc</option>
					<option value="0">Fresc</option>
					<option value="-1">Fresc permanent (cada setmana)</option>
				</select>
				</td>
			</tr>
			<tr><td>Estoc mínim</td><td><input type="text" name="prodstockmin" value="{$prodstockmin}" size="10"/></td></tr>
			<tr><td>Estoc màxim</td><td><input type="text" name="prodstockmax" value="{$prodstockmax}" size="10"/></td></tr>
			<tr><td>Estoc actual</td><td>
				<!-- {if $action == 'modify'} -->
				 (Per afegir estoc, torna a la pàgina anterior. Ajusta l'estoc aquí només quan sigui necessari...)<br/>
				<!-- {/if} -->
				<input type="text" name="prodstockactual" value="{$prodstockactual}" size="10"/>
			</td></tr>
			<tr><td colspan="2"><input type="button" value="< Enrere" onclick="window.history.back()"><input type="submit" value="Desar"/></td>
		</form>
		<table>
	</body>
</html>
