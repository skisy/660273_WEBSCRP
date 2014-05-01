<?php
	header("Content-Type: application/json");
	//Add server side validation - echo result fail - handle echo result in ajax
	include('db_connect.php');

	$fname = $_POST["fn"];
	$lname = $_POST["sn"];
	$add1 = $_POST["a1"];
	$add2 = $_POST["a2"];
	$add3 = $_POST["a3"];
	$add4 = $_POST["a4"];
	$country = $_POST["cn"];
	$postcode = $_POST["pc"];
	$email = $_POST["em"];

	$cost = $_POST["oc"];

	$items = json_decode($_POST["is"], TRUE);

	$conn->autocommit(false);

	if(! $stmt = $conn->prepare("INSERT INTO customer (c_first_name, c_last_name, c_line_1, c_line_2, c_line_3, c_line_4, c_country, c_postcode, c_email) values (?, ?, ?, ?, ?, ?, ?, ?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('sssssssss', $fname, $lname, $add1, $add2, $add3, $add4, $country, $postcode, $email);

		if(! $stmt->execute()) {
			echo '{"result":"' . $stmt->error . '"}';
			die();
		} else {
			$custID = $conn->insert_id;
		}
	}

	if(! $stmt = $conn->prepare("INSERT INTO order_line (o_date, o_cost, c_id, o_dispatch_date, o_deliver_date) values (NOW(), ?, ?, NOW(),NOW())")) 
	{
		echo '{"result":"fail' . $conn->error . '"}';
		die();	
	} else {
		$stmt->bind_param('ss', $cost, $custID);

		if(! $stmt->execute()) {
			echo '{"result":"' . $stmt->error . '"}';
			die();
		} else { 
			$orderID = $conn->insert_id;
		}
	}

	if(! $stmt = $conn->prepare("INSERT INTO order_product (p_id, o_id, price, quantity) values (?, ?, ?, ?)")) 
	{
		echo '{"result":"' . $conn->error . '"}';
		die();
	}
	else
	{
		foreach ($items as $item)
		{
			$pId = $item["id"];
			$price = $item["price"];
			$quantity = $item["basketQuantity"];

			$stmt->bind_param('ssdi', $pId, $orderID, $price, $quantity);
			$stmt->execute();
		}
	}

	if(! $stmt = $conn->prepare("UPDATE product SET p_stock_quantity=p_stock_quantity - ? WHERE p_id=?;")) 
	{
		echo '{"result":"ERROR' . $conn->error . '"}';
		die();
	}
	else
	{
		foreach ($items as $item)
		{
			$pId = $item["id"];
			$quantity = intval($item["basketQuantity"]);

			$stmt->bind_param('ii', $quantity, $pId);
			if(!$stmt->execute())
			{
				echo "ERROR: " . $pId . " Quantity: " . $quantity . ": " . $conn->error;
				die();
			}
		}
	}
	$conn->commit();

	echo '{"result":"success","ref":"'.$orderID.'"}';
?>