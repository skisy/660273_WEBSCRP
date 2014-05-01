<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$valid = true;
	// Open php stream
	$inputData = fopen("php://input", "r");

	// Read and create associative array from contents of stream
	$data = json_decode(fread($inputData, 1024), TRUE);

	$id = $conn->real_escape_string(sanitise_input($data["id"]));
	$table = $conn->real_escape_string(sanitise_input($data["table"]));
	$idName = $conn->real_escape_string(sanitise_input($data["idName"]));

	// Delete specified record (by provided id) from specified table
	if(! $stmt = $conn->prepare("DELETE FROM $table WHERE $idName=?")) 
	{
		$valid = false;	
	} else {	
		$stmt->bind_param('i', $id);
	}

	if(!$stmt->execute()) {	echo '{"error":"'.$conn->error.'"}'; }

	// Close stream
	fclose($inputData);

	// Return result
	if ($valid) { echo '{"result":"success"}'; }
	else { echo '{"result":"failed"}'; }
	

?>