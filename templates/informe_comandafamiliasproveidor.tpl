<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Informes!!!</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>
<input type="button" value="< Enrere" onclick="history.back()"<br><br>

Proveidor: <b>{$proveidor.provnom}</b><br>
Tel: <b>{$proveidor.provtelefon}</b><br>
Fax: <b>{$proveidor.provfax}</b><br>

<br>
Resposable: <b>{$proveidor.provresponsable}</b><br>
Tel Responsable: <b>{$proveidor.provtelefonresponsable}</b><br>

<br>
Comanda pel dia:<br>
<b>{$dia}</b><br><br>


<!-- {if isset($families) } -->
<table border="1">
<tr>
<td>&nbsp;</td>
<!--{foreach from=$families item=uf name=ufff}-->
	<td align="center"><b>{$uf.ufid}</b></td>	
<!--{/foreach} -->
</tr>

<!--{foreach from=$productes item=producte name=pufff}-->
<tr>
	<td><b>{$producte.prodnom}</b></td>
	<!--{foreach from=$families item=uf name=ufff}-->
		<td>{$comanda[$producte.prodid][$uf.ufid]|replace:".":","}</td>
	<!--{/foreach} -->
</tr>
<!--{/foreach} -->
</table>

<!--{/if} -->
</body>
</html>
