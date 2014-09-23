<?
	include_once("capcelera_segura.php");
	include_once("Data.php");
	include_once("UnitatFamiliar.php");
	include_once("LiniaComanda.php");
	include_once("Venda.php");
	include_once("Ingres.php");
	include_once("Informe.php");
	include_once("Proveidor.php");
	include_once("Log.php");
	
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
		elseif($informe == "registre") {
			
			$smartyObj -> assign("title1","Registre operacions");
			$rows = Log::ListLogs();
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
                elseif($informe == "resumtorn") {
                        $week_start = new DateTime();
                        $week_start->setISODate(date("Y", strtotime($data)),date("W", strtotime($data)));
                        $date_start = $week_start->format('Y-m-d');
                        $week_start->add(new DateInterval('P6D'));
                        $date_end = $week_start->format('Y-m-d');
                        
                        $smartyObj -> assign("title1","Resum torn  $date_start al $date_end");
                        $rows = Informe::operacionsPerCistella($_REQUEST["data"],$date_start,$date_end);
                        $smartyObj -> assign("multidata","false");
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
		elseif($informe == "uflogs") {
			$rows =  Log::ListUFLogs($_REQUEST["ufid"]);
			$smartyObj -> assign("title1","Registre operacions UF ".$_REQUEST["ufid"]);
			$smartyObj -> assign("title2","");
			if ($rows==FALSE) $rows=Array();
			$smartyObj -> assign("multidata","true");
		}
		elseif($informe == "provlogs") {
			$rows =  Log::ListProveidorLogs($_REQUEST["provid"]);
			$smartyObj -> assign("title1","Registre operacions proveidor ".$_REQUEST["provid"]);
			$smartyObj -> assign("title2","");
			if ($rows==FALSE) $rows=Array();
			$smartyObj -> assign("multidata","true");
		}

		elseif($informe == "consumprov") {
/*			$proveidor = Proveidor::getById($_REQUEST["provid"]);
			$inici = $_REQUEST["inici"];
			$fi = $_REQUEST["fi"];
			$provid = $_REQUEST["provid"];
			$smartyObj -> assign("title1","Resum vendes ".$proveidor["provnom"]." del ".$inici." al ".$fi );
			$smartyObj -> assign("title2","");
			$rows = LiniaComanda::informeConsum($provid,$inici,$fi);
			if ($rows==FALSE) $rows=Array();
			$smartyObj -> assign("multidata","true");
		}		

               elseif($informe == "consumprov1") {
*/                        $proveidor = Proveidor::getById($_REQUEST["provid"]);
                        $any = $_REQUEST["any"];
                        $provid = $_REQUEST["provid"];
                        $smartyObj -> assign("title1","Resum vendes ".$proveidor["provnom"]." any ".$any );
                        $smartyObj -> assign("title2","");
                        $rows = LiniaComanda::informeConsumAny($provid,$any);
                        if ($rows==FALSE) $rows=Array();
$prods = Array();
foreach ($rows as $row)
{
   $name = $row['prodnom'];
   if (!array_key_exists($name,$prods))
   {
      $prods[$name]=Array();
      for ($i=1;$i<=12;++$i) $prods[$name][$i]=''; 
   } 
   $prods[$name][$row['mes']]=$row['Quantitat'];   
}
$rows=Array();
foreach ($prods as $prodname => $months)
{
   $pn["Producte"]=$prodname;
   for ($i=1;$i<=12;++$i)
      $pn[""+$i]=$months[$i];
   array_push($rows,$pn);
}


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
