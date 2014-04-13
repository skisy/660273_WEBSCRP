<?php
	header("Content-Type: application/json");
	//Add server side validation - echo result fail - handle echo result in ajax
	include('db_connect.php');

	$name = $_POST["addCatName"];
	$parent = $_POST["selectedCat"] == 0 ? NULL : $_POST["selectedCat"];

	if(! $stmt = $conn->prepare("INSERT INTO category (cat_name, parent_id) values (?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('si', $name, $parent);
	}

	if(! $stmt->execute()) {
		echo '{"result":"' . $stmt->error . '"}';
		die();
	}
	else
	{	
		echo '{"result":"success"}';
	}
?>