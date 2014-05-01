<?php 	
	include ("sitePaths.php");
	$settings = parse_ini_file(INCL_ROOT . "config.ini");

	include (ASSETS_ROOT . "db" . DIRECTORY_SEPARATOR . "test_conn.php");

	include (INCL_ROOT . 'header.php');
?>

	<div class="left-content">
		<div class="navDiv">
			<a href="../" class="toOther navButton">Back to Shop</a>
		</div>
		<div class="navDiv">
			<a href="../basket" class="toOther navButton">Edit Basket</a>
		</div>
	</div>

	<div class="right-content" id="checkoutContainer">
		<h1>Checkout - Your Details</h1>

		<form id="addCustInfo" class="formContainer">

			<div class="hideStatus" id="custFNameMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custFName">Given Name:</label>
				<input class="custDetails" type="text" id="custFName" data-pat="Letters only" pattern="[a-zA-Z ]+" maxlength="45" required>
			</div>
			
			<div class="hideStatus" id="custLNameMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custLName">Family/Surname:</label>
				<input class="custDetails" type="text" id="custLName" data-pat="Letters only" pattern="[a-zA-Z ]+" maxlength="45" required>
			</div>

			<div class="hideStatus" id="custAdd1Msg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custAdd1">Address Line 1:</label>
				<input class="custDetails" type="text" id="custAdd1" data-pat="Letters and numbers" pattern="[a-zA-Z0-9 ]+" maxlength="150" required>
			</div>

			<div class="hideStatus" id="custAdd2Msg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custAdd2">Line 2:</label>
				<input class="custDetails" type="text" id="custAdd2" data-pat="Letters and numbers" pattern="[a-zA-Z0-9 ]+" maxlength="150">
			</div>

			<div class="hideStatus" id="custAdd3Msg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custAdd3">Line 3:</label>
				<input class="custDetails" type="text" id="custAdd3" data-pat="Letters and numbers" pattern="[a-zA-Z0-9 ]+" maxlength="150">
			</div>

			<div class="hideStatus" id="custAdd4Msg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custAdd4">Line 4:</label>
				<input class="custDetails" type="text" id="custAdd4" data-pat="Letters and numbers" pattern="[a-zA-Z0-9 ]+" maxlength="150">
			</div>

			<div class="hideStatus" id="custCountryMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custCountry">Country</label>
				<input class="custDetails" type="text" id="custCountry" data-pat="Letters only" pattern="[a-zA-Z ]+" maxlength="150" required>
			</div>

			<div class="hideStatus" id="custPostcodeMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custPostcode">Postcode:</label>
				<input class="custDetails" type="text" id="custPostcode" data-pat="Letters and numbers" pattern="[a-zA-Z0-9 ]+" maxlength="45" required>
			</div>

			<div class="hideStatus" id="custEmailMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup">
				<label for="custEmail">Email:</label>
				<input class="custDetails" type="email" data-exType="Email" id="custEmail" required>
			</div>

			<div class="hideStatus" id="saveDetailsMsg"><p class="status error validateMsg"></p></div>
			<div class="formGroup optionalGrp">
				<label for="saveDetails">Save details for later?</label>
				<input class="saveDetails" type="checkbox" id="saveDetails">
			</div>


			<div id="toReview" class="formButton basketControls bottomBasketControls">Proceed to Payment</div>

		</form>
		<input type="text" id="custRef" disabled>
	</div>
		
<?php include (INCL_ROOT . "footer.php") ?>
