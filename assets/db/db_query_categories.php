<?php
	header("Content-Type: application/json");

	include('db_connect.php');

	if(isset($_GET['category'])) {
		$cat = preg_replace('#[^0-9]#', '', $_GET['category']);
	} else {
		$cat = 0;
	}
	
	if(!$cat == 0) {
	
		if(! $stmt = $conn->prepare("SELECT * FROM category WHERE parent_id = ? ORDER BY cat_name")) {
		
			echo "ERROR:" . $conn->error;
			die();
			
		} else {
		
			$stmt->bind_param('i', $cat);
		}
	} else {
	
		if(! $stmt = $conn->prepare("SELECT * FROM category WHERE parent_id IS NULL ORDER BY cat_name")) {
			
			echo "ERROR:" . $conn->error;
			die();
			
		} 
	}
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve products");
		
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
		$parent = $row["parent_id"];
		$jsonData .= '"category'.$i.'":{ "id":"'.$id.'","name":"'.$name.'","parent":"'.$parent.'"},';
		
	}
	
	$stmt->free_result();
	$jsonData = rtrim($jsonData, ",");
	$jsonData .= '}';
	echo $jsonData;
?>