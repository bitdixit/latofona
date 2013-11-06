{literal}
<script>
	function confirmExit() {
		//<dunetna>Canvi de literal
		//var ret = confirm (" Si surts ara perds totes les dades introdu�des.\n Per gravar els canvis has d'apretar el bot� de CONFIRMAR. \n Segur que vols sortir?!?!?!? ");
		var ret = confirm (" Si surts ara perds totes les dades introduïdes.\n Per gravar els canvis has d'apretar el botó de VALIDAR. \n Segur que vols sortir?!?!?!? ");
		//</dunetna>

		if (ret)
			window.location = "login.php?accio=logout";
	}
</script>
{/literal}

<div class="menu">
 | <a href="vendes.php" class="menu_opcio"><b>Vendes</b></a> | <a href="llista_productes_uf.php" class="menu_opcio"><b>Fer comanda</b></a> | <a href="membre.php?action=edit" class="menu_opcio">Edita l'usuari actual</a> | 

<!-- {if $confirm_exit == 'true'} -->
<a href="#" class="menu_opcio" onClick="javascript:confirmExit()">
	<font color="red">Sortir/Canviar Usuari</font>
</a>

<!-- {else} --> 
<a href="login.php?accio=logout" class="menu_opcio">
	<font color="red">Sortir/Canviar Usuari</font>
</a>
<!-- {/if} -->

 | <b>{$membre.memnom}</b>

<br/>
| <a href="informes.php" class="menu_opcio">Informes</a> | <a href="uf.php" class="menu_opcio">Gestió UFs</a> | 
<br>
<!--{if $membre.memtipus == 1 }-->
| <a href="mostra_productes.php?data={$dia}" class="menu_opcio">Selecciona productes per a comanda</a> | <a href="producte.php" class="menu_opcio">Gestió Productes</a> | <a href="proveidor.php" class="menu_opcio">Gestió Proveïdors</a> | <a href="membre.php" class="menu_opcio">Gestió Membres</a> | 
<!--{/if}-->
<br>
<a href="cerca.php" class="menu_opcio" onclick="window.open('cerca.php','_cerca','left='+(screen.width-520)+',top=20,width=500,height=600,toolbar=0,resizable=0,scrollbars=1'); return false;" >[Cerca per producte]</a>
 </div>
<br>
