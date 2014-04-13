<?php
	header("Content-Type: application/json");

	include ("db_connect.php");
	
	if(isset($_GET['category'])) {
		$cat = preg_replace('#[^0-9]#', '', $_GET['category']);
	} else {
		$cat = 0;
	}
	
	
	if(!$cat == 0) {
	
		if(! $stmt = $conn->prepare("SELECT products.p_id, p_name, p_price, p_stock_quantity, p_long_desc, cat_id, cat_name, pi.pi_url
		FROM product_image pi
		JOIN (
			SELECT p_id, p_name, p_price, p_stock_quantity, p_long_desc, c.cat_id, c.cat_name
			FROM category c
			JOIN (SELECT p.p_id, p.p_name, p.p_price, p.p_stock_quantity, p.p_long_desc, pc.cat_id
			FROM product p
			JOIN product_category pc 
			ON p.p_id = pc.p_id
			WHERE pc.cat_id IN (
			   	SELECT c.cat_id
			   	FROM category c
			   	WHERE c.cat_id = ?
			   	UNION ALL
				   	SELECT c2.cat_id
				   	FROM category c
					  	LEFT JOIN category c2 ON c.cat_id = c2.parent_id
				   	WHERE c.cat_id = ?
					   	UNION ALL
					   	SELECT c3.cat_id
					   	FROM category c
						  	LEFT JOIN category c2 ON c.cat_id = c2.parent_id
							LEFT JOIN category c3 ON c2.cat_id = c3.parent_id
					   	WHERE c.cat_id = ?
						   	UNION ALL
						   	SELECT c4.cat_id
						   	FROM category c
								LEFT JOIN category c2 ON c.cat_id = c2.parent_id
								LEFT JOIN category c3 ON c2.cat_id = c3.parent_id
								LEFT JOIN category c4 ON c3.cat_id = c4.parent_id
						   	WHERE c.cat_id = ?
						   		UNION ALL
							   	SELECT c5.cat_id
							   	FROM category c
									LEFT JOIN category c2 ON c.cat_id = c2.parent_id
									LEFT JOIN category c3 ON c2.cat_id = c3.parent_id
									LEFT JOIN category c4 ON c3.cat_id = c4.parent_id
									LEFT JOIN category c5 ON c4.cat_id = c5.parent_id
							   	WHERE c.cat_id = ?)) pr
			ON c.cat_id=pr.cat_id) products
		ON pi.p_id=products.p_id
		WHERE pi.pi_main_pic=true;")) 
		{
			echo "ERROR:" . $conn->error;
			die();
			
		} else {
		
			$stmt->bind_param('iiiii', $cat, $cat, $cat, $cat, $cat);
		}
	} else {
	
		if(! $stmt = $conn->prepare("SELECT products.p_id, p_name, p_price, p_stock_quantity, p_long_desc, cat_id, cat_name, pi.pi_url
		FROM product_image pi
		JOIN (
			SELECT p_id, p_name, p_price, p_stock_quantity, p_long_desc, c.cat_id, c.cat_name
			FROM category c
			JOIN (
        		SELECT p.p_id, p.p_name, p.p_price, p.p_stock_quantity, p.p_long_desc, pc.cat_id 
				FROM product p 
				JOIN product_category pc ON p.p_id=pc.p_id) pr
			ON c.cat_id=pr.cat_id) products
		ON pi.p_id=products.p_id
		WHERE pi.pi_main_pic=true;")) 
		{
			
			echo "ERROR:" . $conn->error;
			die();
			
		} 
	}
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve products");
		
	}

	//$jsonData = json_encode($result->fetch_array(MYSQLI_ASSOC));

	$jsonData = '{';

	$i = 0;

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$id = $row["p_id"]; 
		$name = $row["p_name"];
		$description = $row["p_long_desc"];
		$price = $row["p_price"];
		$quantity = $row["p_stock_quantity"];
		$photo = $row["pi_url"];
		$category = $row["cat_id"];
		$catName = $row["cat_name"];
		$jsonData .= '"product'.$i.'":{ "id":"'.$id.'","name":"'.$name.'","price":"'.$price.'","quantity":"'.$quantity.'","photo":"'.$photo.'","category":"'.$category.'","catName":"'.$catName.'","description":"'.$description.'"},';
		
	}
	
	$stmt->free_result();
	$jsonData = rtrim($jsonData, ",");
	$jsonData .= '}';
	echo $jsonData;
?>
