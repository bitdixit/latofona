<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>

{literal}
<script>

function confirmAndGo(msg,url)
{
	if(window.confirm(msg))
		location.href = url;
}

</script>
{/literal}

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
		                
                                <!--{if $membre.memtipus == 3}-->
                                <!--{if $memtipus == 0}-->
                                <option value="0" selected>USUARI BASIC</option>
                                <!-- {else} -->
                                <option value="0">USUARI BASIC</option>
				<!--{/if}-->
                                <!--{if $memtipus == 1}-->
                                <option value="1" selected>GESTOR PROVEIDORS</option>
                                <!-- {else} -->
                                <option value="1">GESTOR PROVEIDORS</option>
                                <!--{/if}-->
                                <!--{if $memtipus == 2}-->
                                <option value="2" selected>ADMINISTRADOR</option>
                                <!-- {else} -->
                                <option value="2">ADMINISTRADOR</option>
                                <!--{/if}-->
                                <!--{if $memtipus == 3}-->
                                <option value="3" selected>SUPERADMINISTRADOR</option>
                                <!-- {else} -->
                                <option value="3">SUPERADMINISTRADOR</option>
                                <!--{/if}-->
                                <!--{/if}-->

                                <!--{if $membre.memtipus < 3} -->
                                <!--{if $memtipus == 3}-->
                                <option value="3" selected>SUPERADMINISTRADOR</option>
                                <!-- {else} -->
                                <!--{if $memtipus == 0}-->
                                <option value="0" selected>USUARI BASIC</option>
                                <!-- {else} -->
                                <option value="0">USUARI BASIC</option>
                                <!--{/if}-->
                                <!--{if $memtipus == 1}-->
                                <option value="1" selected>GESTOR PROVEIDORS</option>
                                <!-- {else} -->
                                <option value="1">GESTOR PROVEIDORS</option>
                                <!--{/if}-->
                                <!--{if $memtipus == 2}-->
                                <option value="2" selected>ADMINISTRADOR</option>
                                <!-- {else} -->
                                <option value="2">ADMINISTRADOR</option>
                                <!--{/if}-->
                                <!--{/if}-->
                                <!--{/if}-->


               

</select>
<table>
<tr><td>USUARI BASIC</td><td>Pot fer comandes i vendes</td></tr>
<tr><td>USUARI GESTOR PROVEIDORS</td><td>Pot fer comandes, vendes, gestionar proveidors i productes</td></tr>
<tr><td>USUARI ADMINISTRADOR</td><td>Pot fer comandes, vendes, gestionar proveidors, productes, membres i UFs</td></tr>
<tr><td>USUARI SUPERADMINISTRADOR</td><td>Pot fer comandes, vendes, gestionar proveidors, productes, membres, UFs i fer ingressos/vendes per internet</td></tr>
</table> 
			</td></tr>			
			<tr><td>Telèfon</td><td><input type="text" name="memtel" value="{$memtel}"/></td></tr>
			<tr><td>Correu electrònic</td><td><input type="text" name="mememail" value="{$mememail}"/></td></tr>
			<tr><td>Informació adicional</td><td><input type="text" name="memextrainfo" value="{$memextrainfo}"/></td></tr>
			<tr><td colspan="2"><input type="button" value="< Enrere" onclick="location.href='uf.php'">
                        <!-- {if $membre.memtipus >= $memtipus &&  $membre.memtipus >=2} -->
                       <input type="submit" value="Desar"/>
                        <!--{if  $action == 'modify' }-->
				<input type="button" value="Esborrar" onclick="confirmAndGo('Segur que vols esborrar aquest membre?','membre.php?memid={$memid}&action=delete');">
			<!--{/if}-->
                        <!- {/if } -->
</td>
		</form>
		<table>
	</body>
	<br>
	
</html>
