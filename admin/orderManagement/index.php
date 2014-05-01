<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'adminNav.php');
?>

<div class="right-content">
	<h1>Order Management</h1>
	<div id="orderManage">
		<h2>Orders Awaiting Dispatch</h2>
		<table id="awaitingDispatch">
			<thead>
				<tr>
					<td>Order Ref</td>
					<td>Total Income</td>
					<td>Date Made</td>
				</tr>
				<tbody id="awaitingDispatchBody">
				</tbody>
			</thead>
		</table>
		<h2 class="secondHeading">Orders Awaiting Delivery</h2>
		<table id="awaitingDelivery">
			<thead>
				<tr>
					<td>Order Ref</td>
					<td>Total Income</td>
					<td>Date Made</td>
					<td>Date Dispatched</td>
				</tr>
				<tbody id="awaitingDeliveryBody">
				</tbody>
			</thead>
		</table>
	</div>
</div>

<?php include (INCL_ROOT . 'footer.php');?>