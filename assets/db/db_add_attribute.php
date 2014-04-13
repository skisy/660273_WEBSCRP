<?php
	header("Content-Type: application/json");
	//Add server side validation - echo result fail - handle echo result in ajax
	include('db_connect.php');

	$name = $_POST["attrName"];
	$type = $_POST["attrType"];

	switch ($type)
	{
		case "text":
			$letters = $_POST["attrLet"];
			$max = NULL;
			$min = NULL;
			break;
		case "int":
		case "dec":
			$max = $_POST["attrMax"];
			$min = $_POST["attrMin"];
			$letters = NULL;
			break;
		case "date":
		case "bool":
		case "drop":
			$max = NULL;
			$min = NULL;
			$letters = NULL;
			break;
		default:
			break;
	}

	if(! $stmt = $conn->prepare("INSERT INTO custom_field (cf_name, cf_type, cf_min, cf_max, cf_letters) values (?, ?, ?, ?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('ssddi', $name, $type, $min, $max, $letters);
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