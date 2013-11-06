<?

class Venda {

	function checkOut($uf, $data) {
		if($_SESSION["membre"]["memid"] < 1)
			return false;
		else 
			$currmembre = $_SESSION["membre"]["memid"];
		global $db; 
// 		$db -> debug = true;
		// calculate total.
		$products = LiniaComanda::llistatProductes($uf, $data, "lc.lcquantitat > 0");
		
		$subtotal = 0;
		
		foreach($products as $product) { //p.prodid, p.prodnom, p.prodpreu, ifnull(lc.lcquantitat, 0) as lcquantitat, pr.provnom, pr.provid 
			$subtotal += $product[2] * $product[3]; // preu * quantitat		
		}
		
		//the super formula
		$venafegit = Venda::getAfegit($subtotal);
		
		// start trans
		$db -> StartTrans();
		
		$sql = "insert into Venda (vendata, venuf, venvendedor, vensubtotal, venafegit) values (NOW(), $uf, $currmembre, $subtotal, $venafegit)";
		$db -> Execute($sql);
		$venid = $db -> Insert_ID();
		
		foreach($products as $product) { //p.prodid, p.prodnom, p.prodpreu, ifnull(lc.lcquantitat, 0) as lcquantitat, pr.provnom, pr.provid 
			// remove stock in the db
			$sql = "update Producte set prodstockactual=prodstockactual-$product[3] where prodid=$product[0]";
			$db -> Execute($sql);
			
			// set lcvenda to the venid
			$sql = "update LiniaComanda set lcvenda=$venid where lcid=$product[6]";
			$db -> Execute($sql);
			
		}
		
		$total = $subtotal + $venafegit;
		
		// discount total from ufval
		$sql = "update UnitatFamiliar set ufval=ufval-$total where ufid=$uf";
		$db -> Execute($sql);
		// commit trans - return true or false...
		return $db -> CompleteTrans();
	}
	
	function getAfegit($subtotal) {  //the super formula...
		return 1.5;//round(($subtotal * 0.03), 2); // 3% (3 percent)	
	}
	
	function getTotalById($venid) {
		global $db;
		$sql = "select vensubtotal+venafegit as total from Venda where venid=$venid";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db -> GetAll($sql);
		return $rs[0]["total"];
	}

	function getById($venid) {
		global $db;
		$sql = "select * from Venda where venid=$venid";
		$rs = $db -> GetAll($sql);
		return $rs[0];
	}

	function getTotalBySubtotal($subtotal) {
		return $subtotal + Venda::getAfegit($subtotal);
	}
	
	function getPending($data) {
		global $db;
		$sql = "select lcuf,ufname,ufid from LiniaComanda, UnitatFamiliar where ufid=lcuf and lcdata='$data' and lcvenda=0 group by lcuf order by lcuf";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);
	}
	
	function getTotals($cond="") {
		global $db;
		
		if($cond != "") $cond = "where ".$cond;
		
		$sql = "select sum(vensubtotal+venafegit) as ventotal,vendata from Venda $cond group by vendata order by vendata";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}
	
	function getTotalsEveryFamily($data) {
		global $db;
		
		$sql = "select sum(subtotal+venafegit) as ventotal,vendata,venuf from Venda where vendata='$data' group by vendata order by vendata";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}

	function getListByDia($dia) {
		global $db;
		
		$sql = "select venuf as 'Unitat Familiar', vendata as 'Data', venid, (vensubtotal+venafegit) as Total from Venda where vendata='$dia' order by venuf";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}
	
	
		
}

?>
