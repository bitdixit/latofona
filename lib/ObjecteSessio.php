<?

Class ObjecteSessio {
	var $idUF;
	var $nom;
	var $tipus;
	
	function ObjecteSessio () { } //Constructor
	function getIdUF () {
		return $this -> idUF;
	}	
	function setIdUF ($intPId) {
		$this -> idUF = $intPId;
	}
	
	function getNom () {
		return $this -> nom;
	}
	function setNom ($strNom) {
		$this -> nom = $strNom;
	}

	function setTipus ($intTipus) {
		$this -> tipus = $intTipus;
	}
	function getTipus() {
		return $this -> tipus;
	}
		
}

?>
