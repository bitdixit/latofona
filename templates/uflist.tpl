<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Unitats Familiars</title>
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Cistelles/UF</h1>
<br>
{$message}
<br>
<a href="?action=new">Afegeix una unitat familiar...</a><br>
<br>
Edita una unitat familiar...<br>
<table border="1" cellspacing="3" cellpadding="2">
<tr>
	<td>Num UF</td>
	<td>Nom UF</td>
	<!-- <dunetna> canvi de literal
	<td>Val</td> -->
	<td>Crèdit</td>
	<!-- </dunetna> -->
	<td>Editar</td>
	<!-- <dunetna> canvi de literal 
	<td>Ingresar al val</td> -->
	<td>Ingressar</td>
	<!-- </dunetna> -->
</tr>
<!--{foreach from=$ufs item=uf name=elsufs}-->
<tr>
	<td>{$uf.ufid}</td>
	<td>{$uf.ufname}</td>
	<td>{$uf.ufval} &euro;</td>
	<td><a href="?action=edit&ufid={$uf.ufid}">editar</a></td>
	<!-- {if $membre.memuf != $uf.ufid} -->
		<td><a href="?action=ingres&ufid={$uf.ufid}">ingressar</a></td> 
	<!-- {else} -->
		<td>&nbsp;</td> 
	<!-- {/if} -->
</tr>
<!--{/foreach}-->
</table>
</body>
</html>
