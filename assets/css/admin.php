<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

.summaryDiv {
	margin-bottom:5px;
}

.viewLink {
	text-decoration:none;
	color:<?php echo $settings["primary-colour"]?>;
}

.viewLink:hover {
	text-decoration:underline;
}

#adminOverviewText li {
	margin:10px 0;
}

.secondHeading {
	margin-top: 50px;
}

.noLink {
	pointer-events:none;	
}

.tableLink {
	color: <?php echo $settings["primary-colour"]?>;
	cursor:pointer;
}

.tableLink:hover {
	color: <?php echo $settings["primary-colour"]?>;
	text-decoration:underline;
}

thead tr td {
	border-bottom:2px solid <?php echo $settings["primary-colour"]?>;
}

#popularProds {
	font-size:.9em;
}

.adminOverview p {
	margin-left:20px;
}

.important {
	font-weight:bold;
	color:#900000;
	margin-left:10px;
}

.siteSettings fieldset {
	margin-bottom:20px;
	border:1px solid #cccccc;
	border-radius:5px;
}

.siteSettings h1 {
	font-size:1.2em;
}

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

.theme-picker option {
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

input[type=submit] {
	float:right;
	margin: .5em 1em .5em 0;
	padding:20px;
	width:150px;
	color:<?php echo $settings["primary-colour"]?>;
	cursor:pointer;
}

@media screen and (max-width:400px) {
	#admin-nav {
		float:none;
		padding:0;
	}
}