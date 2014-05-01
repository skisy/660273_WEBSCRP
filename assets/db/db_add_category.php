<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$valid = true;

	$name = $conn->real_escape_string(sanitise_input($_POST["addCatName"]));
	$parent = $_POST["selectedCat"] == 0 ? NULL : $conn->real_escape_string(sanitise_input($_POST["selectedCat"]));

	// Insert category name and parent id into table
	if(! $stmt = $conn->prepare("INSERT INTO category (cat_name, parent_id) values (?, ?)")) 
	{
		$valid = false;
		die();	
	} else {
		$stmt->bind_param('si', $name, $parent);
	}

	if(! $stmt->execute()) {
		$valid = false;
		die();
	}
	
	// Return result
	if ($valid)
	{
		echo '{"result":"success"}';
	}
	else
	{
		echo '{"result":"failed"}';
	}
?>