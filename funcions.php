<?php

include_once("Data.php");

function conv_apos ($cadena) {
	return(str_replace("'","''",$cadena));
}

function sql_float($num) {
	return (strtr($num,",","."));
}

function get_current_date() {	
	if(isset($_REQUEST["data"]))
		$_SESSION["datavenda"] = $_REQUEST["data"];
	elseif(!isset($_SESSION["datavenda"]))
		$_SESSION["datavenda"] = Data::comandaActual();
	
	return $_SESSION["datavenda"];
}

?>
