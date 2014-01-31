<?

Class Ingres {

	function getList() {
		global $db;
		
		$sql = "SELECT Ingres.indata as Data, Ingres.inquantitat as Quantitat, Ingres.innota as Nota, Membre.memnom as Membre FROM `Ingres` LEFT JOIN Membre ON Ingres.inmemid=Membre.memid ORDER BY Ingres.indata DESC LIMIT 200";

		$db -> SetFetchMode(ADODB_FETCH_ASSOC);
		return $db -> GetAll($sql);	
	}

}

?>
