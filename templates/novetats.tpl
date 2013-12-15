<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Novetats</title>
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Novetats (en proves)</h1>
<h4>S'ha detectat que han canviat els següents productes respecte<br>la setmana anterior</h4> 
<br>
<table cellspacing="3" cellpadding="2">
<tr>
	<td></td>
	<td class='cela_titol'><b>Producte</b></td>
	<td class='cela_titol'><b>Proveidor</b></td>
	<td class='cela_titol'><b>€</b></td>
	<td class='cela_titol'><b>Canvi</b></td>
</tr>

<!--{foreach from=$changes item=change}-->
<tr>
	<td>{$change.prodid}</td>
	<td>{$change.prodnom}</td>
	<td>{$change.provnom}</td>
	<td>{$change.prodpreu}</td>
	<td>{$change.type} {$change.change}</td>
</tr>
<!--{/foreach}-->
</table>
</body>
</html>
