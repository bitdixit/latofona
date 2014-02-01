<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>
{include file="menu.tpl"}
<h1>Afegir/Modificar membre</h1>
<br>
		<font color="blue">{$message}</font><br><br>
		<table>		
		<form action="membre.php" method="POST">
			<input type="hidden" name="action" value="{$action}"/>
			<input type="hidden" name="memid" value="{$memid}"/>
			<!-- <input type="hidden" name="memuf" value="{$memuf}"/> -->
			<tr>
				<td>Unitat familiar</td>
				<td>
					<select name="memuf">
					<!--{foreach from=$ufs item=uf name=llistatufs}-->
						<option value="{$uf.ufid}" selected>{$uf.ufid} - {$uf.ufname}</option>
					<!--{/foreach}-->
					</select>
				</td>
			</tr>
			<tr><td>Nom i cognom</td><td><input type="text" name="memnom" value="{$memnom}"/></td></tr>
			<tr><td>Nom d'usuari</td><td><input type="text" name="memlogin" value="{$memlogin}"/></td></tr>
			<tr><td>Contrasenya</td><td><input type="password" name="mempassword" value=""/></td></tr>
			<tr><td>Tipus d'usuari</td>
				<td>
				<select name="memtipus">
					<option value="0">Usuari normal</option>
				<!--{if  $memtipus != 0}-->
					<option value="1" selected>Usuari administrador</option>
				<!--{elseif $membre.memtipus != 0}-->
					<option value="1">Usuari administrador</option>					
				<!--{/if}-->
				</select>
			</td></tr>			
			<tr><td>Telèfon</td><td><input type="text" name="memtel" value="{$memtel}"/></td></tr>
			<tr><td>Correu electrònic</td><td><input type="text" name="mememail" value="{$mememail}"/></td></tr>
			<tr><td>Informació adicional</td><td><input type="text" name="memextrainfo" value="{$memextrainfo}"/></td></tr>
			<tr><td colspan="2"><input type="button" value="< Enrere" onclick="location.href='membre.php'"><input type="submit" value="Desar"/></td>
		</form>
		<table>
	</body>
	<br>
	
</html>
