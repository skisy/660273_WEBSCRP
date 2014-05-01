<?php
	header("Content-Type: application/json");

	include ("db_connect.php");

	$valid = true;

	// Get all orders
	if(! $stmt = $conn->prepare("SELECT * FROM order_line")) {	
		$valid = false;
		die();		
	} 

	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
		$valid = false;
	}

	$jsonData = [];

	$i = 0;

	// Loop through results creating JSON string of arrays (i.e. JSON contains each row's properties in an array)
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$i++;
		$line = array(
			"id" => $row["o_id"],
			"date" => $row["o_date"],
			"cost" => $row["o_cost"],
			"dispatched" => $row["o_dispatched"],
			"disDate" => $row["o_dispatch_date"],
			"delivered" => $row["o_delivered"],
			"devDate" => $row["o_deliver_date"],
			);

		$jsonData["line" + $i] = $line;
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);
?>