<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<h1>Manage Categories</h1>
	<div class="searchContainer">
		<input type="search" id="catSearch" name="catSearch" placeholder="Search Categories" class="cmsSearch">
		<div title="Search" id="cmsSearchBtn" class="formButton cmsSearchBtn"><?php include (IMG_ROOT . 'search.svg')?></div>
	</div>

	<div class="hideStatus" id="catTableStatus"><p id="catTableMsg" class="status error tableValid"></p></div>

	<table id="categoryTable">
		<thead>
			<tr>
				<th id="catNameHead" class="orderByHead" scope="col">Category<i id="catNameHeadIcon" class='asc orderIcon fa fa-caret-up'></i></th>
				<th id="catParentHead" class="orderByHead" scope="col">Parent Category<i id="catParentHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th class="actionHead" scope="col">Action</th>
			</tr>
		</thead>
		<tbody id="catTableBody">
		</tbody>
	</table>
</div>

<?php include (INCL_ROOT . "footer.php"); ?>