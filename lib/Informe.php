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
		$sql = "select lcprod, prodid, prodnom, lcdata, lcquantitat, lcuf, ufid, ufname, prodprov, provnom from LiniaComanda, UnitatFamiliar, Producte, Proveidor where lcdata='$data' and ufid=lcuf and prodid=lcprod and provid=prodprov and provid=$provid AND prodnom NOT LIKE '#%' AND provnom NOT LIKE '#%' order by ufid, prodid";
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
		$sql = "select indata as Data, sum(inquantitat) as 'Quantitat Total' from Ingres $cond group by indata ORDER BY indata DESC LIMIT 100";
		return $db -> GetAll($sql);
	}

	function getVendes($uf) {
		$sql = "select * from venda where venuf=$uf";
		return $db -> GetAll($sql);
	}

        function operacionsPerCistella($data,$date_start,$date_end) {
                global $db;

                $sql="SELECT ufid as UF, ufname as Nom, "
                ."(SELECT SUM(inquantitat) FROM Ingres WHERE inuf=ufid AND indata BETWEEN '$date_start' AND '$date_end') AS 'Ingressos realitzats',"
                ."(SELECT SUM(vensubtotal) FROM Venda WHERE venuf=ufid AND vendata BETWEEN '$date_start' AND '$date_end') AS 'Vendes realitzades',"
                ."(SELECT SUM(lcquantitat*lcpreuunitat) FROM LiniaComanda WHERE lcuf=ufid AND lcvenda=0 AND lcdata BETWEEN '$date_start' AND '$date_end') AS 'Vendes pendents'"

                ." FROM `UnitatFamiliar`"; 
                return $db -> GetAll($sql);
        }
}

?>
