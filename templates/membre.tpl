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
		<font color="red">{$message}</font><br><br>
		<table>		
		<form action="membre.php" method="POST">
			<input type="hidden" name="action" value="{$action}"/>
			<input type="hidden" name="memid" value="{$memid}"/>
			<!-- <input type="hidden" name="memuf" value="{$memuf}"/> -->
			<tr>
				<td>unitat familiar</td>
				<td>
					<select name="memuf">
						<option value=""><option>
					<!--{foreach from=$ufs item=uf name=llistatufs}-->
						<!--{if $memuf == $uf.ufid}-->
							<option value="{$uf.ufid}" selected>{$uf.ufid} - {$uf.ufname}</option>
						<!--{else}-->
							<option value="{$uf.ufid}">{$uf.ufid} - {$uf.ufname}</option>
						<!--{/if}-->
					<!--{/foreach}-->
					</select>
				</td>
			</tr>
			<tr><td>nom i cognom</td><td><input type="text" name="memnom" value="{$memnom}"/></td></tr>
			<tr><td>nom d'usuari</td><td><input type="text" name="memlogin" value="{$memlogin}"/></td></tr>
			<tr><td>contrasenya</td><td><input type="password" name="mempassword" value=""/></td></tr>
			<tr><td>tipus d'usuari</td>
				<td>
				<select name="memtipus">
					<option value="0">usuari normal</option>
				<!--{if  $memtipus != 0}-->
					<option value="1" selected>usuari administrador</option>
				<!--{elseif $membre.memtipus != 0}-->
					<option value="1">usuari administrador</option>					
				<!--{/if}-->
				</select>
			</td></tr>			
			<tr><td>telèfon</td><td><input type="text" name="memtel" value="{$memtel}"/></td></tr>
			<tr><td>correu electrònic</td><td><input type="text" name="mememail" value="{$mememail}"/></td></tr>
			<tr><td>informació adicional</td><td><input type="text" name="memextrainfo" value="{$memextrainfo}"/></td></tr>
			<tr><td colspan="2"><input type="submit" value="enviar"/></td>
		</form>
		<table>
	</body>
</html>
