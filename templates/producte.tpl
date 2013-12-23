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
				<td>proveidor</td>
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
				<!-- <dunetna> canvi de literal
				<td>nom y descripci� breu del producte</td>-->
				<td>nom i descripció breu del producte</td>
    <!-- </dunetna> -->
				<td><input type="text" name="prodnom" value="{$prodnom}" size="110"/></td></tr>
			<tr><td>codi del producte</td><td><input type="text" name="prodcode" value="{$prodcode}" size="20"/></td></tr>
			<tr>
				<!-- <dunetna> canvi de literal
				<td>preu inicia del producte</td>-->
				<td>preu sense IVA</td>
				<!-- </dunetna> -->
				<!-- <dunetna> canvi d'event
				<td><input id="preuinicial" type="text" name="prodpreuinicial" value="{$prodpreuinicial}" size="10" onBlur="javascript:calculateTotalPrice()"/> &euro;</td>-->
				<td><input id="preuinicial" type="text" name="prodpreuinicial" value="{$prodpreuinicial}" size="10" onkeyup="javascript:calculateTotalPrice()"/> &euro;</td>
				<!-- </dunetna> -->
			</tr>
			<tr>
				<td>IVA aplicable al preu</td>
				<!-- <dunetna> canvi d'event
				<td><input id="iva" type="text" name="prodiva" value="{$prodiva}" size="2" onBlur="javascript:calculateTotalPrice()"/>%</td>-->
				<td><input id="iva" type="text" name="prodiva" value="{$prodiva}" size="2" onkeyup="javascript:calculateTotalPrice()"/>%</td>
				<!-- </dunetna> -->
			</tr>
			<tr>
				<!-- <dunetna> canvi de literal
				<td>preu del producte</td>-->
				<td>preu amb IVA</td>
				<!-- </dunetna> -->
				<!-- <dunetna> posar camp nom�s lectura 
				<td><input type="text" id="prodpreu" name="prodpreu" value="{$prodpreu}" size="10"/> &euro;</td>-->
				<td><input type="text" id="prodpreu" name="prodpreu" value="{$prodpreu}" size="10" readonly="readonly"/> &euro;</td>
			</tr>
			<tr><td>producte estoc?</td>
				<td>
				<select name="prodisstock">
					{$stockselect}
					<option value="1">estoc</option>
					<option value="0">fresc</option>
					<option value="-1">fresc permanent (cada setmana)</option>
				</select>
				</td>
			</tr>
			<tr><td>estoc mínim</td><td><input type="text" name="prodstockmin" value="{$prodstockmin}" size="10"/></td></tr>
			<tr><td>estoc màxim</td><td><input type="text" name="prodstockmax" value="{$prodstockmax}" size="10"/></td></tr>
			<tr><td>estoc actual</td><td>
				<!-- {if $action == 'modify'} -->
				 (Per afegir estoc, torna a la pàgina anterior. Ajusta l'estoc aquí només quan sigui necessari...)<br/>
				<!-- {/if} -->
				<input type="text" name="prodstockactual" value="{$prodstockactual}" size="10"/>
			</td></tr>
			<tr><td colspan="2"><input type="submit" value="enviar"/></td>
		</form>
		<table>
	</body>
</html>
