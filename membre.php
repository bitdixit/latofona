<?
	include_once("capcelera_segura.php");
	include_once("Membre.php");
	include_once("UnitatFamiliar.php");
	
	$smartyObj = new Smarty;
	$smartyObj -> assign("membre", $_SESSION["membre"]);
	$smartyObj -> assign("dia", get_current_date());
	
	if($_REQUEST["action"] == "add"){
		$smartyObj -> assign("action", "create");
		$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
		$smartyObj -> assign("memtipus",0);
		$smartyObj -> assign("message","omple els camps per afegir un nou usuari...");
		$smartyObj -> display("membre.tpl");
			
	}
	else if ($_REQUEST["action"] == "create") {
		if(isset($_REQUEST["memnom"]) && isset($_REQUEST["memlogin"]) && isset($_REQUEST["mempassword"]) && isset($_REQUEST["memuf"])) {
			$newmemid = Membre::create($_REQUEST["memuf"], $_REQUEST["memnom"], $_REQUEST["memlogin"], $_REQUEST["mempassword"], $_REQUEST["memtipus"], $_REQUEST["memtel"], $_REQUEST["mememail"], $_REQUEST["memextrainfo"]);
			if($newmemid) { 
				$smartyObj -> assign("message","s'ha creat el membre  $_REQUEST[memlogin] ($_REQUEST[memnom]) en la unitat familiar ".$_REQUEST["memuf"]);
				$smartyObj -> assign("membres", $membres = Membre::getAll());		
				$smartyObj -> display("membreadmin.tpl");
			}
			else { 
				$smartyObj -> assign("action", "create");
				$smartyObj -> assign("memuf",$_REQUEST["uf"]);
				$smartyObj -> assign("memnom",$_REQUEST["memnom"]);
				$smartyObj -> assign("memlogin",$_REQUEST["memlogin"]);
				$smartyObj -> assign("memtel",$_REQUEST["memtel"]);
				$smartyObj -> assign("mememail",$_REQUEST["mememail"]);
				$smartyObj -> assign("memextrainfo",$_REQUEST["memextrainfo"]);
				$smartyObj -> assign("message","no s'ha pogut crear membre!");
				$smartyObj -> display("membre.tpl");
			}
		}
		else {
			$smartyObj -> assign("action", "create");
			$smartyObj -> assign("memuf",$_REQUEST["uf"]);
			$smartyObj -> assign("memnom",$_REQUEST["memnom"]);
			$smartyObj -> assign("memlogin",$_REQUEST["memlogin"]);
			$smartyObj -> assign("memtel",$_REQUEST["memtel"]);
			$smartyObj -> assign("mememail",$_REQUEST["mememail"]);
			$smartyObj -> assign("memextrainfo",$_REQUEST["memextrainfo"]);
			$smartyObj -> assign("message","nom, login, contrasenya, i uf ha de ser-hi!");
			$smartyObj -> display("membre.tpl");
		}
	}
	else if ($_REQUEST["action"] == "modify") {
		if(isset($_SESSION["membre"])){
			//edit user in db.
			$res = Membre::modify($_REQUEST["memid"], $_REQUEST["memuf"], $_REQUEST["memnom"], $_REQUEST["memlogin"], $_REQUEST["mempassword"], $_REQUEST["memtipus"], $_REQUEST["memtel"], $_REQUEST["mememail"], $_REQUEST["memextrainfo"]);
			if($res) {
				$membre = $_SESSION["membre"];
				if($membre["memid"] == $_REQUEST["memid"]) // editing the currently logged in user
					$_SESSION["membre"] = $_REQUEST;

				$smartyObj -> assign("memuf",$_REQUEST["uf"]);
				$smartyObj -> assign("memnom",$_REQUEST["memnom"]);
				$smartyObj -> assign("memlogin",$_REQUEST["memlogin"]);
				$smartyObj -> assign("memtel",$_REQUEST["memtel"]);
				$smartyObj -> assign("mememail",$_REQUEST["mememail"]);
				$smartyObj -> assign("memextrainfo",$_REQUEST["memextrainfo"]);
				$smartyObj -> assign("membres", $membres = Membre::getAll());		
				$smartyObj -> assign("message","s'ha modificat amb èxit l'usuari!");
				$smartyObj -> display("membreadmin.tpl");
			}
			else {
				$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
				$smartyObj -> assign("memuf",$_REQUEST["uf"]);
				$smartyObj -> assign("memnom",$_REQUEST["memnom"]);
				$smartyObj -> assign("memlogin",$_REQUEST["memlogin"]);
				$smartyObj -> assign("memtel",$_REQUEST["memtel"]);
				$smartyObj -> assign("mememail",$_REQUEST["mememail"]);
				$smartyObj -> assign("memextrainfo",$_REQUEST["memextrainfo"]);
				$smartyObj -> assign("message","no s'ha pogut modificar aquest usuari!");
				$smartyObj -> display("membre.tpl");
			}
			//if user is the current logged in user, change session membre properties.
		}
	}
	else if ($_REQUEST["action"] == "edit") {
 	   //var_dump($_SESSION);
		
		if(isset($_SESSION["membre"])){
			if (isset($_REQUEST["memid"])) {
				$themembre = Membre::get($_REQUEST["memid"]);
 				//var_dump($membre);
			}
			else {
				$themembre = $_SESSION["membre"];
 				//var_dump($membre);
			}
			
			foreach($themembre as $key=>$value) {
// 				echo $key." ".$value."<br>";
				$smartyObj -> assign($key, $value);
			}
//			$smartyObj -> assign("memtipus".$membre["memtipus"]);
			$smartyObj -> assign("message", "edita aquest usuari...deixa la contrasenya en blanc per mantenir l'actual.");
			$smartyObj -> assign("action", "modify");
			$smartyObj -> assign("ufs",UnitatFamiliar::getAll());
			$smartyObj -> assign("memuf", $themembre["memuf"]);
			$smartyObj -> display("membre.tpl");
		}
	}
	else { // present a menu of possible actions....
		// edit currently logged in user...
		// if tipus=1, edit any member..
		if(isset($_SESSION["membre"])){
			if($_SESSION["membre"]["memtipus"] == 1)  //only admin users...
				$smartyObj -> assign("membres", $membres = Membre::getAll());
			
			$smartyObj -> display("membreadmin.tpl");
		}
	}

?>
