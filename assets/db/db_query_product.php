<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	include("sanitise_input.php");

	if(isset($_GET['product'])) {
		$prod = preg_replace('#[^0-9]#', '', $conn->real_escape_string(sanitise_input($_GET['product'])));
	} else {
		$prod = 0;
	}
	
	// Get all related product data, including primary image and category name
	if(! $stmt = $conn->prepare("SELECT p.p_id, p.p_name, p_long_desc, p_price, p_stock_quantity, p_meta, pr.cat_id, pr.cat_name, pi_url
FROM product p
LEFT JOIN (
SELECT c.cat_id cat_id, pc.p_id pid, cat_name
FROM product_category pc
LEFT JOIN category c ON pc.cat_id = c.cat_id
) pr
ON p.p_id = pr.pid
LEFT JOIN (
SELECT * 
FROM product_image pi
WHERE pi.pi_main_pic = 
TRUE
) pir 
ON p.p_id = pir.p_id
WHERE p.p_id = ?;")) {	
		echo "ERROR:" . $conn->error;
		die();		
	} else {
		$stmt->bind_param('i', $prod);
	} 
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve products");
		
	}

	$jsonData = [];

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$jsonData = [
			"id" => $row["p_id"],
			"name" => $row["p_name"],
			"description" => $row["p_long_desc"],
			"price" => $row["p_price"],
			"quantity" => $row["p_stock_quantity"],
			"photo" => $row["pi_url"],
			"category" => $row["cat_id"],
			"catName" => $row["cat_name"],
			"meta" => $row["p_meta"],
		];
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);

?>