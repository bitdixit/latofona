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
<!-- <a href="?action=new">Afegeix una unitat familiar...</a><br> -->
<table cellspacing="3" cellpadding="2">
<tr>
	<td class="cela_titol">UF</td>
	<td class="cela_titol">Nom</td>
	<td class="cela_titol">Crèdit</td>
	<td class="cela_titol">Opcions</td>
	<td class="cela_titol">Membres</td>
</tr>
<!--{foreach from=$ufs item=uf name=elsufs}-->
<tr>
	<td class='cela_generica'>{$uf.ufid}</td>
	<td class='cela_generica'>{$uf.ufname}</td>
	<td class='cela_generica'>{$uf.ufval} &euro;</td>
	<td class='cela_generica'><a href="?action=edit&ufid={$uf.ufid}">[Editar]</a>
	<a href="informes.php?informe=uflogs&ufid={$uf.ufid}">[Registre]</a>
	<!-- {if $membre.memuf != $uf.ufid} -->
		<a href="?action=ingres&ufid={$uf.ufid}">[Ingressar]</a> 
	<!-- {else} -->
	<!-- {/if} -->
	</td>
	<td class='cela_generica'>
	<!--{foreach from=$membres item=membreit name=membrename} -->
	    <!-- {if $membreit.memuf == $uf.ufid } -->
		<a href='membre.php?action=edit&memid={$membreit.memid}'>&nbsp;{$membreit.memnom}&nbsp;</a>
	    <!-- {/if} -->
	<!--{/foreach} -->
	</td>
</tr>
<!--{/foreach}-->
</table>
<br>
<input type="button" value="Afegir nou usuari" onclick="location.href='membre.php?action=add'">
</body>
</html>
