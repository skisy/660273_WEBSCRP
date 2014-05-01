<?php
	function sanitise_input($input)
	{
		$input = trim($input);
		$input = stripslashes($input);
		return $input;
	}
?>