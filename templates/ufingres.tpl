<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Ingresar a Unitat Familiar</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
{literal}
<script>
function confirm() {
	alert 'segurrRRRRRrrrrrrr??????';
}
</script>
{/literal}

<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<br>
<h1>
Ingresar a la unitat familiar {$uf.ufid}<br>{$uf.ufname}</h1>
<br>
<form method="POST">
	<input type="hidden" name="action" value="{$action}"/>
	<input type="hidden" name="inuf" value="{$uf.ufid}"/>
<table> 
	<tr><td>Quantitat:</td> <td><input type="text" name="inquantitat"/></td></tr>
	<tr><td>Nota (opcional):</td> <td><input type="text" name="innota"</td></tr>
	<tr><td>Persona ingresant:</td> <td><input type="hidden" name="inmemid" value="{$membre.memid}"/>{$membre.memnom}</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><input type="button" onclick="location.href='uf.php'" value="< Enrere"><input type="submit" value="Ingressar >"/></td><td>&nbsp;</td></tr>
</table>	
</form>

</table>
</body>
</html>
