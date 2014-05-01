<?php
	header("Content-Type: application/json");

	include('db_connect.php');
	include('sanitise_input.php');

	$field = (isset($_GET["field"]) ? $conn->real_escape_string(sanitise_input($_GET["field"])) : "cat_name");
	$order = (isset($_GET["order"]) ? $conn->real_escape_string(sanitise_input($_GET["order"])) : "ASC");
	$searchTerm = (isset($_GET["search"]) ? "%" .$conn->real_escape_string(sanitise_input( $_GET["search"])) . "%" : "%");

	// Get categories according to search term (for category name or parent's name) and order specified
	if(! $stmt = $conn->prepare("SELECT child.cat_name cat_name, child.cat_id cat_id, childparent.cat_name parent_name, childparent.cat_id parent_id 
		FROM category child 
		LEFT JOIN category childparent ON child.parent_id=childparent.cat_id 
		WHERE child.cat_name LIKE ? OR childparent.cat_name LIKE ?
		ORDER BY $field $order;"))
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
	$jsonData = [];
	
	// Create JSON formatted object of arrays (containing category fields)
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$category = array(
			"id" => $row["cat_id"],
			"col1" => $row["cat_name"],
			"col2" => $row["parent_name"],
			"parentId" => $row["parent_id"],
		);

		$jsonData["category" + $i] = $category;		
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);
?>