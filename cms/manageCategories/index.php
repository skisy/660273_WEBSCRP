<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<a href="../addCategory"><div title="Add Category" id="addCatBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/add.svg')?></div></a>
	<h1 class="inlineTitle">Manage Categories</h1>

	<div class="searchContainer">
		<input type="search" id="manageSearch" placeholder="Search Categories" class="cmsSearch">
	</div>
	<small class="hint">Click on fields to edit</small>
	<div class="hideStatus" id="tableStatus"><p id="tableMsg" class="status error tableValid"></p></div>

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