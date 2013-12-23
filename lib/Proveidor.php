<?php

Class Proveidor {
	
	function getAll($filter="") {
		global $db;
		$sql = "select * from Proveidor".(($filter != "") ? " where ".$filter : "")." order by provnom";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->GetAll($sql);
		if ($rs === false) 
			return false; 
		else 
			return $rs;
	}
	
	function getById($provid) {
		global $db;
		$sql = "select * from Proveidor where provid=$provid";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->GetAll($sql);
		if ($rs === false) 
			return false; 
		else 
			return $rs[0];	
	}

	function add($provArray) {
		Seguretat::AssertAdministrator();
		global $db;
		$sql = "insert into Proveidor values(NULL, '$provArray[provnom]', '$provArray[provtelefon]', '$provArray[provfax]', '$provArray[provextrainfo]', '$provArray[provresponsable]', '$provArray[provtelefonresponsable]')";
		return $db -> Execute($sql);	
	}

	function modify($provid, $provnom, $provtelefon, $provfax, $provextrainfo, $provresponsable, $provtelefonresponsable) {
		global $db;
		$sql = "update Proveidor set provnom='$provnom', provtelefon='$provtelefon', provfax='$provfax', provextrainfo='$provextrainfo', provresponsable='$provresponsable', provtelefonresponsable='$provtelefonresponsable' where provid=$provid";
		return $db -> Execute($sql);	
	}	

	
}

?>
