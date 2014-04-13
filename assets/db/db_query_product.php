<?php
	header("Content-Type: application/json");

	include ("db_connect.php");

	if(isset($_GET['product'])) {
		$prod = preg_replace('#[^0-9]#', '', $_GET['product']);
	} else {
		$prod = 0;
	}
	
	if(! $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = ?")) {	
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

	$jsonData = "";

	//$i = 0;

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		//$i++;
		$id = $row["p_id"]; 
		$name = $row["p_name"];
		$description = $row["p_long_desc"];
		$price = $row["p_price"];
		$quantity = $row["p_stock_quantity"];
		$meta = $row['p_meta'];
		$jsonData .= '{"id":"'.$id.'","name":"'.$name.'","price":"'.$price.'","quantity":"'.$quantity.'","description":"'.$description.'","meta":"test"}';
	}
	
	$stmt->free_result();
	echo $jsonData;

?>