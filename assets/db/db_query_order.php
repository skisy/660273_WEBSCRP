<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	include("sanitise_input.php");

	$id = $conn->real_escape_string(sanitise_input($_GET["order"]));

	// Query order specified by id
	if(! $stmt = $conn->prepare("SELECT * FROM order_line WHERE o_id=?")) {	
		die();		
	} else {
		$stmt->bind_param('i', $id);
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();	
	} else {
		die("Could not retrieve products");
	}

	$jsonData = [];

	// Return all order status data to determine status of order
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["dispatched"] = $row["o_dispatched"];
		$jsonData["dispatchDate"] = $row["o_dispatch_date"];
		$jsonData["delivered"] = $row["o_delivered"];
		$jsonData["deliverDate"] = $row["o_deliver_date"];
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);
?>