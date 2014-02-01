<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Informes!!!</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>
{include file="menu.tpl"}
<h1>{$title1}</h1>
<h4>{$title2}</h4>
<!-- {if isset($informe)} -->
<!--{if $multidata != 'true' && $informe != 'vendesdiadetall'} -->
<!-- {if $datalast != ''} --><input type="button" onclick="location.href='?informe={$informe}&data={$datalast}'" value="< Anterior data"><!--{/if} -->
 &nbsp;<!-- {if $datanext != ''} --><input type="button" onclick="location.href='?informe={$informe}&data={$datanext}'" value="Seguent data >"> <!--{/if} --><br><br>
<!--{/if} -->
<input type="button" onclick="window.history.back();" value="< Enrere">
<br>
<!-- {if isset($rows) } -->
<table border="1px">
	<tr>
	<!--{foreach from=$columns item=column name=ccc} -->
		<td class="cela_titol"><b>{$column}</b></td>
	<!--{/foreach} -->
	<tr>		
	<!--{foreach from=$rows item=row name=rowss} -->
		<tr>
		<!--{foreach from=$columns item=column name=ccc} -->
			<td class="cela_generica">{$row[$column]|replace:".":","}</td>
		<!--{/foreach} -->
		
		<!--{if $informe == 'vendespendents'} -->
			<td><a href="vendes.php?uf={$row.ufid}&data={$dia}">cobrar</a></td>	
		<!--{elseif $informe == 'vendestotals'} -->
			<td><a href="?informe=vendesdia&data={$row.vendata}">detalls</a></td>
		<!--{elseif $informe == 'vendesdia'} -->
			<td><a href="?informe=vendesdiadetall&venid={$row.venid}">detalls</a></td>
		<!--{/if} -->
		
		<tr>		
	<!--{/foreach} -->
</table>
<!--{elseif $informe == 'vendesdiadetall'} -->
	{include file="informe_vendadetall.tpl"}
<!--{else} -->
No s'han trobat dades per mostrar<br>
<!-- {/if} isset(rows) -->
<!-- {/if} isset(informe) -->
</body>
</html>
