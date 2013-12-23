<?php

Class UnitatFamiliar {
	
	function getAll($filter="") {
		global $db;
		$sql = "select * from UnitatFamiliar".(($filter != "") ? " where ".$filter : "")." order by ufid";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		return $db->GetAll($sql);	
	}
	
	function get($ufid) {
		global $db;
		$sql = "select * from UnitatFamiliar where ufid=$ufid";
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->GetAll($sql);
		return $rs[0];	
	}

	function add($ufArray) {
		Seguretat::AssertAdministrator();
		global $db;
		$sql = "insert into UnitatFamiliar values($ufArray[ufid], '$ufArray[ufname]', '$ufArray[ufcontact]', '$ufArray[ufaddress]', 0)";
		return $db -> Execute($sql);	
	}	
	
	function modify($ufid, $ufname, $ufcontact, $ufaddress) {
		Seguretat::AssertAdministrator();
		global $db;
		$sql = "update UnitatFamiliar set ufname='$ufname', ufcontact='$ufcontact', ufaddress='$ufaddress' where ufid=$ufid";
		return $db -> Execute($sql);	
	}	
	
	function ingressar($ufid, $quantitat, $memid, $nota) {
		Seguretat::AssertPaymentPC();
		global $db;
		$db -> StartTrans();
		$sql = "insert into Ingres values ($ufid, NOW(), ".sql_float($quantitat).", $memid, '$nota')";
		$db -> Execute($sql);
		$sql = "update UnitatFamiliar set ufval=ufval+$quantitat where ufid=$ufid";
		$db -> Execute($sql);
		
		return $db -> CompleteTrans();
	}
	/*
	function llistatProductes($intPid, $strDataInicial, $intNumero) {
		$strSQL = "select p.idProducte, p.nom,p.preu,if(ifnull(pc.idProducte,0)=0,'','checked') from Producte p left join ProducteComanda pc on (p.idProducte = pc.idProducte and  pc.dataComanda = '".$this -> conv_apos($strData)."');";
		include_once('adodb/adodb.inc.php');
		include_once('adodb/tohtml.inc.php'); 
		$db = ADONewConnection($this -> strDBTipus);
		//$db->debug = true;
		$db->PConnect($this -> strHost, $this -> strLogin,$this -> strPassword, $this -> strDBName) or die("Error en la connexi&oacute;<br/>");
		//$result = $db->Execute($strSQL);
		$result = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
		return $result;
	}
	*/
}

?>
