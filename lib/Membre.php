<?
/*
The membre class
*/

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
	
/*	function Membre($memid, $memuf, $memnom, $memlogin, $memtipus, $memtel, $mememail, $memextrainfo) {
		$this -> memid = $memid;
		$this -> memuf = $memuf;
		$this -> memnom = $memnom;
		$this -> memlogin = $memlogin;
		$this -> memtipus = $memtipus;
		$this -> memtel = $memtel;
		$this -> mememail = $mememail;
		$this -> memextrainfo = $memextrainfo;
	}
*/
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
	
	function getAll($filter="") {
		global $db;
		$sql = "select * from Membre".(($filter != "") ? " where ".$filter : "")." order by memnom";
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
		//$result = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
		if ($rs) {
			if (!$rs -> EOF) {
				return $rs->fields;
				/*
				new Membre($rs->fields['memid'],$rs->fields['memuf'],$rs->fields['memnom'],$rs->fields['memlogin'],$rs->fields['memtipus'],$rs->fields['memtel'],$rs->fields['mememail'],$rs->fields['memextrainfo']);
				*/
			}
		}
		else return false;
	}
	
	function create($memuf, $memnom, $memlogin, $mempassword, $memtipus, $memtel, $mememail, $memextrainfo) {
		global $db;
		$sql = "insert into Membre (memuf,memnom,memlogin,mempassword, memtipus,memtel,mememail,memextrainfo) values($memuf,'$memnom','$memlogin','".crypt($mempassword, "ax")."', $memtipus,'$memtel','$mememail','$memextrainfo')";
		if ($db->Execute($sql) === false) 
			return false; 
		else return true;
	}
	
	function modify($memid, $memuf, $memnom, $memlogin, $mempassword, $memtipus, $memtel, $mememail, $memextrainfo) {
		global $db;
		if($mempassword != "")
			$passupdate = "mempassword='".crypt($mempassword, "ax")."',";
		$sql = "update Membre set memuf=$memuf, memnom='$memnom', memlogin='$memlogin',$passupdate memtipus='$memtipus', memtel='$memtel', mememail='$mememail', memextrainfo='$memextrainfo' where memid=$memid";
		if ($db->Execute($sql) === false) 
			return false; 
		else return true;
		  
	}
}
?>
