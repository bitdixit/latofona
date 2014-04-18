<?php
	include_once('capcelera.php');
	if (!array_key_exists("membre",$_SESSION))
	{
		header('Location: login.php');
		exit();
	}        
       function error($missatge)
       {
           $smartyObj = new Smarty;
           $smartyObj -> assign("tipus_usuari",$_SESSION["membre"]["memtipus"]);
           $smartyObj -> assign("membre",$_SESSION["membre"]);
           $smartyObj -> assign("dia", get_current_date());
           $smartyObj -> assign("message",$missatge);
           $smartyObj -> display("error.tpl");
           die();
       }


?>
