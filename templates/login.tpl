<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Benvingut a L'Aixada</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

{literal}
<script>

</script>
{/literal}
<body>
<center>
<img src="img/titol.png" alt="La Tòfona" onclick="entra()" /><br>
<img src="img/tofonaPetita.png"" />
 <br>
<form method="post" name="visible" id="visible">
  <table border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
		<td class='cela_nom'>Login:</td>
		<td class='cela_nom'><input name="login" /></td>
    </tr>
    <tr>
		<td class='cela_nom'>Password:</td>
		<td class='cela_nom'><input type="password" name="passwd" /></td>
    </tr>
    </tbody>
  </table><br/>
 <br>
  <input type="hidden" name="accio" value="send"/>
  <input type="submit" value="Validar"/>
</form>
 </center>
</body>
</html>
