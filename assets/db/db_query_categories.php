<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	if(isset($_GET['category'])) {
		$cat = preg_replace('#[^0-9]#', '', $conn->real_escape_string(sanitise_input($_GET['category'])));
	} else {
		$cat = 0;
	}
	
	// Look for all child categories of parent or all categories if no parent specified
	if(!$cat == 0) {
	
		if(! $stmt = $conn->prepare("SELECT * FROM category WHERE parent_id = ? ORDER BY cat_name")) {
			die();		
		} else {
		
			$stmt->bind_param('i', $cat);
		}
	} else {
		if(! $stmt = $conn->prepare("SELECT * FROM category WHERE parent_id IS NULL ORDER BY cat_name")) {
			die();		
		} 
	}
		
	if($stmt->execute()) {
		$result = $stmt->get_result();	
	} else {
		die("Could not retrieve products");	
	}
	
	$i = 0;
	$jsonData = [];
	
	// JSON of arrays containg category data
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$category = array(
			"id" => $row["cat_id"],
			"name" => $row["cat_name"],
			"parent" => $row["parent_id"],
		);

		$jsonData["category" + $i] = $category;
				
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);
?>