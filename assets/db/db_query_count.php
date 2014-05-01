<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	$jsonData = [];

	// Get number of products
	if(! $stmt = $conn->prepare("SELECT COUNT(*) prodCount FROM product")) {	
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve products");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["products"] = $row["prodCount"];
	}

	$stmt->free_result();

	// Get number of products with stock under 10
	if(! $stmt = $conn->prepare("SELECT COUNT(*) lowCount FROM product WHERE p_stock_quantity < 10")) {	
		echo "ERROR:" . $conn->error;
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve products");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["lowstock"] = $row["lowCount"];
	}

	$stmt->free_result();

	// Get number of products out of stock
	if(! $stmt = $conn->prepare("SELECT COUNT(*) noCount FROM product WHERE p_stock_quantity = 0")) {	
		echo "ERROR:" . $conn->error;
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve products");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["nostock"] = $row["noCount"];
	}

	$stmt->free_result();

	// Get number of categories
	if(! $stmt = $conn->prepare("SELECT COUNT(*) catCount FROM category")) {	
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve categories");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["cats"] = $row["catCount"];
	}

	// Get number of top level parent categories
	if(! $stmt = $conn->prepare("SELECT COUNT(*) parentCount FROM category WHERE parent_id IS NULL")) {	
	die("Could not retrieve categories");		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve products");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["parents"] = $row["parentCount"];
	}

	// Get number of orders waiting dispatch
	if(! $stmt = $conn->prepare("SELECT COUNT(*) orderDisCount FROM order_line WHERE o_dispatched = 0")) {	
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve orders");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["awaitDis"] = $row["orderDisCount"];
	}

	// Get number of dispatched orders awaiting delivery
	if(! $stmt = $conn->prepare("SELECT COUNT(*) orderDeliCount FROM order_line WHERE o_dispatched = 1 AND o_delivered = 0")) {	
		echo "ERROR:" . $conn->error;
	die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve orders");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["awaitDeli"] = $row["orderDeliCount"];
	}

	// Get 5 most popular products (by total units sold)
	if(! $stmt = $conn->prepare("SELECT SUM( quantity ) quant, op.p_id, p.p_name FROM order_product op LEFT JOIN product p ON p.p_id = op.p_id GROUP BY p_id ORDER BY quant DESC LIMIT 5")) {	
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve products");
	}

	$popular = [];

	$i = 0;

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$item = array(
			"id" => $row["p_id"],
			"name" => $row["p_name"],
			"quantity" => $row["quant"],
		);

		$popular["product" + $i] = $item;
	}

	$jsonData["popular"] = $popular;

	// Get total income
	if(! $stmt = $conn->prepare("SELECT SUM( o_cost ) income FROM order_line")) {	
		die();		
	} 
		
	if($stmt->execute()) {
		$result = $stmt->get_result();
	} else {
		die("Could not retrieve orders");
	}

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData["income"] = $row["income"];
	}

	$stmt->free_result();

	echo json_encode($jsonData);
?>