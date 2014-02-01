<?php
	include_once('capcelera.php');
	if (!array_key_exists("membre",$_SESSION))
	{
		header('Location: login.php');
		exit();
	}
?>
