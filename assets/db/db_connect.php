<?php
	include ("sitePaths.php");

	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	$user = $settings["username"];
	$pass = $settings["password"];
	$host = $settings["host-ip"];
	$db = $settings["db-name"];

	$conn = new mysqli($host, $user, $pass, $db);
	
	if($conn->connect_errno > 0) {
		die('Unable to connect to database [' . $conn->connect_error . ']');
	}
?>