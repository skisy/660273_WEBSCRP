<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

#admin-nav {
	font-family: Arial;
	margin-right: 20px;
	display:inline;
	float:right;
	list-style-type: none;
}

#admin-nav li {
	display: inline;
	margin-left: 20px;
}

#site-settings {
	margin: 16px;
	width: 400px;
}

#site-settings h1 {
	margin: .6em 0 .4em 0;
	padding: 0;
}

#site-settings label {
	margin-left: 2em;
	width: 150px;
	display: inline-block;
}

#site-settings span {
	display: block;
	margin-bottom: 0.5em;
}

#site-settings input, #site-settings select {
	width:15em;
}

.theme-picker  option {
	font-weight:500;
}

#dark-options option {
	color: #FFFFFF;
}

#blue {
	background: #006985;
}

#orange {
	background: #E9692C;
}

#green {
	background: #3B7856;
}

#purple {
	background: #5133AB;
}

#red {
	background: #AC193D;
}

#light-options  option{
	color: #000000;
}

#light-blue {
	background: rgb(0,165,210);
}

#light-orange {
	background: rgb(255,136,77);
}

#light-green {
	background: rgb(78, 228, 78);
}

#light-purple {
	background: rgb(191, 148, 228);
}

#light-red {
	background: rgb(232, 92, 128);
}

#submit-button {
	float:right;
	margin: .5em 1em .5em 0;
}

@media screen and (max-width:400px) {
	#admin-nav {
		float:none;
		padding:0;
	}
}

	