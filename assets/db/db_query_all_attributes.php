<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$field = (isset($_GET["field"]) ? $conn->real_escape_string(sanitise_input($_GET["field"])) : "cat_name");
	$order = (isset($_GET["order"]) ? $conn->real_escape_string(sanitise_input($_GET["order"])) : "ASC");
	$searchTerm = (isset($_GET["search"]) ? "%" . $conn->real_escape_string(sanitise_input($_GET["search"])) . "%" : "%");

	// Get all attributes according to search term and order specified by input
	if(! $stmt = $conn->prepare("SELECT id, cf_name, cf_type
		FROM custom_field
		WHERE cf_name LIKE ? OR cf_type LIKE ?
		ORDER BY $field $order"))
	{	
		die();	
	} 
	else
	{
		$stmt->bind_param('ss', $searchTerm, $searchTerm);
	}
		
	if($stmt->execute()) {
		$result = $stmt->get_result();	
	} else {
		die();	
	}
	
	$i = 0;
	$jsonData = '{';
	
	// Create JSON string of attributes
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$id = $row["id"]; 
		$name = $row["cf_name"];
		$type = $row["cf_type"];
		$jsonData .= '"attribute'.$i.'":{ "id":"'.$id.'","col1":"'.$name.'","col2":"'.$type.'"},';
		
	}
	
	$stmt->free_result();
	$jsonData = rtrim($jsonData, ",");
	$jsonData .= '}';
	echo $jsonData;
?>