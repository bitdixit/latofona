<?php

Class Data {
	
	function comandaActual () {
		$strRetorn = "";
		
		//first, try something in the last few days or in the next few days.  assuming week is monday-saturday.
		$strSQL = "SELECT datdata FROM Data where datestat = 1 and datdata < adddate(CURRENT_DATE, INTERVAL 3 DAY) and datdata >= adddate(CURRENT_DATE, INTERVAL -4 DAY) order by datdata asc limit 1";
		global $db;
// 		$db -> debug = true;
		$recordSet = $db->GetAll($strSQL);
		if ($recordSet) {
			return $recordSet[0]["datdata"];
		}
		 
		 if ($strRetorn == "") { //nothing this week, get the next one in the future 
			$sql = "select datdata from Data where datdata > CURRENT_DATE order by datdata asc limit 1";
			$rs = $db->GetAll($sql);
			if ($rs)
				return $rs[0]["datdata"];
		}
		// still nothing, get the last one (past)
		if ($strRetorn == "") { 
			$sql = "select datdata from Data where datdata < CURRENT_DATE order by datdata desc limit 1";
			$rs = $db->GetAll($sql);
			if ($rs)
				return $rs[0]["datdata"];
		}

		return $strRetorn;
	}
	function comandaAnterior ($strData) {
		$strRetorn = $strData;
		$strSQL = "SELECT datdata FROM Data where datdata < '".conv_apos($strData)."'order by datdata desc limit 1";
		global $db;
// 		$db -> debug = true;
		$recordSet = $db->GetAll($strSQL);
		return $recordSet[0]["datdata"];	
	}
	function comandaSeguent ($strData) {
		$strRetorn = "";
		$strSQL = "SELECT datdata FROM Data where datdata > '".conv_apos($strData)."'order by datdata asc limit 1";
		global $db;
		$recordSet = $db->GetAll($strSQL);
		return $recordSet[0]["datdata"];	
	}
	
	/**
	 * Returns the next good date, basically adding 7 days to the date it is passed.
	 * If no date is passed in, the current date is used as a starting point.
	 */
	function nextWeekFromDate($strDate) {
		global $db;
		$dateString = $strDate == "" ? "CURRENT_DATE": "'$strDate'";
		$sql = "select adddate($dateString, interval 7 day) as nextweek";
		$rs = $db->Execute($sql);
		if ($rs) {
			if (!$recordSet -> EOF)
				return $rs -> fields[0];
		}
		else 
			return "";
	}
	
	function createOrderDay($year, $month, $day) {
		global $db;
// 		$db -> debug = true;
		$sql = "insert into Data (datdata, datestat) values ('$year-$month-$day', 1)";
		$db->Execute($sql);
	}
	
	function getAll($filter="") {
		global $db;
// 		$db -> debug = true;
		$sql = "select * from Data".(($filter == "") ? "" : " where ".$filter);
		return $db->GetAll($sql);		
	}
	
	function getBestDateForComanda() {
		if ((isset($_REQUEST['data'])) && ($_REQUEST['data'] != "")) {
			$strData = $_REQUEST['data'];
		} else {
			$actual  = Data::comandaActual();
			if ($_SESSION["debug"]) echo "Data Actual: $actual <br/>";
			$strData = Data::comandaSeguent($actual);
			if ($_SESSION["debug"]) echo "Data Seguent: $strData <br/>";
		}
		
		return $strData;		
	}
	
	function getLastDayActiveComanda() {
		global $db;
		$sql = "select datdata from Data where datestat=1 order by datdata desc limit 1";
		$recordSet = $db->GetAll($sql);
		return $recordSet[0]["datdata"];
	}
}
?>
