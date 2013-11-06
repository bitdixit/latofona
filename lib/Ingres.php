<?

Class Ingres {

	function getList($cond="") {
		global $db;
		
		if($cond != "") $cond = "where ".$cond;
		
		$sql = "select * from Ingres $cond";
		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}

}

?>
