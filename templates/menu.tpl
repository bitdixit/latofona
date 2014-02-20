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

Has entrat com <b>{$membre.memnom}</b>
<ul id="sddm">
    <li><a href="#" 
        onmouseover="mopen('m1')" 
        onmouseout="mclosetime()">Vendes/Comandes</a>
        <div id="m1" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="vendes.php">Vendes</a>
        <a href="comanda_cistella.php">Fer comanda</a>
	    <a href="cerca.php" onclick="window.open('cerca.php','_cerca','left='+(screen.width-520)+',top=20,width=500,height=600,toolbar=0,resizable=0,scrollbars=1'); return false;" >Cerca de productes</a>
	    <a href="novetats.php">Novetats de la setmana</a>
        </div>
    </li>
    <li><a href="#" 
        onmouseover="mopen('torn2')" 
        onmouseout="mclosetime()">Informes</a>
        <div id="torn2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="informes.php?informe=vendespendents">Vendes Pendents</a>
        <a href="informes.php?informe=ingresostotalsperdia">Ingresos Totals Per Dia</a>
        <a href="comanda_proveidors.php">Comandes (totals) a proveïdors</a>
        <a href="informes.php?informe=vendestotals">Vendes Totals Per tots els Dies</a>
        <a href="informes.php?informe=registre">Registre operacions</a>
        </div>
    </li>
<!--{if $membre.memtipus == 1 }-->
    <li><a href="#" 
        onmouseover="mopen('m2')" 
        onmouseout="mclosetime()">Gestió</a>
        <div id="m2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="proveidor.php">Gestio Proveïdors/Productes</a>
        <a href="uf.php">Gestio UFs i Membres</a>

        </div>
    </li>
<!--{else}-->
    <li><a href="#" 
        onmouseover="mopen('m2')" 
        onmouseout="mclosetime()">Gestió</a>
        <div id="m2" 
            onmouseover="mcancelclosetime()" 
            onmouseout="mclosetime()">
        <a href="membre.php?action=edit">Editar el meu compte</a>
        </div>
    </li>
<!--{/if}-->

    <li><a href="login.php?accio=logout">Sortir/Canviar Usuari</a></li>
</ul>
<div style="clear:both"></div>
