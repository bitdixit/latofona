<?php

Class AccedirDades {

	var $strLogin;
	var $strPassword;
	var $strHost;
	var $strDBName;
	var $strDBTipus;
	
	function UnitatFamiliar(,$strPDBTipus, $strPDBName,  $strPHost, $strPLogin, $strPPassword ) {
		$this -> strLogin = $strPLogin;
		$this -> strPassword = $strPPassword;
		$this -> strHost = $strPHost;
		$this -> strDBName = $strPDBName;
		$this -> strDBTipus = $strPDBTipus;
	}
	
}

?>
	