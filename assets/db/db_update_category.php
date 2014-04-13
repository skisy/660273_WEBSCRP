<?php

	//IT WORKS - WRITE AJAX FOR IT NOW - xhr.open("PATCH", "db_update_category.php")
	//xhr.send("data=" + JSON.stringify(jsonData))
	header("Content-Type: application/json");

	include('db_connect.php');

	$putdata = fopen("php://input", "r");

	$data = json_decode(fread($putdata, 1024), TRUE);

	foreach ($data as $key => $value)
	{
		if ($key == "id") { $id = $value; }
		else 
		{
			$field = $key;
			$val = $value;
		}
	}

	if(! $stmt = $conn->prepare("UPDATE category SET $field=? WHERE cat_id=?")) 
	{
		echo "ERROR:" . $conn->error;
		die();		
	} 
	else 
	{	
		if ($field == "parent_id") { $stmt->bind_param('ii', $value, $id); }	
		else if ($field == "cat_name") { $stmt->bind_param('si', $value, $id); }	
	}

	if(!$stmt->execute()) {	die("Could not retrieve products"); }

	fclose($putdata);

	echo '{"success":"true"}';

?>