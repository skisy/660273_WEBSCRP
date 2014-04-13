<?php
	
	include ("sitePaths.php");

	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	$_SESSION['user']=$settings['username'];
	$_SESSION['pass']=$settings['password'];
	$_SESSION['host']=$settings['host-ip'];
	$_SESSION['db']=$settings['db-name'];
	$conn = new mysqli($_SESSION['host'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['db']);
	
	if($conn->connect_errno > 0) {
		die('Unable to connect to database [' . $conn->connect_error . ']');
	}
?>