<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Gestió de Productes</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
{literal}
<script>

function toggleView(elmname) {
	elm = document.getElementById(elmname);
	elm.style.display = (elm.style.display == '') ? "none" : "";
}

function calculateTotalPrice() {
	percent = document.getElementById('iva').value / 100;
	//alert (percent);
	//alert(document.forms[0].preuinicial.value);
	var preufinal = 0;
	preufinal = parseFloat(document.forms[0].preuinicial.value) + parseFloat(document.forms[0].preuinicial.value * percent);
	document.getElementById('prodpreu').value = preufinal.toFixed(2);
}

</script>
{/literal}

<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}

<br/>
<!--{if $stockedit !='true'} -->
	<h1>Gestiò de productes</h1>
    <br>
    <input type="button" onclick="location.href='producte.php?action=editall&stockedit=true'" value="Afegir stocks (Actualitza els preus abans)">
	<br>
<!--{else} -->
	<h1>Afegir stock</h1>
	Actualitza els preus <b>ABANS</b> d'afegir estoc.
<!--{/if}-->
<font color="red">{$message}</font>  
<br><br>
<form method="POST">
  <table border="0" cellspacing="3" cellpadding="3">
    <tr>
		<td>&nbsp;</td>
    		<td class='cela_titol' width="400">Producte</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_titol'>Preu inicial</td>
		<td class='cela_titol'>IVA aplicat</td>
		<!--{/if}-->
		<td class='cela_titol' width="50">Preu Final</td>
		<td class='cela_titol'>En estoc</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_titol'>Estoc a afegir</td>
		<!--{else}-->
		<td class='cela_titol' width="20">editar</td>
		<td class='cela_titol' width="20">eliminar</td>
		<!--{/if}-->
		<td></td>

    </tr>
   
<!--{assign var="divset" value='false'}-->
<!--{foreach from=$productes item=producte name=llistatproductes}-->


<!--<dunetna> Controlem els proveidors sense productes -->
<!--{if $producte.prodprov == ""}-->
	<!--{if $divset == 'true'}-->
		</div>
	<!--{else}-->
		<!--{assign var="divset" value='true'}-->
	<!--{/if}-->
   <table>
    <tr>
		<td>&nbsp;</td>
		<td colspan=5><b>{$producte.provnom}</b>&nbsp;&nbsp; <a href="?action=add&provid={$producte.provid}">afegir</a></td>
		<td>&nbsp;</td>
    </tr>
   </table>

<!--{else}-->
<!--</dunetna>-->

<!--{if $proveidor != $producte.prodprov}-->
	<!--{if $divset == 'true'}-->
		</div>
	<!--{else}-->
		<!--{assign var="divset" value='true'}-->
	<!--{/if}-->
   <table>
    <tr>
		<td>&nbsp;</td>
		<td colspan=5><b><a href="#{$producte.prodid}" onClick="javascript:toggleView('{$producte.prodid}')">{$producte.provnom}</a></b>&nbsp;&nbsp; <a href="?action=add&provid={$producte.provid}">afegir</a></td>
		<td>&nbsp;</td>
    </tr>
   </table>
   <a name="{$producte.prodid}"></a>
    <div id="{$producte.prodid}" style="display:none">
<!--{assign var="proveidor" value=$producte.prodprov}-->
<!--{/if}-->
  <table>
    <tr>
		<td>&nbsp;</td>
		<td class='cela_nom'>{$producte.prodnom}</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_preu'>{$producte.prodpreuinicial}</td>
		<td class='cela_preu'>{$producte.prodiva} %</td>
		<!--{/if}-->
		<td class='cela_preu'>{$producte.prodpreu}</td>
		<td class='cela_preu'>{$producte.prodstockactual}</td>
		<!--{if $stockedit=='true'} -->
		<td align="center" width="70"><input type="text" name="prod[{$producte.prodid}]" size="5"/>
		<!--{else}-->
		<td><a href="producte.php?action=edit&prodid={$producte.prodid}">editar</a></td>
		<td><a href="producte.php?action=delete&prodid={$producte.prodid}">eliminar</a></td>
		<!--{/if}--></td>
    </tr>
  </table>

<!--<dunetna> Tanquem if -->
<!--{/if}-->
<!--<dunetna> Tanquem if -->

<!--{/foreach}-->
	</div> <!-- closing the last div.. -->
<!--{if $stockedit=='true'} -->
<input type="hidden" name="action" value="stockupdate">
<br/><input type="submit" name="stockupdate" value="enviar stock a afegir...">
</form>
<!--{/if}-->
</body>
</html>
