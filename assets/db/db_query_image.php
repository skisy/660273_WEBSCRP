<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	include('sanitise_input.php');

	$id = $conn->real_escape_string(sanitise_input($_GET["id"]));
	
	// Get secondary images (i.e. not primary image)
	if(! $stmt = $conn->prepare("SELECT p_id, pi_url FROM product_image WHERE p_id = ? AND pi_main_pic = 0")) {	
		die();		
	} else {
		$stmt->bind_param('i', $id);
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve images");
	}

	$jsonData = [];

	$i = 0;

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$i++;
		$image = array(
			"id" => $row["p_id"],
			"url" => $row["pi_url"],
		);

		$jsonData["image" + $i] = $image;
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);

?>