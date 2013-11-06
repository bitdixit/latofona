<?php

// // No es pot executar directament, s'ha d'incloure.
//if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
//  header("location: index.php");
//}


class Connection_Config_File {
	var $dbType;
	var $host;
	var $db;
	var $user;
	var $password;

	
	// Constructor Definim connexio.
	function Connection_Config_File () {
		
		$this->dbType = 'mysqlt';
		$this->host = "127.0.0.1";
		$this->db ="database";
		$this->user = "user";
		$this->password = "password";
	}
	
	function getDBType () {
		return $this -> dbType;
	}
	
	function getHost () {
		return $this -> host;
	}
	function getDB () {
		return $this -> db;
	}
	function getUser () {
		return $this -> user;
	}
	function getPassword () {
		return $this -> password;
	}
	function getConfig() {
		$conf = array();
		$conf["dbtype"] = $this->getDBType();
		$conf["host"] = $this->getHost();
		$conf["db"] = $this->getDB();
		$conf["user"] = $this->getUser();
		$conf["password"] = $this->getPassword();
		
		return $conf;
		
	}
}

?>
