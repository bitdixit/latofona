<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Confirmació de la compra</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>

<body>
{include file="menu.tpl"}



<!--{if $action != 'checkout'} -->
    <h1>Confirmada venda dia {$dia}<br>Unitat Familiar {$uf}</h1>
	Unitat Familiar {$UF.ufid} - <b>{$UF.ufname}</b> ha gastat {$total}&euro;<br>
	Li queda: <font color="red"><b>{$UF.ufval}</b></font><br><br><br>
	
	<a href="vendes.php">altre venda?</a><br><br>
<!--{else} --> 
	<!--{if $uf != $membre.memuf}-->
	    <h1>Confirmar venda dia {$dia}<br>Unitat Familiar {$uf}<br>i afegir credit</h1>
	<!--{else} -->
	    <h1>Actualitzada venda dia {$dia}<br>Unitat Familiar {$uf}</h1>
    <!--{/if} -->
	<input type="button" value="< Torna enrera per modificar productes o quantitats" onclick='location.href="vendes.php?uf={$uf}&data={$dia}"'><br><br>
<!-- {/if} -->

<!--{if count($productes) > 0 }-->

<!--{if $goodip == 'true'} -->
	<form method="post" name="visible" id="visible">
<!-- {/if} -->  
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
		<td class="cela_titol">Producte</td>
		<td class="cela_titol">Preu</td>
		<td class="cela_titol">Q</td>
		<td class="cela_titol">Total</td>
		<td>&nbsp;</td>
    </tr>

<!--{foreach from=$productes item=producte name=llistatproductes}-->
<!--{if $proveidor != $producte[5]}-->
    <tr>
		<td colspan4><b>{$producte[4]}</b></td>
		<td></td>
    </tr>
<!--{assign var="proveidor" value=$producte[5]}-->
<!--{/if}-->
    <tr>
		<td class="cela_nom">{$producte[1]}</td>
		<td class="cela_preu">{$producte[2]}</td>
		<td class="cela_preu_input"/>{$producte[3]}</td>
		<td class="cela_preu">{$producte[3]*$producte[2]}</td>
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
	<!--{if $action == 'checkout'} -->   
<table border="1px">
<tr>
	<!--<dunetna> canvi de literal
	<td>Val d'estoc abans de la compra: </td>-->
	<td>Crèdit abans de la compra: </td>
	<!--</dunetna>-->
	<td>{$UF.ufval} &euro;</td>
</tr>
<tr>
	<!--<dunetna> canvi de literal
	<td>Val d'estoc despr�s ser�: </td><td><b>{$nouval} &euro;</b></td>-->
	<td>Crèdit després serà: </td><td><b>{$nouval} &euro;</b></td>
	<!--</dunetna>-->
</tr>
</table>  
<br><br>
	<!--{if $uf != $membre.memuf}-->
		<!--{if $goodip == 'true'} -->
			<!--<dunetna> canvi de literal
			<b>AFEGIR VAL D'ESTOC!!!<b><br/>-->
			<b>AFEGIR CRÈDIT!!!<b><br/>
			<!--</dunetna>-->
			<table> 
				<tr><td>quantitat:</td> <td><input type="text" name="inquantitat"/></td></tr>
				<!--<dunetna> Error de tag mal tancat
				<tr><td>nota (opcional):</td> <td><input type="text" name="innota"</td></tr>-->
				<tr><td>nota (opcional):</td> <td><input type="text" name="innota" /></td></tr>
				<!--</dunetna>-->
				<tr><td>persona ingresant:</td> <td><input type="hidden" name="inmemid" value="{$membre.memid}"/>{$membre.memnom}</td></tr>
			</table>	
		    
		    <br/><br/>
			<input type="hidden" name="accio" value="{$action}"/>
			<input type="submit" value="Siiiiiiiii ->"/>
			</form>
		<!--{else} -->
			<b>NO ET POTS COBRAR/COMPRAR DES D'AQUEST ORDINADOR<br>La compra ha estat gravada però encara no s'ha cobrat.<br>Passa per caixa si us plau.</b>
		<!-- {/if}-->
	<!--{else} -->
		<b>NO ET POTS VENDRE A TU MATEIX!!!!!<br>La teva compra ha estat gravada però encara no s'ha cobrat.<br>Passa per caixa si us plau.</b>
	<!--{/if} -->
	<!--{/if}-->	
<!--{else}-->
Pel dia {$dia}, encara no hi ha productes sel.leccionats.
<!--{/if}-->
</body>
</html>
