<?php

	header("Content-Type: application/json");

	include('db_connect.php');
	include("sanitise_input.php");

	$valid = true;

	// Open php stream
	$handle = fopen("php://input", "rb");

	// Get contents of stream
	$data = stream_get_contents($handle);

	// Create associative array from stream contents
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

	// Decide which date to update
	if ($field == "o_delivered")
	{
		$date = "o_deliver_date";
	}
	else if ($field == "o_dispatched")
	{
		$date = "o_dispatch_date";
	}

	
	// Update order line as dispatched/delivered
	if(! $stmt = $conn->prepare("UPDATE order_line SET $field=?, $date=NOW() WHERE o_id=?")) 
	{
		$valid = false;
		die();		
	} 
	else 
	{
		$stmt->bind_param('ii', $val, $id);	
	}

	if(!$stmt->execute()) 
	{	
		$valid = false;
		die("Could not update order"); 
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