<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'adminNav.php');
?>

<div class="right-content">
	<h1>Order Summary</h1>
	<p><strong>Order Ref: </strong> <?php echo $_GET["order"]?></p>
	<table id="orderProducts">
		<thead>
			<tr>
				<td>Item</td>
				<td>Price</td>
				<td>Quantity</td>
			</tr>
			<tbody id="orderProductsBody">
			</tbody>
		</thead>
	</table>
</div>

<script>
	var url = window.location.href;
	var order;

	if (url.indexOf("?order=") !== -1)
	{
		order = url.split("?order=");
		order = order[1];
		if (isNaN(order)) {
			window.location.href = "/660273/admin/orderManagement/";
		}
		else
		{
			ajaxHandle(order,"orderProducts", createOrderTable);
		}
	}
	else
	{
		window.location.href = "/660273/admin/orderManagement/";
	}
</script>

<?php include (INCL_ROOT . 'footer.php');?>