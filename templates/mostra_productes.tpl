<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Llistat de productes</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

{literal}
<script>
function allSelect(truefalse) {
	for(i=0;i<document.forms[0].elements.length;i++) {
		if(document.forms[0].elements[i].type == 'checkbox')
			if(!document.forms[0].elements[i].disabled)
				document.forms[0].elements[i].checked = truefalse;
	}
}
	
function allSelectProveidor(truefalse, proveidor) {
	for(i=0;i<document.forms[0].elements.length;i++) {
		if(document.forms[0].elements[i].type == 'checkbox')
			if(document.forms[0].elements[i].id == proveidor)
				if(!document.forms[0].elements[i].disabled)
					document.forms[0].elements[i].checked = truefalse;
	}
}

</script>
{/literal}
<body>
{include  file="menu.tpl"}
<h1>Productes disponibles per a comanda<br>{$dia} </h1>

<!-- {if !$productes} -->

<h4>No hi han productes dels que es pugui demanar comanda</h4>
<br>
<input type="button" onclick="location.href='proveidor.php'" value="< Enrere"/>

<!-- {else} -->

<h4>Selecciona productes disponibles per a commanda.<br>El responsable de cada proveïdor és el responsable d'omplir aquesta graella.</h4>
<input type=button value="< Comanda anterior" onclick="location.href='mostra_productes.php?provid={$provid}&data={$dia}&data_direccio=1'">
<input type=button value="Comanda següent >" onclick="location.href='mostra_productes.php?provid={$provid}&data={$dia}&data_direccio=2'">
<br/>
<b>
Selecció de Productes&nbsp;&nbsp;&nbsp;&nbsp;
</b>
<br/><br/>
<table border="0">
<tr>
<td valign="top">
<form method="post" name="visible" id="visible">

  <table border="1px" cellspacing="1" cellpadding="1">
    <tbody>
<!--{foreach from=$productes item=producte name=llistatproductes}-->
    <tr>
	<!--{if $producte.prodisstock == -1} --><td><input type="checkbox" checked="true" disabled="true"/></td>
	<!--{else} -->
	<td><input name="prod[{$producte[0]}]" id="{$proveidor}" value="{$producte[0]}" type="checkbox" {$producte[3]}/></td>
	<!--{/if} -->

	<td class='cela_nom'>{$producte[1]}</td>
	<td class='cela_preu'>{$producte[2]}</td>
	
    </tr>
<!--{/foreach}-->
    </tbody>
  </table><br/>

<a name="bottom"></a>
<a href="#bottom" onClick="javascript:allSelect(true)">tots</a>&nbsp;
<a href="#bottom" onClick="javascript:allSelect(false)">cap</a><br/><br/>

<br/>  
  <input type="hidden" name="accio" value="{$accio}"/>
  <input type="hidden" name="datDia" value="{$dia}"/>
  <input type="button" onclick="location.href='proveidor.php'" value="< Enrere"/>
  <input type="submit" value="Desar"/>
</form>

<!-- {/if} -->

</body>
</html>
