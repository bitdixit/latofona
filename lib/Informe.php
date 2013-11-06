<?
include_once("Data.php");
include_once("Ingres.php");
include_once("LiniaComanda.php");
include_once("Producte.php");
include_once("Venda.php");
include_once("UnitatFamiliar.php");
include_once("Membre.php");
include_once("ProducteComanda.php");

Class Informe {

	/*
	*  Returns a multi-dimensional array 
	*/
	function getComandaFamiliasPerProveidor($data, $provid) {
		global $db;
		$sql = "select lcprod, prodid, prodnom, lcdata, lcquantitat, lcuf, ufid, ufname, prodprov, provnom from LiniaComanda, UnitatFamiliar, Producte, Proveidor where lcdata='$data' and ufid=lcuf and prodid=lcprod and provid=prodprov and provid=$provid order by ufid, prodid";
		return $db -> GetAll($sql);
	}	
	
	/*
	* Returns a hashtable 
	* indata, inquantitat
	* inquantitat is the sum of the deposits (ingresos) for a given day (indata)
	*/
	function totalIngresos($cond="") {
		global $db;
		if($cond != "") $cond = " where ".$cond;
		$sql = "select indata as Data, sum(inquantitat) as 'Quantitat Total' from Ingres $cond group by indata";
		return $db -> GetAll($sql);
	}

	function getVendes($uf) {
		$sql = "select * from venda where venuf=$uf";
		return $db -> GetAll($sql);
	}
}

?>