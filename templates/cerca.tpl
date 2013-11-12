<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>CERCA DE PRODUCTES</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />

{literal}
<script type="text/javascript">
function FocusInput()
{
   document.getElementById("nomproducte").focus();
}
</script>
{/literal}
</head>

<body onload="FocusInput()">
<h2>CERCA DE PRODUCTES (EN PROVES)</h2>
<form method="post" name="visible" id="visible">
  <table border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
		<td class='cela_nom'>Nom producte:</td>
		<td class='cela_nom'><input id="nomproducte" name="nomproducte" /></td>
    </tr>
    <tr>
		<td class='cela_nom'>Només disponibles:</td>
		<td class='cela_nom'><input type="checkbox" name="disponibles" CHECKED/></td>
    </tr>
    </tbody>
  </table><br/>
  <input type="hidden" name="action" value="search"/>
  <input type="submit" value="Cerca"/>
</form>
</body>
</html>
