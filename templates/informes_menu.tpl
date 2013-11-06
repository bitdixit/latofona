<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Informes!!!</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>
{include file="menu.tpl"}

<br/><a href="comanda_proveidors.php">Comandes (totals) a proveïdors</a>
<br/><a href="?informe=vendespendents">Vendes Pendents</a>
<br/><a href="?informe=ingresostotalsperdia">Ingresos Totals Per Dia</a>
<br/><a href="?informe=ingresos">Ingresos a la caixa (especifics, per tots els dies)</a>
<br/><a href="?informe=vendestotals">Vendes Totals Per tots els Dies</a>

<!-- {if isset($informe)} -->
<!--{if $multidata != 'true' && $informe != 'vendesdiadetall'} -->
<br><br>Dia: {$dia}
<br><br><!-- {if $datalast != ''} --><a href="?informe={$informe}&data={$datalast}" class="menu_opcio">Anterior Data</a>&nbsp; <!--{/if} -->|
 &nbsp;<!-- {if $datanext != ''} --><a href="?informe={$informe}&data={$datanext}" class="menu_opcio">Següent Data</a>&nbsp; | <!--{/if} --><br><br>
<!--{/if} -->
<br><br>
<!-- {if isset($rows) } -->
<table border="1px">
	<tr>
	<!--{foreach from=$columns item=column name=ccc} -->
		<td>{$column}</td>
	<!--{/foreach} -->
	<tr>		
	<!--{foreach from=$rows item=row name=rowss} -->
		<tr>
		<!--{foreach from=$columns item=column name=ccc} -->
			<td>{$row[$column]|replace:".":","}</td>
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
Encara no hi ha resultats per mostrar un informe (per aquest dia)!<br>
<!-- {/if} isset(rows) -->
<!-- {/if} isset(informe) -->
</body>
</html>