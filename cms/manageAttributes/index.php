<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>
<div class="right-content">
	<a href="../addAttribute"><div title="Add Attribute" id="addAttrBtn" class="formButton cmsManageBtn topControls"><?php include (IMG_ROOT . 'svg/add.svg')?></div></a>
	<h1 class="inlineTitle">Manage Custom Attributes</h1>

	<div class="searchContainer">
		<input type="search" id="manageSearch" placeholder="Search Attributes" class="cmsSearch">
	</div>
	<small class="hint">Click on fields to edit</small>

	<div class="hideStatus" id="tableStatus"><p id="tableMsg" class="status error tableValid"></p></div>

	<table id="attributesTable">
		<thead>
			<tr>
				<th id="attrNameHead" class="orderByHead" scope="col">Name<i id="attrNameHeadIcon" class='asc orderIcon fa fa-caret-up'></i></th>
				<th id="attrTypeHead" class="orderByHead" scope="col">Type<i id="attrTypeHeadIcon" class='orderIconHidden fa fa-caret-up'></th>
				<th class="actionHead" scope="col">Action</th>
			</tr>
		</thead>
		<tbody id="attrTableBody">
		</tbody>
	</table>
</div>

<?php include (INCL_ROOT . "footer.php"); ?>