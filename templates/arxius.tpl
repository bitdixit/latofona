<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Arxius</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}

<h1>Arxius</h1>
<br>
<table cellspacing="3" cellpadding="2">
<tr>
	<td class="cela_titol" >Arxiu</td>
        <td class="cela_titol" >Titol</td>
        <td class="cela_titol" >Data</td>
        <td class="cela_titol" >Pujat per</td> 
	<td class="cela_titol" >Opcions</td>
</tr>
<!-- {foreach from=$arxius item=arxiu name=elarxiu} -->
<tr border="2" >
	<td class='cela_generica'><a href="arxius.php?download={$arxiu.id}">{$arxiu.name}</a></td>
        <td class='cela_generica'>{$arxiu.description}</td>
<td class='cela_generica'>{$arxiu.created}</td>
<td class='cela_generica'>{$arxiu.uploadedby}</td>
<td class='cela_generica'></td>
</tr>
<!-- {/foreach} -->
</table>
<br>
<h2>Afegir un nou arxiu</h2>
(nomes es poden afegir arxius de fins a 2MB!)<br>
<form action="arxius.php" method="post" enctype="multipart/form-data">
<table>
<tr><td>Arxiu</td><td><input type="file" name="uploaded_file"></td>
</tr><tr><td>Descripcio</td><td><input type="text" name="description"></td>
<tr><td>
<input type="submit" value="Afegir arxiu >">
</td></tr>
</table>
    </form>
<br>

</body>
</html>
