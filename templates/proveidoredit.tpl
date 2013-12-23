<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Proveidors</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Alta/Modificaciò proveidor...</h1>
<br><br>

<form method="POST">
	<input type="hidden" name="action" value="{$action}"/>
<table> 
	<tr>
		<td>Nom proveidor:</td>
		<td><input type="text" name="provnom" value="{$prov.provnom}"/></td>
	</tr>
	<tr>
		<td>Telèfon:</td>
		<td><input type="text" name="provtelefon" value="{$prov.provtelefon}"/></td>
	</tr>
	<tr>
		<td>Fax:</td>
		<td><input type="text" name="provfax" value="{$prov.provfax}"/></td>
	</tr>
	<tr>
		<td>Responsable:</td>
		<td><input type="text" name="provresponsable" value="{$prov.provresponsable}"/></td>
	</tr>
	<tr>
		<td>Telèfon responsable:</td>
		<td><input type="text" name="provtelefonresponsable" value="{$prov.provtelefonresponsable}"/></td>
	</tr>
	<tr>
		<td>Més informació:</td>
		<td><textarea name="provextrainfo">{$prov.provextrainfo}</textarea></td>
	</tr>
	<tr>
<td>
<input type="button" onclick="location.href='proveidor.php'" value="< Enrere"/>
<input type="submit" value="Desar"/></td><td>&nbsp;</td></tr>
</table>	
</form>
<br>
Si vols que per internet aquest proveidor només el pugui editar algunes cistelles en concret,<br>
posa al camp de Responsable, els numeros de cistella entre claudàtors, per exemple:<br>
- <b>Josep maria, [12] [14]</b>  -> (només ho podràn editar les cistelles 12 i 14)<br>

</table>
</body>
</html>
