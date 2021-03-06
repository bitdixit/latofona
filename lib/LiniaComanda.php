<?php

Class LiniaComanda {


	function informeConsum ($prodid,$datainici,$datafi)
	{
		$strSQL = "SELECT prodnom as 'Nom producte',lcprod,lcpreuunitat as 'Preu unitari',SUM(lcquantitat) AS Quantitat FROM LiniaComanda, Producte WHERE lcprod = prodid AND lcdata >= '".$datainici."' AND lcdata <='".$datafi."' AND prodprov=".$prodid." AND prodnom NOT LIKE '#%' GROUP BY lcprod,lcpreuunitat";
		global $db;
		$res = 	$db->GetAll($strSQL);
		return $res;
	}


        function informeConsumAny ($provid,$any)
        {
$strSQL="SELECT prodnom, MONTH( lcdata ) AS mes, lcprod, SUM( lcquantitat ) AS Quantitat".
" FROM LiniaComanda, Producte".
" WHERE lcprod = prodid".
" AND YEAR( lcdata ) =".$any.
" AND prodprov =".$provid.
" GROUP BY lcprod, mes".
" ORDER BY prodnom, mes";

               global $db;
                $res =  $db->GetAll($strSQL);
                return $res;
        }


	function llistatProductes ($intIdUF,$strData, $filter="") {
		
		$where = "p.prodnom NOT LIKE '#%' AND pr.provnom NOT LIKE '#%'";
		if ($filter!="")
			$where = "$where AND ($filter)"; 

		$strSQL = "select p.prodid, p.prodnom, p.prodpreu, ifnull(lc.lcquantitat, 0) as lcquantitat, pr.provnom, pr.provid, lc.lcid, p.prodcode from Producte p left join LiniaComanda lc on (lc.lcprod=p.prodid and lc.lcuf=$intIdUF and lc.lcdata='$strData' and (lc.lcvenda <= 0 or isnull(lc.lcvenda))) inner join Proveidor pr on (p.prodprov=pr.provid) WHERE $where group by p.prodid order by pr.provnom, p.prodnom";
		global $db;
		$arrayResult = array();
		$indexResult = 0;
		$db->SetFetchMode(ADODB_FETCH_BOTH);
		$result = $db->Execute($strSQL);
		if (!$result) {
			echo "Sense files";
		}
		else {
			while (!$result -> EOF) {
				$arrayResult[$indexResult++] = array($result->fields[0],$result->fields[1],
							$result->fields[2],$result->fields[3],$result->fields[4],
							$result->fields[5], $result->fields[6], $result->fields[7]);
				$result->MoveNext();
			}
		}
		return $arrayResult;
	}

	function llistatProductesVenda ($venid) {
		
		$strSQL = "select p.prodid, p.prodnom, p.prodpreu, ifnull(lc.lcquantitat, 0) as lcquantitat, pr.provnom, pr.provid, lc.lcid, p.prodcode from LiniaComanda lc left join Producte p on (p.prodid=lc.lcprod) inner join Proveidor pr on (p.prodprov=pr.provid) where p.prodnom NOT LIKE '#%' AND pr.provnom NOT LIKE '#%' AND lc.lcvenda=$venid group by p.prodid order by pr.provnom, p.prodnom";
		global $db;
		$arrayResult = array();
		$indexResult = 0;
		return $db->GetAll($strSQL);
	}
	
	function tornemStock($intIdUF,$strData) {
		return false;
	}
	
	function insertarProductesComanda($intIdUF, $idProductes, $strData) {
		$arrSQL = array();
		$arrSQLIndex = 0;
		global $db;
		$db -> StartTrans();
		
		/* Borrem tots els productes d'aquell dia */
		$strSQL = "DELETE FROM LiniaComanda WHERE lcdata = '".conv_apos($strData)."' and lcuf=".$intIdUF." and lcvenda < 1";
		$recordSet = $db->Execute($strSQL);

		foreach ($idProductes as $prodid => $lcquantitat) {
			if ($lcquantitat > 0) { //Quantitat > 0 
				$strSQL = "SELECT prodpreu,prodisstock FROM Producte WHERE prodid=".$prodid;
				$recordSet1 = $db->Execute($strSQL);
				if ($recordSet1) {
					if (!$recordSet1 -> EOF) {
						$preuUnitari = $recordSet1 -> fields[0];
					}
					
					// L'Insertem a la comanda
					$strSQL = "INSERT INTO LiniaComanda (lcdata , lcuf , lcprod , lcquantitat , lcpreuunitat, lcvenda) VALUES ('".conv_apos($strData)."',".$intIdUF.",".$prodid.",".sql_float($lcquantitat).",".sql_float(conv_apos($preuUnitari)).", 0)";
					$recordSet2 = $db->Execute($strSQL);
				}
			}		
		}
		/* Acabar-la aquí... Commit o Rollback */
		return $db -> CompleteTrans(); //ummm... has there been an error? we should check and rollback...
	}

	function comandaSumari($data) {
		global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "select prodid, provnom, prodnom, ifnull(lcpreuunitat, '-') as lcpreuunitat,  ifnull(sum(lcquantitat),0) as lcquantitattotal, provresponsable, provid from Producte left join LiniaComanda on (lcdata='$data' and prodid=lcprod) inner join Proveidor on (provid=prodprov) where  prodisstock<=0 AND prodnom NOT LIKE '#%' AND provnom NOT LIKE '#%' group by prodid order by prodprov,prodnom";
                $rows = $db -> GetAll($sql);
                $return = array();
                foreach ($rows as $row)
                   if ($row['lcquantitattotal']>0) 
			array_push($return,$row); 
		return $return;
	}
	
	function moureProducteComanda($prodid, $dataorig, $datadesti) {
		global $db;
		$sql = "UPDATE LiniaComanda SET lcdata= '$datadesti' WHERE lcdata='$dataorig' and lcprod=$prodid and lcvenda=0";
		$db -> Execute($sql);	
		
	}
	
	function moureProductesComanda($prods, $dataorig, $datadesti) {
		global $db;
		$db -> StartTrans();
		
		foreach($prods as $prodid => $value) {
			LiniaComanda::moureProducteComanda($prodid, $dataorig, $datadesti);
		}	
		
		return $db -> CompleteTrans();
	}
	
}

?>
