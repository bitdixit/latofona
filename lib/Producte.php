<?php

Class Producte {
	
	function llistatProductes () {
		$strSQL = "SELECT * from Producte p right join Proveidor pr on (p.prodprov = pr.provid) order by pr.provnom, p.prodnom";
		global $db;
		//$result = $db->Execute($strSQL);
		$result = $db->GetAll($strSQL) or die("Error en la sentencia SQL: $strSQL<br/>".$db->ErrorMsg());
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
		
		$res = $db->Execute($sql);
		if($res === false)
			return false;
		else return true;
	}
	
	function modify ($prodid, $prodprov, $prodnom, $prodcode, $prodpreuinicial, $prodiva, $prodpreu, $prodisstock, $prodstockmin, $prodstockmax, $prodstockactual) {
		global $db;
		if($prodiva=="") $prodiva = "0";
		$sql = "update Producte set prodprov=$prodprov, prodnom='".conv_apos($prodnom)."', prodcode='$prodcode',prodpreuinicial=".sql_float($prodpreuinicial).", prodiva=".sql_float($prodiva).", prodpreu=".sql_float($prodpreu).", prodisstock=$prodisstock,"; 
		(($prodstockmin != "") ? ($sql .= "prodstockmin=".$prodstockmin.",") : ($sql .= "prodstockmin=NULL,")) ; 
		(($prodstockmax != "") ? ($sql .= "prodstockmax=".$prodstockmax.",") : ($sql .= "prodstockmax=NULL,")) ; 
		(($prodstockactual != "") ? ($sql .= "prodstockactual=".sql_float($prodstockactual)) : ($sql .= "prodstockactual=0")) ; 
		$sql .= " where prodid=$prodid";
		return $db->Execute($sql);
	}
	
	function addStock($prodid, $stocktoadd, $memid) {
		global $db;
		$db -> StartTrans();
		
		// get current price of the product..
		$prod = Producte::get($prodid);
		//add to stock input first...
		$sql = "insert into StockInput values (NOW(), $prodid, $prod[prodpreu],".sql_float($stocktoadd).", $memid)";
		$db -> Execute($sql);
		
		//add to the current stock....
		$sql = "update Producte set prodstockactual=prodstockactual+$stocktoadd where prodid=$prodid";
		$db -> Execute($sql);
		return $db -> CompleteTrans();
	}
	
	function remove ($prodid) {
		global $db;
		$sql = "delete from Producte where prodid=$prodid";
		$res = $db->Execute($sql);
		if($res === false)
			return false;
		else return true;	
	}
}
?>
