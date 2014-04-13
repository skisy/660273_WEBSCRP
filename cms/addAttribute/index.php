<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (INCL_ROOT . 'header.php');
	include (INCL_ROOT . 'cmsNav.php');
?>

<div class="right-content">
	<h1>Add Custom Attribute</h1>
	<div class="hideStatus" id="submitResult"><div class="submitProgress" id="submitProgress"><p class="hideStatus" id="completeMsg"></p></div></div>
	<form id="addAttribute" class="formContainer">
		<div class="hideStatus" id="attrNameMsg"><p class="status error validateMsg"></p></div>
		<div class="formGroup">
			<label for="attrName">Attribute Name:</label>
			<input type="text" id="attrName" name="attrName" data-pat="Letters, numbers, and spaces" maxlength="50" pattern="^[A-Za-z0-9]{1}[A-Za-z0-9\x20]{0,49}$" required>
		</div>

		<div class="formGroup">
			<div class="hideStatus" id="attrTypeMsg"><p class="status error validateMsg"></p></div>
			<label for="attrType" >Attribute Type:</label>
			<select name="attrType" id="attrType">
				<option value="text" selected>Text</option>
				<option value="date">Date</option>
				<option value="int">Integer</option>
				<option value="dec">Decimal</option>
				<option value="bool">Boolean (True/False)</option>
				<option value="drop">Dropdown</option>
			</select>
		</div>

		<div class="validation">
			<div id="minMaxDif" class="hideStatus"><p class="status error validateMsg">Maximum value must be greater to or equal to minimum value</p></div>
		</div>

		<div id="moreAttr">
		</div>

		<?php include (INCL_ROOT . "formControls.php"); ?>

	</form>
</div>

<?php include (INCL_ROOT . "footer.php"); ?>