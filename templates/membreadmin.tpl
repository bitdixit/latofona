<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>
<body>
{include file="menu.tpl"}
<br>
	<a href="?action=edit">edita l'usuari actual.</a><br>
	{if $membre.memtipus == 1}
		<a href="?action=add"><b>afegeix usuari nou</b></a><br>
	{/if}
<br><br>
<font color="red">{$message}</font><br>
<!--{if $membre.memtipus != 0} //admin user -->
<table border="1px">
	<tr><td>UF</td><td>Membre</td><td>Eliminar</td></tr>
	<!-- {foreach from=$membres item=themembre name=membrelist} -->
	<tr>
		<td>{$themembre.memuf}</td>
		<td><a href="?action=edit&memid={$themembre.memid}">{$themembre.memnom}</a></td>
		<td>....</td>
	</tr>
	<!--{/foreach} -->
</table>
<!-- {/if} -->
</body>
</html>
