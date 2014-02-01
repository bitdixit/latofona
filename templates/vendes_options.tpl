<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Unitats Familiars</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="css/taula.css" rel="stylesheet" type="text/css" />
<body>
{include file="menu.tpl"}
<h1>Vendes</h1>
<h4>No et pots vendre a tu mateix. ni a ningú de la teva unitat familiar.<br>
Algú d'una altra unitat familiar t'ha de vendre.</h4>
<form method="GET">
	<select name="uf">
<!--{foreach from=$ufs item=uf name=lauf}-->
	<!--{if $uflog == $uf.ufid}-->
		<option value="{$uf.ufid}" selected="selected">{$uf.ufid} - {$uf.ufname}</option>
	<!--{else}-->
		<option value="{$uf.ufid}">{$uf.ufid} - {$uf.ufname}</option>
	<!--{/if}-->
<!--{/foreach}-->
	</select>
	<select name="data">
		<option value="{$datavenda}">{$datavenda}</option>
<!--{foreach from=$dates item=data name=ladata}-->
		<option value="{$data.datdata}">{$data.datdata}</option>
<!--{/foreach}-->
	</select>
<br><br/>
	<input type="submit" value="Vendre a aquesta UF >"/>
</form>
<br><br>

</html>
