<?php

Class Producte {
	
	function llistatProductes () {
		$strSQL = "SELECT * from Producte p right join Proveidor pr on (p.prodprov = pr.provid) WHERE p.prodnom NOT LIKE '#%' AND pr.provnom NOT LIKE '#%' order by pr.provnom, p.prodnom";
		global $db;
		$result = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
		return $result;
	
	}
	function llistatProductesProveidor ($provid) {
		$strSQL = "SELECT * FROM Producte p RIGHT JOIN Proveidor pr ON (p.prodprov = pr.provid) WHERE prodnom NOT LIKE '#%' AND pr.provnom NOT LIKE '#%' AND pr.provid=".$provid." ORDER BY pr.provnom, p.prodnom";
		global $db;
		$result = $db->GetAll($strSQL);
		//if (PEAR::isError($result)) {
		//    die($result->getMessage());
		//}		
		return $result;
	
	}
	
	function get($prodid) {
		$sql = "SELECT * from Producte where prodid=$prodid";
		global $db;
		//$result = $db->Execute($strSQL);
		$rs = $db->GetAll($sql) or die("Error en la sentencia SQL: $sql<br/>".$db->ErrorMsg());
		return $rs[0];
	}
 	
	function preu ($idProducte) {
		$intId = 0;
		$strSQL = "select preu from producte where prodid='".strtr($idProducte,"'","''")."'";
		global $db;
		//$db->debug = true;
		$recordSet = $db->Execute($strSQL);
		if (!$recordSet->EOF) {
			$intId = $recordSet->field[0];
		}
		$recordSet -> Close();
		return $intId;
	}
	
	function preus ($idProducte, $quantitat) {
		return (Producte::preu ($idProducte) * $quantitat);
	}
	
	function create ($prodprov, $prodnom, $prodcode, $prodpreuinicial, $prodiva, $prodpreu, $prodisstock, $prodstockmin, $prodstockmax, $prodstockactual) {
		global $db;
		if($prodiva=="") $prodiva = 0;
		$sql = "insert into Producte (prodid, prodnom, prodcode, prodprov, prodpreuinicial, prodiva, prodpreu, prodisstock, prodstockmin, prodstockmax, prodstockactual) values (NULL, '".conv_apos($prodnom)."', '$prodcode', $prodprov,".sql_float($prodpreuinicial).",".sql_float($prodiva).",".sql_float($prodpreu).", $prodisstock, ";
		(($prodstockmin != "") ? ($sql .= $prodstockmin.",") : ($sql .= "NULL,")) ; 
		(($prodstockmax != "") ? ($sql .= $prodstockmax.",") : ($sql .= "NULL,")) ; 
		(($prodstockactual != "") ? ($sql .= sql_float($prodstockactual).")") : ($sql .= "0)")) ; 
		
		$db -> StartTrans();
		$db -> Execute($sql);
		Log::AddLogProveidor("Afegit producte ".$db->Insert_ID()." ".$prodnom, $prodprov);	
		return $db -> CompleteTrans();
	}
	
	function modify ($prodid, $prodprov, $prodnom, $prodcode, $prodpreuinicial, $prodiva, $prodpreu, $prodisstock, $prodstockmin, $prodstockmax, $prodstockactual) {
		global $db;
		if($prodiva=="") $prodiva = "0";
		$sql = "update Producte set prodprov=$prodprov, prodnom='".conv_apos($prodnom)."', prodcode='$prodcode',prodpreuinicial=".sql_float($prodpreuinicial).", prodiva=".sql_float($prodiva).", prodpreu=".sql_float($prodpreu).", prodisstock=$prodisstock,"; 
		(($prodstockmin != "") ? ($sql .= "prodstockmin=".$prodstockmin.",") : ($sql .= "prodstockmin=NULL,")) ; 
		(($prodstockmax != "") ? ($sql .= "prodstockmax=".$prodstockmax.",") : ($sql .= "prodstockmax=NULL,")) ; 
		(($prodstockactual != "") ? ($sql .= "prodstockactual=".sql_float($prodstockactual)) : ($sql .= "prodstockactual=0")) ; 
		$sql .= " where prodid=$prodid";

		$db -> StartTrans();
		$db -> Execute($sql);
		Log::AddLogProveidor("Modificat producte ".$prodid." ".$prodnom,  $prodprov);	
		return $db -> CompleteTrans();
	}
	
	function addStock($prodid, $stocktoadd, $memid) {
		global $db;
		$db -> StartTrans();
		
		$prod = Producte::get($prodid);
		
		$sql = "update Producte set prodstockactual=prodstockactual+$stocktoadd where prodid=$prodid";
		$db -> Execute($sql);
		
		if ($stocktoadd>=0) $stocktoadd = "+".$stocktoadd;
		Log::AddLogProveidor("Modificat stock (".$stocktoadd.") producte ".$prodid." ".$prod['prodnom'],  $prod['prodprov']);	

		return $db -> CompleteTrans();
	}
	
	function remove ($prodid) {
		global $db;
		$sql = "UPDATE Producte SET prodnom=CONCAT('#',prodnom) WHERE prodid=$prodid";
		$res = $db->Execute($sql);
		if($res === false)
			return false;
		else return true;	
	}
}
?>
