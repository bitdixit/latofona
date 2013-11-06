<?
	include('capcelera.php');
	include_once('UnitatFamiliar.php');
	include_once('Membre.php');
	
	if ($_REQUEST["accio"] == "send") {
		$membre = Membre::validate($_REQUEST["login"],$_REQUEST["passwd"]);
		if($membre){
//			var_dump($membre);
			$_SESSION["membre"] = $membre;
// 			echo "logged in";
//			header("Location: http://" . $_SERVER['HTTP_HOST'] . "/llista_productes_uf.php");
// [moni] Canvio el header per tal que no es redirigeixi a l'arrel del servidor
			header("Location: llista_productes_uf.php");
		}	
		else {	
			echo "Error en el password o la contrasenya!!";
		}
	}
	else if ($_REQUEST["accio"] == "logout") {
		if (isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
	}
	$smartyObj = new Smarty;
	$smartyObj -> display("login.tpl");
?>
