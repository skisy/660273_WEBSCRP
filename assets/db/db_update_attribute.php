<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include("sanitise_input.php");

	$valid = true;

	// Open php stream
	$handle = fopen("php://input", "rb");

	// Read stream
	$data = stream_get_contents($handle);

	// Create associative array from data in stream
	$data = json_decode($data, TRUE);

	// Get id of row, field and value to update
	foreach ($data as $key => $value)
	{
		if ($key == "id") { $id = $conn->real_escape_string(sanitise_input($value)); }
		else 
		{
			$field = $conn->real_escape_string(sanitise_input($key));
			$val = $conn->real_escape_string(sanitise_input($value));
		}
	}

	// Update field with value specified
	if(! $stmt = $conn->prepare("UPDATE custom_field SET $field=? WHERE id=?")) 
	{
		$valid = false;
		die();		
	} 
	else 
	{	
		$stmt->bind_param('si', $val, $id);
	}

	if(!$stmt->execute()) 
	{
		$valid = false;	
		die("Could not retrieve products"); 
	}

	// Close stream
	fclose($handle);

	if ($valid)
	{
		echo '{"result":"success"}';
	}
	else
	{
		echo '{"result":"failed"}';
	}
	

?>