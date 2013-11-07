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
<h1>Productes disponibles per a comanda<br>{$dia}</h1>
<h4>Selecciona productes disponibles per a commanda.<br>El responsable de cada proveïdor és el responsable d'omplir aquesta graella.</h4>
<input type=button value="< Comanda anterior" onclick="location.href='mostra_productes.php?data={$dia}&data_direccio=1'">
<input type=button value="Comanda següent >" onclick="location.href='mostra_productes.php?data={$dia}&data_direccio=2'">
<br/>
<b>
<!--{if $accio == 'send'}-->
	Selecció de Productes&nbsp;&nbsp;&nbsp;&nbsp;
	<!--[ <a href="mostra_productes.php?data={$dia}&move=true">moure productes demanats a altre comanda</a> ]-->
<!--{else}-->
	Moviment de Productes demanats per aquesta comanda a altre comanda.
<!--{/if}-->
</b>
<br/><br/>
<table border="0">
<tr>
<td valign="top">
<form method="post" name="visible" id="visible">
<!--{if $accio == 'move'} --> 
<b>moure els sel·leccionats al dia: </b>
<select type="select" name="movedata" onChange="javascript:visible.movedata2.value=this.value" id="movedata1">
	<!--{foreach from=$datacomandes item=datacomanda name=dates} -->
	<option value="{$datacomanda.datdata}">{$datacomanda.datdata}</option>
	<!-- {/foreach}-->
</select><br/><br/>
<!--{/if} -->
  <table border="1px" cellspacing="1" cellpadding="1">
    <tbody>
<!--{foreach from=$productes item=producte name=llistatproductes}-->
<!--{if $proveidor != $producte.provnom}-->
<!--{assign var="proveidor" value=$producte.provnom}-->
    <tr>
    		<td>&nbsp;</td>
		<td colspan=3>&nbsp;&nbsp;&nbsp;<br/><b>{$producte.provnom}</b>&nbsp;&nbsp;<a name="{$proveidor}"></a>
			<a href="#{$proveidor}" onClick="javascript:allSelectProveidor(true,'{$proveidor}')">tots</a>&nbsp;
			<a href="#{$proveidor}" onClick="javascript:allSelectProveidor(false,'{$proveidor}')">cap</a>
		</td>
    </tr>
<!--{/if}-->
    <tr>
    	<!--{if $accio == 'send'} --> 
		<!--{if $producte.prodisstock == -1} --><td><input type="checkbox" checked="true" disabled="true"/></td>
		<!--{else} -->
		<td><input name="prod[{$producte[0]}]" id="{$proveidor}" value="{$producte[0]}" type="checkbox" {$producte[3]}/></td>
		<!--{/if} -->
	<!--{else} -->
    		<td class="cell_preu"> moure </td>
		<td class="cela_checkbox"><input name="prod[{$producte[0]}]"  id="{$proveidor}" value="{$producte[0]}" type="checkbox"/></td>
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
<!--{if $accio == 'move'} --> 
moure al dia: <select type="select" name="movedata" onChange="javascript:visible.movedata1.value=this.value"  id="movedata2">
	<!--{foreach from=$datacomandes item=datacomanda name=dates} -->
	<option value="{$datacomanda.datdata}">{$datacomanda.datdata}</option>
	<!-- {/foreach}-->
</select><br/>
<!--{/if} -->
<br/>  
  <input type="hidden" name="accio" value="{$accio}"/>
  <input type="hidden" name="datDia" value="{$dia}"/>
  <input type="submit" value="Enviar"/>
</form>
</td>
</body>
</html>
