<?php

header("Content-Type: application/json");

	include('db_connect.php');
	include("sanitise_input.php");
	$valid = true;
	// Open php stream
	$handle = fopen("php://input", "rb");

	// Get contents of stream
	$data = stream_get_contents($handle);

	// Create associative array from stream data
	$data = json_decode($data, TRUE);

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
	if(! $stmt = $conn->prepare("UPDATE product SET $field=? WHERE p_id=?")) 
	{
		$valid = false;
		die();		
	} 
	else 
	{	
		switch ($field)
		{
			case "p_price":
				$stmt->bind_param('di', $val, $id);
				break;
			case "p_stock_quantity":
				$stmt->bind_param('ii', $val, $id);
				break;
			default:
				$stmt->bind_param('si', $val, $id);
				break;
		}
	}

	if(!$stmt->execute()) 
	{	
		$valid = false;
		die("Could not update product"); 
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