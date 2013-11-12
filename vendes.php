<?
	include_once("capcelera_segura.php");
	include_once("Data.php");
	include_once("UnitatFamiliar.php");
	include_once("LiniaComanda.php");
	include_once("ProducteHistoric.php");
	include_once("Venda.php");
 
	$smartyObj = new Smarty;
	$smartyObj -> assign("membre",$_SESSION["membre"]);
	$smartyObj -> assign("uflog",$_SESSION["membre"]["memuf"]);

	$data = get_current_date();
//	echo "*************************".$data;
	
	if(($_REQUEST["accio"] == "checkout") && isset($_REQUEST["uf"]) && isset($_REQUEST["data"])) { //cobrar el client. tanca la venda.

		// check to see if they're adding money to their account as well...
		if(trim($_REQUEST["inquantitat"]) != "") {
			if (!UnitatFamiliar::ingressar($_REQUEST["uf"], $_REQUEST["inquantitat"], $_REQUEST["inmemid"], $_REQUEST["innota"]))
				die("no s'ha pogut ingressar la UF...<br>");
		}
		if(Venda::checkOut($_REQUEST["uf"], $_REQUEST["data"])){
			$UF = UnitatFamiliar::get($_REQUEST["uf"]);
			$smartyObj -> assign("total", $_SESSION["total"]);
			$smartyObj -> assign("UF",$UF);
						
			$smartyObj -> assign("productes", $_SESSION["productes"]);
			$smartyObj -> assign("dia",$data);
			$smartyObj -> assign("uf",$_REQUEST["uf"]);
			$smartyObj -> assign("subtotal",$_SESSION["subtotal"]);
			$smartyObj -> assign("total",$_SESSION["total"]);		
			$smartyObj -> assign("afegit",Venda::getAfegit($subtotal));		
			$smartyObj -> display("checkoutconfirm.tpl");
			
			$_SESSION["total"] = 0;
			$_SESSION["subtotal"] = 0;
			$_SESSION["productes"] = array();
                        ProducteHistoric::actualitzaProducteHistoric();
		}
		else echo "No s'ha pogut cobrar la venda!";
	}
	else if($_REQUEST["accio"] == "venda") { // confirmacio de venda.
		$insertarlos = array();
		foreach ($_REQUEST as $key => $value) {
			if (!strncmp($key,"prod_",5) ) // why don't we just use HTML arrays in the form???
				$insertarlos[substr($key,5)] = $value;
		}
		LiniaComanda::insertarProductesComanda($_REQUEST["uf"],$insertarlos,$_SESSION["datavenda"]);
		$products = LiniaComanda::llistatProductes($_REQUEST["uf"], $data, "lc.lcquantitat > 0");
		$subtotal = 0;
		foreach($products as $product) {
			$subtotal += $product[2] * $product[3]; // preu * quantitat
 		}
		
		global $caixaIP;
		if($caixaIP != "" && stristr($caixaIP,$_SERVER["REMOTE_ADDR"]))
			$goodip = "true";
		else
			$goodip = "false"; 
		
		$_SESSION["total"] = Venda::getTotalBySubtotal($subtotal);
		$_SESSION["subtotal"] = $subtotal;
		$_SESSION["productes"] = $products;
		$UF = UnitatFamiliar::get($_REQUEST["uf"]);
		
		$smartyObj -> assign("goodip",$goodip);
		$smartyObj -> assign("UF",$UF);
		$smartyObj -> assign("productes", $products);
		$smartyObj -> assign("dia",$_REQUEST["data"]);
		$smartyObj -> assign("proveidor",0);
		$smartyObj -> assign("action","checkout");
		$smartyObj -> assign("uf",$_REQUEST["uf"]);
		$smartyObj -> assign("subtotal",$subtotal);
		$smartyObj -> assign("total",$_SESSION["total"]);		
		$smartyObj -> assign("afegit",Venda::getAfegit($subtotal));		
		$smartyObj -> assign("nouval", $UF["ufval"]-$_SESSION["total"]);
		$smartyObj -> display("checkoutconfirm.tpl");
			
	}
	else if (isset($_REQUEST["uf"]) && isset($_REQUEST["data"])) { // venda a aquesta familia, aquesta data..
		$_SESSION["ufvenda"] = $_REQUEST["uf"];
		$smartyObj -> assign("productes", LiniaComanda::llistatProductes($_REQUEST["uf"],$_REQUEST["data"], "(p.prodstockactual > 0 or p.prodisstock <= 0)"));
		$smartyObj -> assign("dia",$data);
		$smartyObj -> assign("proveidor",0);
		$smartyObj -> assign("action","venda");
		$smartyObj -> assign("confirm_exit","true");
		$smartyObj -> assign("uf",$_REQUEST["uf"]);
		$smartyObj -> display("llista_productes_uf.tpl");
	}	
	else {
	   //<dunetna> Afegim la unitat familiar al template
		$smartyObj -> assign("uflog",$_SESSION["membre"]["memuf"]);
		//</dunetna>
		$smartyObj -> assign("ufs", UnitatFamiliar::getAll());
		$smartyObj -> assign("dates",Data::getAll("1=1 order by datdata desc"));
		$smartyObj -> assign("datavenda",Data::comandaActual());
		$smartyObj -> display("vendes_options.tpl");
	}
?>
