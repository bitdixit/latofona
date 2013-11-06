
Comanda/Compra del dia {$dia} - Unitat Familiar {$uf}<br/><br/>


  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
		<td class="cela_titol">Producte</td>
		<td class="cela_titol">Preu</td>
		<td class="cela_titol">Q</td>
		<td class="cela_titol">Total</td>
		<td>&nbsp;</td>
    </tr>
<!--{foreach from=$productes item=producte name=llistatproductes}-->
<!--{if $proveidor != $producte.provnom}-->
    <tr>
		<td colspan4><b>{$producte.provnom}</b></td>
		<td></td>
    </tr>
<!--{assign var="proveidor" value=$producte.provnom}-->
<!--{/if}-->
    <tr>
		<td class="cela_nom">{$producte.prodnom}</td>
		<td class="cela_preu">{$producte.prodpreu}</td>
		<td class="cela_preu_input"/>{$producte.lcquantitat}</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr>
<!--{/foreach}-->
    <tr>
		<td colspan=2>&nbsp;</td>
		<td class="cela_titol">Subtotal</td>
		<td class="cela_preu">{$subtotal}</td>
		<td>&nbsp;</td>
    </tr>
    <tr halign="right">
		<td colspan=2>&nbsp;</td>
		<td class="cela_titol">Afegit</td>
		<td class="cela_preu">{$afegit}</td>
		<td>&nbsp;</td>
    </tr>
    <tr>
		<td colspan=2>&nbsp;</td>
		<td class="cela_titol">Total</td>
		<td halign="right" class="cela_preu">{$total}</td>
		<td>&nbsp;</td>
    </tr>
  </table><br/>
