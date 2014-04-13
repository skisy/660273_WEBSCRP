<?php
	header("Content-Type: application/json");

	include('db_connect.php');

	$field = (isset($_GET["field"]) ? $_GET["field"] : "cat_name");
	$order = (isset($_GET["order"]) ? $_GET["order"] : "ASC");
	$searchTerm = (isset($_GET["search"]) ? "%" . $_GET["search"] . "%" : "%");

	if(! $stmt = $conn->prepare("SELECT child.cat_name cat_name, child.cat_id cat_id, childparent.cat_name parent_name, childparent.cat_id parent_id 
		FROM category child 
		LEFT JOIN category childparent ON child.parent_id=childparent.cat_id 
		WHERE child.cat_name LIKE ? OR childparent.cat_name LIKE ?
		ORDER BY $field $order"))
	{	
		echo "ERROR:" . $conn->error;
		die();	
	} 
	else
	{
		$stmt->bind_param('ss', $searchTerm, $searchTerm);
	}
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve categories " . $stmt->error);
		
	}
	
	$i = 0;
	$jsonData = '{';

	/*while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
	{
		$i++;
		$jsonData .= '"category' . $i . '":' . json_encode($row) . ',';
	}

	$stmt->free_result();
	$jsonData = rtrim($jsonData, ',');
	$jsonData .= '}';/*

	echo $jsonData;*/
	
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$id = $row["cat_id"]; 
		$name = $row["cat_name"];
		$parent = $row["parent_name"];
		$parentId = $row["parent_id"];
		$jsonData .= '"category'.$i.'":{ "id":"'.$id.'","name":"'.$name.'","parent":"'.$parent.'","parentId":"'.$parentId.'"},';
		
	}
	
	$stmt->free_result();
	$jsonData = rtrim($jsonData, ",");
	$jsonData .= '}';
	echo $jsonData;
?>