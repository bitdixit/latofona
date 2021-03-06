<?php

if(!($_SESSION)) {
    session_start();
}

function nouIncludePath ( $path )
{
	$pathFiles = dirname(__FILE__);
	if (substr(PHP_OS, 0, 3) == 'WIN') {
		$pathFiles .= "\\".strtr($path,"/","\\");
		$pathFiles .= ";";
	} else {
		$pathFiles .= "/".$path.":";
	}
	ini_set('include_path',$pathFiles.ini_get('include_path'));
}

nouIncludePath("plugs/smarty/");
nouIncludePath("plugs/");
nouIncludePath("lib/");
require("Smarty.class.php");
include_once('Connection_Config_File.php');
include_once('adodb/adodb.inc.php');
include_once('adodb/tohtml.inc.php'); 
include_once('funcions.php');
include_once('Seguretat.php');

$masterUF=42;
$confile = new Connection_Config_File();
$dbconf = $confile->getConfig();
$db = ADONewConnection($dbconf["dbtype"]);
$db->PConnect($dbconf["host"], $dbconf["user"],$dbconf["password"], $dbconf["db"]) or die("Error en la connexi&oacute; a la base de dades<br/>");
$db->SetFetchMode(ADODB_FETCH_BOTH);
$db->query("SET NAMES 'utf8'");
		
?>
