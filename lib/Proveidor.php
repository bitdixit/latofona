<?php

include_once("Log.php");

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
		$fetchMode=$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->GetAll($sql);
		$db->SetFetchMode($fetchMode);
		if ($rs === false) 
			return false; 
		else 
			return $rs[0];	
	}

	function add($provArray) {
		Seguretat::AssertAdministrator();
		global $db;
		$sql = "insert into Proveidor values(NULL, '$provArray[provnom]', '$provArray[provtelefon]', '$provArray[provfax]', '$provArray[provextrainfo]', '$provArray[provresponsable]', '$provArray[provtelefonresponsable]')";
		$db -> StartTrans();
		$db -> Execute($sql);
		Log::AddLogProveidor("Afegit proveidor", $db->Insert_ID(),$provArray["provnom"]);	
		return $db -> CompleteTrans();
	}

	function modify($provid, $provnom, $provtelefon, $provfax, $provextrainfo, $provresponsable, $provtelefonresponsable) {
		global $db;
		$sql = "update Proveidor set provnom='$provnom', provtelefon='$provtelefon', provfax='$provfax', provextrainfo='$provextrainfo', provresponsable='$provresponsable', provtelefonresponsable='$provtelefonresponsable' where provid=$provid";
		$db -> StartTrans();
		$db -> Execute($sql);
		Log::AddLogProveidor("Modificades dades proveidor", $provid);	
		return $db -> CompleteTrans();
	}	

	
}

?>
