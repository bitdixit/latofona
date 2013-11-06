<?php

if(!($_SESSION)) {
    session_start();
}

function nouIncludePath ( $path ){
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
	
	$caixaIP = "127.0.0.1"; //checkout can only be
//done from these IPs!
	
	// get the configuration and connect to the DB.
	$confile = new Connection_Config_File();
	$dbconf = $confile->getConfig();
	$db = ADONewConnection($dbconf["dbtype"]);
	$db->PConnect($dbconf["host"], $dbconf["user"],$dbconf["password"], $dbconf["db"]) or die("Error en la connexi&oacute; a la base de dades<br/>");
	$db->SetFetchMode(ADODB_FETCH_BOTH);
	$db->query("SET NAMES 'utf8'");
	
	if(isset($_REQUEST["debug"])) {
		if($_REQUEST["debug"] == "true")
			$_SESSION["debug"] = true;
		else 
			$_SESSION["debug"] = false;
	}
	
	if($_SESSION["debug"] === true)
		$db->debug = true;
	

?>
