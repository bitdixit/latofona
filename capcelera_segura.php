<?php
	include_once('capcelera.php');
	if (!isset($_SESSION['membre'])) {
		header("/login.php");
	}
?>
