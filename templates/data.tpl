<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dates</title>
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Dates</h1>
<br>
<table cellspacing="3" cellpadding="2">
<tr>
	<td class="cela_titol">Data</td>
        <td class="cela_titol">Permetre comanda</td>
	<td class="cela_titol">Confirmar venda</td>
        <td class="cela_titol">Cobrar venda</td>
        <td class="cela_titol">Opcions</td>
</tr>
<!--{foreach from=$dates item=data name=eldata}-->
<tr>
	<td class='cela_generica'>{$data.datdata}</td>
	<td class='cela_generica'>
        <!-- {if $data.datestat & 4} -->
        <b>SI</b>
        <!-- {else} -->
        no
        <!-- {/if} -->
        </td>
        <td class='cela_generica'>
        <!-- {if $data.datestat & 1} -->
        <b>SI</b>
        <!-- {else} -->
        no
        <!-- {/if} -->
        </td>
        <td class='cela_generica'>
        <!-- {if $data.datestat & 2} -->
        <b>SI</b>
        <!-- {else} -->
        no
        <!-- {/if} -->
        </td>
        <td class='cela_generica'>
        <!-- {if $data.datestat & 4} -->
        <a href=data.php?data={$data.datdata}&action=off4>[Permetre comanda &rarr; no]</a>
        <!-- {else} -->
        <a href=data.php?data={$data.datdata}&action=on4>[Permetre comanda &rarr; SI]</a>
        <!-- {/if} -->
        &nbsp;
        <!-- {if $data.datestat & 1} -->
        <a href=data.php?data={$data.datdata}&action=off1>[Confirmar venda &rarr; no]</a>
        <!-- {else} -->
        <a href=data.php?data={$data.datdata}&action=on1>[Confirmar venda &rarr; SI]</a>
        <!-- {/if} -->
        &nbsp;
        <!-- {if $data.datestat & 2} -->
        <a href=data.php?data={$data.datdata}&action=off2>[Cobrar venda &rarr; no]</a>
        <!-- {else} -->
        <a href=data.php?data={$data.datdata}&action=on2>[Cobrar &rarr; SI]</a>
        <!-- {/if} -->

        </td>
</tr>
<!--{/foreach}-->
</table>
<br>
<input type="button" value="Afegir una nova data" onclick="location.href='data.php?action=creardiacomanda'">
</body>
</html>
