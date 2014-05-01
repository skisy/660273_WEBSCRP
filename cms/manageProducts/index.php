<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<a href="../addProduct"><div title="Add Product" id="addProdBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/add.svg')?></div></a>
	<h1 class="inlineTitle">Manage Products</h1>

	<div class="searchContainer">
		<input type="search" id="manageSearch" placeholder="Search Products" class="cmsSearch">
	</div>
	<small class="hint">Click on fields to edit</small>

	<div class="hideStatus" id="tableStatus"><p id="tableMsg" class="status error tableValid"></p></div>

	<table id="productTable">
		<thead>
			<tr>
				<th id="prodImgHead" scope="col">Image</th>
				<th id="prodNameHead" class="orderByHead" scope="col">Name<i id="prodNameHeadIcon" class='orderIcon fa fa-caret-up'></th>
				<th id="prodDescHead" class="orderByHead" scope="col">Description<i id="prodDescHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th id="prodPriceHead" class="orderByHead" scope="col">Price (<?php echo $settings['currency']?>)<i id="prodPriceHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th id="prodQuantHead" class="orderByHead" scope="col">Qty<i id="prodQuantHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th id="prodCatHead" class="orderByHead" scope="col">Category<i id="prodCatHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th class="actionHead" scope="col">Action</th>
			</tr>
		</thead>
		<tbody id="prodTableBody">
		</tbody>
	</table>
</div>


<?php include (INCL_ROOT . "footer.php"); ?>