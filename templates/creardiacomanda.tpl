<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Dia de comanda/compra</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>
<body>
{include file="menu.tpl"}
<br>
<br>
<a href="?data={$lastdate}">{$lastdate}</a> és l'última data de comandes. <br>
Vols crear una nova data de comanda?<br>
Omple els valors del formulari i envia'l.<br><br>
	<form method="POST">
		any: <input type="text" name="year" size="4" value="{$year}"> 
		mes: <input type="text" name="month" size="2" value="{$month}"> 
		dia: <input type="text" name="day" value="{$day}" size="2"> <br><br>
		<input type="submit" value="Crear nova data de comanda"/>
	</form>
</body>
</html>