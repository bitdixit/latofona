<?
	include('capcelera.php');
	include_once('UnitatFamiliar.php');
	include_once('Membre.php');
	include_once('Log.php');
	
	$smartyObj = new Smarty;
	if ($_REQUEST["accio"] == "send") {
		$membre = Membre::validate($_REQUEST["login"],$_REQUEST["passwd"]);
		if($membre){
			$_SESSION["membre"] = $membre;
			Log::AddLogUF("Login",$membre["memuf"]);
			header("Location: novetats.php");
		}	
		else {	
			$smartyObj -> display("login.tpl");
			echo "<br><center>Sembla que la gran tofona no sap qui ets!</center>";
		}
	}
	else if ($_REQUEST["accio"] == "logout") {
		if (isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
		$smartyObj -> display("login.tpl");

	} else
	$smartyObj -> display("login.tpl");

?>
