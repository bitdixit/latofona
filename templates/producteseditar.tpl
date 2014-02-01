<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Gestió de Productes {$provnom}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
{literal}
<script>

function confirmAndGo(msg,url)
{
	if(window.confirm(msg))
		location.href = url;
}

</script>
{/literal}

<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}

<br/>
<!--{if $stockedit !='true'} -->
	<h1>Gestiò de productes {$provnom}</h1>
<!--{else} -->
	<h1>Afegir stock {$provnom}</h1>
	<h4>Pots posar stock negatiu per ajustar l'actual</h4>
<!--{/if}-->
<font color="blue">{$message}</font>  
<br>
<form method="POST">
  <table border="0" cellspacing="3" cellpadding="3">
    <tr>
		<td>&nbsp;</td>
    		<td class='cela_titol' width="400">Producte</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_titol'>Preu inicial</td>
		<td class='cela_titol'>IVA aplicat</td>
		<!--{/if}-->
		<td class='cela_titol' width="50">Preu Final</td>
		<td class='cela_titol'>En estoc</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_titol'>Estoc a afegir</td>
		<!--{else}-->
		<td class='cela_titol'>Opcions</td>
		<!--{/if}-->
		<td></td>

    </tr>
   
<!--{foreach from=$productes item=producte name=llistatproductes}-->
    <tr>
		<td>&nbsp;</td>
		<td class='cela_nom'>{$producte.prodnom}</td>
		<!--{if $stockedit=='true'} -->
		<td class='cela_preu'>{$producte.prodpreuinicial}</td>
		<td class='cela_preu'>{$producte.prodiva} %</td>
		<!--{/if}-->
		<td class='cela_preu'>{$producte.prodpreu}</td>
		<td class='cela_preu'>{$producte.prodstockactual}</td>
		<!--{if $stockedit=='true'} -->
		<td align="center" width="70"><input type="text" name="prod[{$producte.prodid}]" size="5"/>
		<!--{else}-->
		<td class='cela_generica'><a href="producte.php?action=edit&prodid={$producte.prodid}">[Editar]</a>
		<a href="#" onclick="javascript:confirmAndGo('Segur?','producte.php?action=delete&provid={$provid}&prodid={$producte.prodid}')">[Eliminar]</a></td>
		<!--{/if}--></td>
    </tr>

<!--{/foreach}-->
  </table>
	</div> <!-- closing the last div.. -->
<!--{if $stockedit=='true'} -->
<br>
<input type="hidden" name="action" value="stockupdate">
<input type="button" onclick="location.href='?provid={$provid}'" value="< Cancelar">
<input type="submit" name="stockupdate" value="Actualitzar estock >">
<!--{else}-->
<br>
<input type="button" onclick="location.href='proveidor.php'" value="< Enrere">
<input type="button" onclick="location.href='producte.php?action=editall&stockedit=true&provid={$provid}'" value="Afegir stocks">
<input type="button" onclick="location.href='?action=add&provid={$provid}'" value="Afegir nou producte">
<!--{/if}-->
</form>

</body>
</html>
