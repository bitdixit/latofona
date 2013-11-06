<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Llistat de productes</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

{literal}
<script>
var arrayCodiProductes = new Array();
function recalcularAcumulat(id) {
	eval("document.forms[0].prod_"+id+".value = commaReplace(document.forms[0].prod_"+id+".value)");
	calcularParcial(id);
	acumulatTotal();
}
function acumulatTotal() {
	preu  = 0;
	for(intIndex=0;intIndex<arrayCodiProductes.length;intIndex++) {
		preu += eval("document.forms[0].acum_"+arrayCodiProductes[intIndex]+".value * 100");
	}
	document.forms[0].acum_total.value=dividirX100(preu);
	document.forms[0].subtotal.value=dividirX100(preu);
}
function calcularParcial(id) {
	quantitat = eval("commaReplace(document.forms[0].prod_"+id+".value)");
	preu =  eval("document.forms[0].preu_"+id+".value * 100");
	elpreu = dividirX100(preu*quantitat);
	elpreuobj = new Number(elpreu);
	
	box = eval("document.forms[0].acum_"+id);
	box.value = elpreuobj.toFixed(2);
}
function recalcularTot() {
	for(intIndex=0;intIndex<arrayCodiProductes.length;intIndex++) {
		calcularParcial(arrayCodiProductes[intIndex]);
	}
	acumulatTotal();
}

function dividirX100(valor){
	// Dividim per 100 a un numero N es posar la coma dos llocs a la dreta.
	val = (valor / 100);
	return val.toFixed(2); 
}

function toggleView(divname) {
	thediv = document.getElementById(divname);
	thediv.style.display = (thediv.style.display == '') ? "none" : "";
}

function commaReplace(orig) {
	regX = /,/gi;
	return orig.replace(regX, ".");
}

function posaQuantitat() {
	producte = document.getElementById('codi').value;
	quantitat = commaReplace(document.getElementById('quantitat').value);
	eval("document.forms[0].prod_"+producte+".value = "+quantitat);
	recalcularAcumulat(producte);

	document.getElementById('codi').value = '';
	document.getElementById('quantitat').value = '';
	document.getElementById('codi').focus();
}

/*<dunetna>*/
function posarEnBlanc(obj){
	if(parseInt(obj.value)==0){
		obj.value="";
	}
}
/*</dunetna>*/

</script>
{/literal}
<body>
{include file="menu.tpl"}
<br>
Comanda <b>pel dia {$dia}</b> - Unitat Familiar {$uf}<br/>
<!--{if $action != 'venda' }-->  
&nbsp; | <!--{if $datalast != ''} --> <a href="llista_productes_uf.php?data={$datalast}" class="menu_opcio">Comanda Anterior</a>&nbsp;| <!--{/if} -->
 &nbsp;<!--{if $datanext != ''} --> <a href="llista_productes_uf.php?data={$datanext}" class="menu_opcio">Comanda Següent</a>&nbsp; | <!--{/if} --> <br><br>
<!--{/if}-->
<br/>

<!--{if $comanda_ok }-->
<font color="red"> 
<b> <br/> Comanda enviada correctament. <br/><br/></b>
</font>
<!--{/if}-->

<!--{if count($productes) > 0 }-->

codi: <input type="text" id="codi"/>  
quantitat: <input type="text" id="quantitat"/> 
&nbsp;&nbsp;<a href="#" onClick="javascript:posaQuantitat()"><b>-> Afegir</b></a><br/><br/>
<form method="post" name="prodlist" id="visible">

<!--{if $action != 'venda' }-->  
  <input type="hidden" name="accio" value="send"/>
  <input type="hidden" name="datDia" value="{$dia}"/>
  <input type="submit" value="Validar"/>
<!--{else}-->
  <input type="hidden" name="accio" value="venda"/>
  <input type="submit" value="Confirmar Compra ->"/>
<!--{/if}-->

  <table>
    <tr>
		<td class="cela_titol" width="40"></td>
		<td class="cela_nom">&nbsp;</td>
		<td class="cela_preu" width="50">&nbsp;</td>
		<td class='cela_titol' width="55">Subtotal</td>
		<td><input name="subtotal" value="0" size="10" class='cela_preu' disabled/></td>
		<td>&nbsp;</td>
    </tr>
    <tr>
    		<td class='cela_titol'  width="40">Codi</td>
    		<td class='cela_titol' width="400">Producte</td>
		<td class='cela_titol' width="50">Preu</td>
		<td class='cela_titol' width="50">Q</td>
		<td class='cela_titol' width="50">Total</td>
		<td></td>

    </tr>
  </table>
<!--{assign var="divset" value='false'}-->
<!--{foreach from=$productes item=producte name=llistatproductes}-->
<!--{if $proveidor != $producte[5]}-->
	<!--{if $divset == 'true'}-->
		</div>
	<!--{else}-->
		<!--{assign var="divset" value='true'}-->
	<!--{/if}-->
  <table>    
    <tr>
		<td colspan=4><b><a href="#{$producte[5]}" onClick="javascript:toggleView('{$producte[5]}')">{$producte[4]}</a></b></td>
		<td></td>
    </tr>
  </table>    
    <div id="{$producte[5]}" style="display:none"><a name="{$producte[5]}"></a>
<!--{assign var="proveidor" value=$producte[5]}-->
<!--{/if}-->
  <table>
    <tr>
		<td class='cela_titol' width="40">{$producte[0]}</td>
		<td class='cela_nom'>{$producte[1]}</td>
		<td class='cela_preu'>{$producte[2]}</td>
		<!-- <dunetna> canvi d'event i afegir un altre event
		<td><input name="prod_{$producte[0]}" value="{$producte[3]}" size="10" class='cela_preu_input' onChange="javascript:recalcularAcumulat({$producte[0]})"/></td>-->
		<td><input name="prod_{$producte[0]}" value="{$producte[3]}" size="10" class='cela_preu_input' onfocus="posarEnBlanc(this)" onkeyup="javascript:recalcularAcumulat({$producte[0]})"/></td>
		<!-- </dunetna> -->
		<td><input name="acum_{$producte[0]}" size="10" class='cela_preu' disabled/></td>
		<td><input type="hidden" name="preu_{$producte[0]}" value="{$producte[2]}" /></td>
		<script>
			arrayCodiProductes[arrayCodiProductes.length] = {$producte[0]};
		</script>
    </tr>
  </table>
<!--{/foreach}-->
	</div> <!-- closing the last div.. -->
  <table>
    <tr>
		<td class="cela_titol" width="40"></td>
		<td class="cela_nom">&nbsp;</td>
		<td class="cela_preu" width="50">&nbsp;</td>
		<td class='cela_titol' width="55">Subtotal</td>
		<td><input name="acum_total" value="0" size="10" class='cela_preu' disabled/></td>
		<td>&nbsp;</td>
    </tr>
  </table><br/>
<!--{if $action != 'venda' }-->  
  <input type="hidden" name="accio" value="send"/>
  <input type="hidden" name="datDia" value="{$dia}"/>
  <input type="submit" value="Validar"/>
<!--{else}-->
  <input type="hidden" name="accio" value="venda"/>
  <input type="submit" value="Confirmar Compra->"/>
<!--{/if}-->

</form>
<!--{else}-->
Per el dia {$dia}, encar&agrave; no hi ha productes sel.leccionats. !! I no es poden fer commandes !!
<!--{/if}-->
</body>
<script>
recalcularTot();
</script>
</html>
