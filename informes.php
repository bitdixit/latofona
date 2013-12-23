<?
	include_once("capcelera_segura.php");
	include_once("Data.php");
	include_once("UnitatFamiliar.php");
	include_once("LiniaComanda.php");
	include_once("Venda.php");
	include_once("Ingres.php");
	include_once("Informe.php");
	include_once("Proveidor.php");
	
	$smartyObj = new Smarty;
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	
	$data = get_current_date();
	
	$datanext = Data::comandaSeguent($data);
	$datalast = Data::comandaAnterior($data);
			
	$smartyObj -> assign("dia",$data);
	$smartyObj -> assign("datanext",$datanext);
	$smartyObj -> assign("datalast",$datalast);
	$smartyObj -> assign("alldatas",Data::getAll("1=1 order by datdata desc"));
	
	if(isset($_REQUEST["informe"]) && $_REQUEST["informe"] != "") {
		global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC); // so reports get the right values in their header..
		
		$informe = $_REQUEST["informe"];
		if($informe == "vendespendents") {
			$smartyObj -> assign("title1","Vendes pendents $data");
			$rows = Venda::getPending($data);
		}
		elseif($informe == "vendestotals") {
			$smartyObj -> assign("title1","Històric de vendes de la cope");
			$smartyObj -> assign("title2","");
			$rows = Venda::getTotals();
			$smartyObj -> assign("multidata","true");
		}		
		elseif($informe == "ingresos") {
			$smartyObj -> assign("title1","Ultims ingressos");
			$rows = Ingres::getList("1=1 order by indata desc, inuf asc LIMIT 200");
			$smartyObj -> assign("multidata","true");
		}
		elseif($informe == "ingresostotalsperdia") {
			$smartyObj -> assign("title1","Ingresos totals per dia");
			$smartyObj -> assign("title2","");
			$rows = Informe::totalIngresos();
			$smartyObj -> assign("multidata","true");
		}
		elseif($informe == "vendesdia") {
			$smartyObj -> assign("title1","Vendes del dia $data");
			$rows = Venda::getListByDia($_REQUEST["data"]);
			$smartyObj -> assign("multidata","true");
		}
		elseif($informe == "vendesdiadetall") {
			$smartyObj -> assign("title1","Detall venda del dia $data");
			$products = LiniaComanda::llistatProductesVenda($_REQUEST["venid"]);
			//var_dump($products);
			$venda = Venda::getById($_REQUEST["venid"]);
			
			$UF = UnitatFamiliar::get($venda["venuf"]);
			
			$smartyObj -> assign("UF",$UF);
			$smartyObj -> assign("productes", $products);
			$smartyObj -> assign("dia",$venda["vendata"]);
			$smartyObj -> assign("proveidor","");
			$smartyObj -> assign("action","informe");
			$smartyObj -> assign("uf",$_REQUEST["venuf"]);
			$smartyObj -> assign("subtotal",$venda["vensubtotal"]);
			$smartyObj -> assign("total",$venda["vensubtotal"]+$venda["venafegit"]);		
			$smartyObj -> assign("afegit",$venda["venafegit"]);		
			
		}
		elseif($informe == "consumprov") {
			$proveidor = Proveidor::getById($_REQUEST["provid"]);
			$inici = $_REQUEST["inici"];
			$fi = $_REQUEST["fi"];
			$provid = $_REQUEST["provid"];
			$smartyObj -> assign("title1","Resum vendes ".$proveidor["provnom"]." del ".$inici." al ".$fi );
			$smartyObj -> assign("title2","");
			$rows = LiniaComanda::informeConsum($provid,$inici,$fi);
			if ($rows==FALSE) $rows=Array();
			$smartyObj -> assign("multidata","true");
		}		
		
		
		if(is_array($rows[0])) { //results returned? 
			$columns = array_keys($rows[0]);
			$smartyObj -> assign("rows",$rows);
			$smartyObj -> assign("columns",$columns);
			$smartyObj -> assign("informe",$informe);
			$smartyObj -> display("informes_menu.tpl");
		}
		elseif ($informe == "comandafamiliasproveidor") {
			$comandafamilias = Informe::getComandaFamiliasPerProveidor($data, $_REQUEST["provid"]);
			
			$productes = Array();
			$comandes = Array();
			$families = Array();
			
			$proveidor = Proveidor::getById($_REQUEST["provid"]);
			if(is_array($comandafamilias) && sizeof($comandafamilias) > 0) {
				foreach($comandafamilias as $cf) {
					//one array for each product and one for each family. not repeating the products or families.
					$productes[$cf["prodid"]] = $cf; //a bit of a waste.. we really just want prodid and prodnom
					$families[$cf["ufid"]] = $cf; //a bit of a waste.. we really just want prodid and prodnom
					$comanda[$cf["prodid"]][$cf["ufid"]] = $cf["lcquantitat"];
				}
				
				$smartyObj -> assign("productes",$productes);
				$smartyObj -> assign("families",$families);
				$smartyObj -> assign("comanda",$comanda);
			}
			
			$smartyObj -> assign("dia",$data);
			$smartyObj -> assign("proveidor",$proveidor);
			$smartyObj -> display("informe_comandafamiliasproveidor.tpl");

		}		
		else {
			$smartyObj -> assign("informe",$informe);
			$smartyObj -> display("informes_menu.tpl");		
		}
	}
	else {
		$smartyObj -> display("informes_menu.tpl");		
	}


?>
