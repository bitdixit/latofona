<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Proveidors</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<br>
{$message}
<br>
<a href="?action=new">Afegeix un proveidor...</a><br>
<br>
Edita un proveidor...<br>
<table border="1" cellspacing="3" cellpadding="2">
<tr>
	<td>Proveidor</td>
	<td>Editar</td>
</tr>
<!--{foreach from=$provs item=prov name=elsprovs}-->
<tr>
	<td>{$prov.provnom}</td>
	<td><a href="?action=edit&provid={$prov.provid}">editar</a></td>
</tr>
<!--{/foreach}-->
</table>
</body>
</html>
