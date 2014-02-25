<?php
	header("Content-Type: application/json");

	$conn = new mysqli("localhost", "root", "", "shopdb");
	$i = 0;
	
	if(isset($_GET['category'])) {
		$cat = preg_replace('#[^0-9]#', '', $_GET['category']);
	} else {
		$cat = 0;
	}
	
	
	if(!$cat == 0) {
	
		if(! $stmt = $conn->prepare("SELECT p_id, p_name, p_price, p_stock_quantity, p_photo_url, p_long_desc, c.cat_id, c.cat_name
FROM category c
JOIN (SELECT p.p_id, p.p_name, p.p_price, p.p_stock_quantity, p.p_photo_url, p.p_long_desc, pc.cat_id
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
		   WHERE c.cat_id = ?)
		GROUP BY pc.cat_id) pr
		ON c.cat_id=pr.cat_id;")
			) 
		{
			echo "ERROR:" . $conn->error;
			die();
			
		} else {
		
			$stmt->bind_param('iiii', $cat, $cat, $cat, $cat);
		}
	} else {
	
		if(! $stmt = $conn->prepare("SELECT p_id, p_name, p_price, p_stock_quantity, p_photo_url, p_long_desc, c.cat_id, c.cat_name
FROM category c
JOIN(SELECT p.p_id, p.p_name, p.p_price, p.p_stock_quantity, p.p_photo_url, p.p_long_desc, pc.cat_id 
	FROM product p 
	JOIN product_category pc 
	ON p.p_id=pc.p_id
	GROUP BY pc.cat_id) pr
ON c.cat_id=pr.cat_id;")) {
			
			echo "ERROR:" . $conn->error;
			die();
			
		} 
	}
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve products");
		
	}

		$jsonData = '{';

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$id = $row["p_id"]; 
		$name = $row["p_name"];
		$description = $row["p_long_desc"];
		$price = $row["p_price"];
		$quantity = $row["p_stock_quantity"];
		$photo = $row["p_photo_url"];
		$category = $row["cat_id"];
		$catName = $row["cat_name"];
		$jsonData .= '"product'.$i.'":{ "id":"'.$id.'","name":"'.$name.'","price":"'.$price.'","quantity":"'.$quantity.'","photo":"'.$photo.'","category":"'.$category.'","catName":"'.$catName.'","description":"'.$description.'"},';
		
	}
	
	$stmt->free_result();
	$jsonData = rtrim($jsonData, ",");
	$jsonData .= '}';
	echo $jsonData;
?>
