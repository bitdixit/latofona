
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Comandes a proveidors</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="css/taula.css" rel="stylesheet" type="text/css" />
</head>
<body>
{include file="menu.tpl"}

<!--{if $dia == ''}-->
Ja no n'hi ha dies de comandes....<br/>	
<a href="comanda_proveidors.php" class="menu_opcio">Tornar a comandes a proveidors</a>
<!--{else}-->
Comanda per recollir el dia <b>{$dia}</b><br/>
&nbsp;<a href="comanda_proveidors.php?data={$dia}&data_direccio=1" class="menu_opcio">Selecciona comanda anterior</a>&nbsp;|
&nbsp;<a href="comanda_proveidors.php?data={$dia}&data_direccio=2" class="menu_opcio">Selecciona comanda següent</a>&nbsp;<br/>

<!--{if count($productes) > 0 }-->
<br/>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
		<td class='cela_titol'>Producte</td>
		<td class='cela_titol'>Quantitat Total</td>
		<td class='cela_titol'>Preu</td>
		<td></td>

    </tr>

<!--{foreach from=$productes item=producte name=llistatproductes}-->
<!--{if $proveidor != $producte.provnom}-->
    <tr>
		<td colspan="4"><b>{$producte.provnom}</b> &nbsp;&nbsp;&nbsp; Responsable: {$producte.provresponsable}&nbsp;&nbsp; <a href="informes.php?informe=comandafamiliasproveidor&provid={$producte.provid}&data={$dia}">Detalls</a></td>
    </tr>
<!--{assign var="proveidor" value=$producte.provnom}-->
<!--{/if}-->
    <tr>
		<td class='cela_nom'>{$producte.prodnom}</td>
		<td class='cela_nom'>{$producte.lcquantitattotal|replace:".":","}</td>
		<td class='cela_nom'>{$producte.lcpreuunitat|replace:".":","}</td>
    </tr>
<!--{/foreach}-->
  </table><br/>

<!--{else}-->
Per el dia {$dia}, encar&agrave; no hi ha productes demanats.
<!--{/if}-->

<!--{/if}--> 
</body>
</html>
