<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Proveidors</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
{literal}
<script>
function informeConsum(provid)
{
	var inici = window.prompt("Data inici? (aaaa-mm-dd)");
	var fi = window.prompt("Data final? (aaaa-mm-dd)");
	if (inici!=null && fi!=null)
		location.href="informes.php?informe=consumprov&provid="+provid+"&inici="+inici+"&fi="+fi;
}	
</script>
{/literal}

<h1>Proveïdors</h1>
<br>
{$message}
<table cellspacing="3" cellpadding="2">
<tr>
	<td class="cela_titol" >Proveidor</td>
	<td class="cela_titol" >Opcions</td>
</tr>
<!--{foreach from=$provs item=prov name=elsprovs}-->
<tr border="2" >
	<td class='cela_generica'>{$prov.provnom}</td>
	<td class='.cela_generica'><a href="?action=edit&provid={$prov.provid}">[Editar]</a>
	<a href="producte.php?provid={$prov.provid}">[Productes]</a>
	<a href="mostra_productes.php?data={$dia}&provid={$prov.provid}">[Comanda]</a>
	<a href="#" onclick="javascript:informeConsum({$prov.provid})">[Inf.Consum]</a></td>
</tr>
<!--{/foreach}-->
</table>
<br>
<input type="button" value="Afegeix un proveidor" onclick="location.href='?action=new'">
<br>

</body>
</html>
