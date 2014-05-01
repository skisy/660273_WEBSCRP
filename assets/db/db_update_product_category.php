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
		if ($key == "pid") { 
			$pid = $conn->real_escape_string(sanitise_input($value));
		}
		else if ($key == "cid")
		{
			$cid = $conn->real_escape_string(sanitise_input($value));
		}
	}

	// Update field with value specified
	if(! $stmt = $conn->prepare("REPLACE INTO product_category (p_id, cat_id) VALUES (?, ?)")) 
	{
		$valid = false;
		die();		
	} 
	else 
	{	
		$stmt->bind_param('ii', $pid, $cid);
	}

	if(!$stmt->execute()) 
	{	
		$valid = false;
		die("Could not amend product category"); 
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