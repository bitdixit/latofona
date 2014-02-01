<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>
<body>

{literal}
<script>

function confirmAndGo(msg,url)
{
	if(window.confirm(msg))
		location.href = url;
}

</script>
{/literal}


{include file="menu.tpl"}
<h1>Gestiò membres</h1>
<font color="blue">{$message}</font><br>
<!--{if $membre.memtipus != 0} //admin user -->
<table>
	<tr><td class="cela_titol">UF</td><td class="cela_titol">Membre</td><td class="cela_titol">Opcions</td></tr>
	<!-- {foreach from=$membres item=themembre name=membrelist} -->
	<tr>
		<td class='cela_generica'>{$themembre.memuf}</td>
		<td class='cela_generica'>{$themembre.memnom}</td>
		<td class='cela_generica'><a href="?action=edit&memid={$themembre.memid}">[Editar]</a>
		<a href="#" onclick="confirmAndGo('Segur que vols esborrar aquest membre?','membre.php?memid={$themembre.memid}&action=delete');">[Esborrar]</a></td>
	</tr>
	<!--{/foreach} -->
</table>
<br>
<input type="button" value="Afegir nou usuari" onclick="location.href='?action=add'">
<!-- {/if} -->
</body>
</html>
