<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Edita una unitat familiar</h1>

<form method="POST">
	<input type="hidden" name="action" value="{$action}"/>
<table> 
	<tr><td>UF:</td> <td><!--{if $action == 'add'}--><input type="text" name="ufid"/><!--{else}--><input type="text" name="ufid" value="{$uf.ufid}" readonly="true"/><!--{/if}--></td></tr>
	<tr><td>Nom unitat familiar:</td> <td><input type="text" name="ufname" value="{$uf.ufname}"/></td></tr>
	<tr><td>Persona contacte:</td> <td><input type="text" name="ufcontact" value="{$uf.ufcontact}"/></td></tr>
	<tr><td>Adreça etc:</td> <td><input type="text" name="ufaddress" value="{$uf.ufaddress}"/></td></tr>
	<tr><td>Saldo:</td> <td>{$uf.ufval} &euro;</td></tr>
	<tr><td><br><input type="button" onclick="location.href='uf.php'" value="< Enrere"><input type="submit" value="Desar"/></td><td>&nbsp;</td></tr>
</table>	
</form>

</table>
</body>
</html>
