<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	include("sanitise_input.php");

	$id = $conn->real_escape_string(sanitise_input($_GET["order"]));

	// Get products from selected order with product name, price and quantity
	if(! $stmt = $conn->prepare("SELECT o_id, op.p_id, p_name, price, quantity FROM order_product op LEFT JOIN product p ON op.p_id = p.p_id WHERE o_id = ?")) 
	{	
		die();		
	} 
	else 
	{
		$stmt->bind_param('i', $id);
	} 
			
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} 
	else 
	{
		die("Could not retrieve presets");
	}

	$jsonData = [];

	$i = 0;
	$string = "";

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$i++;
		$prod = array(
			"id" => $row["p_id"],
			"name" => $row["p_name"],
			"price" => $row["price"],
			"quantity" => $row["quantity"],
		);
		$string .= $i + " ";
		$jsonData["prod" . $i] = $prod;
	}
	$stmt->free_result();
	echo json_encode($jsonData);
?>