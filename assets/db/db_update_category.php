<?php

	header("Content-Type: application/json");

	include('db_connect.php');

	$valid = true;

	$handle = fopen("php://input", "rb");

	$data = stream_get_contents($handle);

	$data = json_decode($data, TRUE);

	foreach ($data as $key => $value)
	{
		if ($key == "id") { $id = $value; }
		else 
		{
			$field = $conn->real_escape_string(sanitise_input($key));
			$val = $conn->real_escape_string(sanitise_input($value));
		}
	}

	if(! $stmt = $conn->prepare("UPDATE category SET $field=? WHERE cat_id=?")) 
	{
		$valid = false;
		die();		
	} 
	else 
	{	
		if ($field == "parent_id") { $stmt->bind_param('ii', $val, $id); }	
		else if ($field == "cat_name") { $stmt->bind_param('si', $val, $id); }	
	}

	if(!$stmt->execute()) 
	{	
		$valid = false;
		die("Could not update category"); 
	}

	fclose($putdata);

	if ($valid)
	{
		echo '{"result":"success"}';
	}
	else
	{
		echo '{"result":"failed"}';
	}

?>