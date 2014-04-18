{literal}
<script>

// Copyright 2006-2007 javascript-array.com

var timeout	= 500;
var closetimer	= 0;
var ddmenuitem	= 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

</script>
{/literal}

Has entrat com <b>{$membre.memnom}</b> com a
<!-- {if $membre.memtipus == 0} -->
USUARI BASIC
<!-- {elseif $membre.memtipus == 1} -->
GESTOR PROVEIDORS
<!-- {elseif $membre.memtipus == 2} -->
ADMINISTRADOR
<!-- {elseif $membre.memtipus == 3} -->
SUPERADMINISTRADOR
<!-- {/if} -->

<ul id="sddm">
    <li><a href="#" 
        onmouseover="mopen('m1')" 
        onmouseout="mclosetime()">La meva cistella</a>
        <div id="m1" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="vendes.php?uf={$membre.memuf}">Confirmar venda aquesta setmana</a>
        <a href="comanda_cistella.php">Fer comanda per la proxima setmana</a>
<a href="#">-----------------------------------------</a>	
<a href="cerca.php" onclick="window.open('cerca.php','_cerca','left='+(screen.width-520)+',top=20,width=500,height=600,toolbar=0,resizable=0,scrollbars=1'); return false;" >Cerca de productes</a>
<!--	    <a href="novetats.php">Novetats de la setmana</a> -->
        </div>
    </li>
   <li><a href="#" 
        onmouseover="mopen('mt')" 
        onmouseout="mclosetime()">Torn</a>
        <div id="mt" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="#">Torn divendres ----------------------------------</a>
        <a href="vendes.php">&nbsp;&nbsp;Cobrar venda d'una altre cistella </a>
        <a href="informes.php?informe=vendespendents">&nbsp;&nbsp;Vendes Pendents</a>
        <a href="informes.php?informe=ingresostotalsperdia">&nbsp;&nbsp;Ingresos Totals Per Dia</a>
        <a href="informes.php?informe=resumtorn">&nbsp;&nbsp;Informe resum de torn</a>
        <a href="#">Recompte ---------------------------------</a>
        <a href="comanda_proveidors.php">&nbsp;&nbsp;Comandes (totals) a proveïdors</a>

        </div>
    </li>
    
    <li><a href="#" 
        onmouseover="mopen('torn2')" 
        onmouseout="mclosetime()">Informes</a>
        <div id="torn2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="informes.php?informe=vendestotals">Historic de vendes</a>

        <a href="informes.php?informe=registre">Registre operacions</a>
        </div>
    </li>

    <li><a href="#" 
        onmouseover="mopen('m2')" 
        onmouseout="mclosetime()">Gestió</a>
        <div id="m2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="proveidor.php">Gestio Proveïdors/Productes</a>
        <a href="uf.php">Gestio UFs i Membres</a>
        <a href="data.php">Gestio dates</a>
        </div>
    </li>

    <li><a href="#" 
        onmouseover="mopen('m6')" 
        onmouseout="mclosetime()">Coordinació</a>
        <div id="m6" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="calendari.php">Calendari</a>
        <a href="arxius.php">Arxius importants</a>
        </div>
    </li>


    <li><a href="login.php?accio=logout">Sortir</a></li>
</ul>
<div style="clear:both"></div>
