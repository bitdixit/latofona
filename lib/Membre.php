<?
/*
The membre class
*/

include_once("Log.php");

Class Membre {

	var $memid;
	var $memuf;
	var $memnom;
	var $memlogin;
	var $mempassword;
	var $memtipus;
	var $memtel;
	var $mememail;
	var $memextrainfo;
	
	function get($memid) {
		global $db;
		$sql = "select * from Membre where memid=$memid";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->Execute($sql);
		if ($rs === false) 
			return false; 
		else
			return $rs->fields;			
	}
	
	function getAll() {
		global $db;
		$sql = "select * from Membre where memlogin NOT LIKE '#%' order by memnom";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->Execute($sql);
		if ($rs === false) 
			return false; 
		else {
			$membres = array();
			//var_dump($rs);
 			while (!$rs->EOF) {
				$membres[] = $rs->fields;
				$rs->MoveNext();
 			}
			return $membres;
		}
	}
	
	function validate($login, $password) {
		global $db;
		$sql = "select * from Membre where memlogin='$login' and mempassword='".crypt($password,"ax")."'";
		$rs = $db->Execute($sql);
		if ($rs) {
			if (!$rs -> EOF) {
				return $rs->fields;
			}
		}
		else return false;
	}
	
	function create($memuf, $memnom, $memlogin, $mempassword, $memtipus, $memtel, $mememail, $memextrainfo) {
		Seguretat::AssertAdministrator();
		global $db;
		$sql = "insert into Membre (memuf,memnom,memlogin,mempassword, memtipus,memtel,mememail,memextrainfo) values($memuf,'$memnom','$memlogin','".crypt($mempassword, "ax")."', $memtipus,'$memtel','$mememail','$memextrainfo')";
		$db -> StartTrans();		
		$db->Execute($sql);
		Log::AddLogGeneral("Afegit membre ".$memlogin." ".$memnom." UF".$memuf);
		return $db->CompleteTrans();
	}
	
	function modify($memid, $memuf, $memnom, $memlogin, $mempassword, $memtipus, $memtel, $mememail, $memextrainfo) {
		Seguretat::AssertAdministrator();		
		global $db;
		if($mempassword != "")
			$passupdate = "mempassword='".crypt($mempassword, "ax")."',";
		$sql = "update Membre set memuf=$memuf, memnom='$memnom', memlogin='$memlogin',$passupdate memtipus='$memtipus', memtel='$memtel', mememail='$mememail', memextrainfo='$memextrainfo' where memid=$memid";
		$db -> StartTrans();		
		$db->Execute($sql); 
		Log::AddLogGeneral("Modificat membre ".$memlogin." ".$memnom." UF".$memuf);
		return $db->CompleteTrans();
		  
	}
	function delete($memid)
	{
		Seguretat::AssertAdministrator();		
		global $db;
		$membre = Membre::get($memid);
		$sql = "update Membre set memlogin=CONCAT('#',memlogin) where memid=$memid";
		$db -> StartTrans();		
		$db->Execute($sql); 
		Log::AddLogGeneral("Esborrat membre ".$membre['memlogin']." ".$membre['memnom']." UF".$membre['$memuf']);
		return $db->CompleteTrans();
	}
}
?>
