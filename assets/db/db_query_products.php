<?php
	header("Content-Type: application/json");
	
	include ("db_connect.php");
	include("sanitise_input.php");
	
	if(isset($_GET['category'])) {
		$cat = preg_replace('#[^0-9]#', '', $conn->real_escape_string(sanitise_input($_GET['category'])));
	} 
	else
	{
		$cat = 0;
	}

	$search = (isset($_GET['search']) ? "%" . $conn->real_escape_string(sanitise_input($_GET['search'])) . "%" : "%");
	$field = (isset($_GET['field']) ? $conn->real_escape_string(sanitise_input($_GET['field'])) : "p_name");
	$order = (isset($_GET['order']) ? $conn->real_escape_string(sanitise_input($_GET['order'])) : "asc");
	
	
	if(!$cat == 0) {

		// Get all products from category specified and from child categories down to 5 deep
		if(! $stmt = $conn->prepare("SELECT p.p_id, p.p_name, p.p_price, p.p_stock_quantity, p.p_long_desc, pc.cat_id, cat_name, pi_url
FROM product p
JOIN product_category pc 
ON p.p_id = pc.p_id
LEFT JOIN (

SELECT c.cat_id cat_id, pc.p_id pid, cat_name, pi_url
FROM product_category pc
LEFT JOIN category c ON pc.cat_id = c.cat_id
LEFT JOIN product_image pi ON pc.p_id = pi.p_id
WHERE pi.pi_main_pic = TRUE) pr
ON p.p_id = pr.pid

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
WHERE c.cat_id = ?)
AND (p_name LIKE ? OR cat_name LIKE ? OR p_long_desc LIKE ? OR p_meta LIKE ?)
ORDER BY $field $order;")) 
		{
			die();
			
		} else {	
			$stmt->bind_param('iiiiissss', $cat, $cat, $cat, $cat, $cat, $search, $search, $search, $search);
		}
	} else {
		// Get all products
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
WHERE p_name LIKE ? OR cat_name LIKE ? OR p_long_desc LIKE ? OR p_meta LIKE ?
ORDER BY $field $order;")) 
		{		
			die();	
		} 
		else
		{
			$stmt->bind_param('ssss', $search, $search, $search, $search);
		}
	}
		
	if($stmt->execute()) {
	
		$result = $stmt->get_result();
		
	} else {
	
		die("Could not retrieve products");
		
	}

	//$jsonData = json_encode($result->fetch_array(MYSQLI_ASSOC));

	$jsonData = [];

	$i = 0;

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	
		$i++;
		$item = array(
			"id" => $row["p_id"],
			"col1" => $row["pi_url"],
			"col2" => $row["p_name"],
			"col3" => $row["p_long_desc"],
			"col4" => $row["p_price"],
			"col5" => $row["p_stock_quantity"],
			"category" => $row["cat_id"],
			"catName" => $row["cat_name"],
		);

		$jsonData["product" + $i] = $item;		
	}
	
	$stmt->free_result();
	echo json_encode($jsonData);
?>
