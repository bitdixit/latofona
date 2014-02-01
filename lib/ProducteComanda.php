<?php


Class ProducteComanda {

	function llistatProductesMarcats ($strData)
	{
		$strSQL = "select p.prodid, p.prodnom,p.prodpreu,if(ifnull(pc.pcprodid,0)=0,'','checked') as checked, pr.provnom, p.prodisstock from Producte p left join ProducteComanda pc on (p.prodid = pc.pcprodid and  pc.pcdata = '".conv_apos($strData)."') left join Proveidor pr on (pr.provid = p.prodprov) where p.prodnom not like '#%' and pr.provnom not like '#%' and p.prodisstock <= 0 order by p.prodprov,p.prodnom";
		echo $sqlSQL;
		global $db;
		$result = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
		return $result;
	}
	function llistatProductesMarcatsProveidor ($strData,$provid)
	{
		$strSQL = "select p.prodid, p.prodnom,p.prodpreu,if(ifnull(pc.pcprodid,0)=0,'','checked') as checked, pr.provnom, p.prodisstock from Producte p left join ProducteComanda pc on (p.prodid = pc.pcprodid and  pc.pcdata = '".conv_apos($strData)."') left join Proveidor pr on (pr.provid = p.prodprov) where p.prodnom not like '#%' and pr.provnom not like '#%' and p.prodisstock <= 0 and pr.provid=".$provid." order by p.prodprov,p.prodnom";
		global $db;
		$result = $db->GetAll($strSQL);
		if ($result===FALSE) $result=Array();
		return $result;
	}

	function borrarProducteAComanda ($idProducte, $strData) {
	}
	
	function insertarProductesAComanda($provid,$idProductes, $strData) {
	/*El mateix que un pero $idProductes és un Array*/
		global $db;
		$db -> StartTrans();
		//$db->debug = true;
		/* Aquí hauria de començar una transacció*/
		/* Borrem tots els productes d'aquell dia */
		$strSQL = "DELETE FROM ProducteComanda WHERE pcdata = '".conv_apos($strData)."' AND pcprodid in (SELECT prodid FROM Producte WHERE prodprov=".$provid.")";
		$recordSet = $db->Execute($strSQL);
		$recordSet -> Close();
		foreach ($idProductes as $idProducte) {
			$strSQL = "INSERT INTO ProducteComanda (pcprodid,pcdata) VALUES ('".conv_apos($idProducte);
			$strSQL .="','".conv_apos($strData)."')";
			$recordSet = $db->Execute($strSQL);
			$recordSet -> Close();
		}
		Log::AddLogProveidor("Modificada comanda dia $strData", $provid);	
		return $db -> CompleteTrans();
	}


}
?>
