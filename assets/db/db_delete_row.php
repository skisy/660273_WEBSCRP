<?php
	header("Content-Type: application/json");

	include('db_connect.php');

	$inputData = fopen("php://input", "r");

	$data = json_decode(fread($inputData, 1024), TRUE);

	$id = $data["id"];
	$table = $data["table"];
	$idName = $data["idName"];

	if(! $stmt = $conn->prepare("DELETE FROM $table WHERE $idName=?")) 
	{
		echo "ERROR:" . $conn->error;
		die();
			
	} else {
		
		$stmt->bind_param('i', $id);
	}

	if(!$stmt->execute()) {	die("Could not retrieve products"); }

	fclose($inputData);

	echo '{"success":"true"}';

?>