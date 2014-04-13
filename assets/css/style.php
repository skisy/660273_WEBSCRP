<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

@import url('admin.php');
@import url('cms.php');
@import url('keyframes.css');
@import url('shop.php');


body {
	font-family: "Droid Sans", sans-serif;
	font-size: 1em;
	width: 100%;
	background-color: rgb(255, 255, 255);
	overflow-y: scroll;
	overflow-x: hidden;
	margin: 0;
	min-width: 300px;
}

a, img {
	border: none;
}

h1 {
	line-height:1.3em;
	margin-top:0px;
	margin: 0;
	font-weight: 700;
	font-size: 1.5em;
	color: #333;
}

.left-content h1 {
	margin:0;
	padding-left: 10px !important;
}

#head-wrapper {
	position:fixed;
	background: <?php echo $settings['nav-colour']?>;
	box-shadow: rgba(0, 0, 0, .2) 0 3px 3px, rgba(0, 0, 0, .15) 0 -1px 0 inset;
	padding: 16px 0 9.6px;
	width: 100%;
	z-index: 2;
	overflow:hidden;
}

.header-container {
	margin: 0 auto;
	width: 1288px;
	min-height:55px;
}

#shop-name {
	position: relative;
	float: left;
	width: auto;
	padding:8px 80px 0 7.2px;
	height: 100%;
}

#shop-name h1 {
	font-size:1.5em;
	margin: 0;
}

#shop-name a {
	font-family: Arial;
	text-decoration: none;
	color: <?php echo $settings['foreground-colour']?>;
	font-weight:700;
}

#search-bar {
	width: 100%;
	position: relative;
}

#top-search {
	margin: 0;
	float: left;
	position: relative;
	font-size: 0.73em;
}

#searchInput {
	padding: 0 0 0 10px;
	margin-top:10px;
	width:827px;
	/*background: #fff url('/660273/img/searchIcon.png') left no-repeat; */
	outline: 0px;
	height: 23px;
	border: 1px solid rgb(220, 220, 220);
	border-top-right-radius: 10px;
	border-bottom-right-radius: 10px;
	position:relative;
}

#searchInput:focus {
	box-shadow: 0 0 5px white;
	border: 1px solid white;
}

input[type=radio] {
	box-shadow:none;
	border:none;
	height:11px;
}

.search-icon {
	cursor: pointer;
	height: 26px;
	width: 26px;
	border-radius: 50%;
	background: url(<?php echo $settings['search-icon']?>) left no-repeat;
	margin: 2px 0 0 5px;
	border: solid 2px <?php echo $settings['foreground-colour']?>;
	position: relative;
}

.search-icon:hover {
	box-shadow: 0 0 5px white;
}

.basket { 
	display:inline-block;
	position:relative;
	margin: 0 10px 0 10px;
	min-width: 50px; 
}

#quantityContainer {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	text-align:center;
}

.basket-quantity {
	display:inline-block;
	margin:15px auto 0 auto;
	text-decoration: none;
	color: <?php echo $settings['foreground-colour']?>;
	font-style: italic;
	font-weight: 700;
}

#basketSvg {
	height: 50px;
	width: 50px;
}

#basketSvg g {
	fill: <?php echo $settings['basket-colour']?>;
}

#wrapper {
	position: relative;
	box-shadow: 0 0 20px #888888;
	width: 1288px;
	margin: 0 auto;
	z-index: 1;
}

.main-content {
	overflow:hidden;
	height: auto;
	background: rgb(250,250,250);
	padding-top:80px;
}

.main-content h1 {
	padding: 5px 0 0 5px;
}

.left-content {
	height: auto;
	width: 235px;
	z-index: 11;
	position:fixed;
}

.left-content h1 {
	padding-left:12px;
}

.right-content {
	height: auto;
	z-index:10;
	min-height: 500px;
	padding: 0 0 8px 14px;
	background: rgb(250,250,250);
	overflow:hidden;
	border-left: 1px solid <?php echo $settings['nav-colour']?>;
	position:relative;
	margin-left:235px;
}

footer {
	border-top: 1px solid gray;
	overflow:hidden;
	margin: 0 auto;
	padding-left: 20px;
	background: <?php echo $settings['nav-colour']?>;
	font-size: 0.9em;
	clear:both;
}

footer a {
	font-weight: 600;
	color: <?php echo $settings['foreground-colour']?>;
}

#copy {
	display: inline;
	float: left;
	color: <?php echo $settings['foreground-colour']?>;
}

label {
	float:left;
	text-align:left;
	margin-right: 15px;
	width: 150px;
}

.basketLink {
	height:50px;
}

.searchToggle {
	margin-top:5px;
	display:inline-block;
	color: white;
	float:right;
	margin-right:70px;
}

.formGroup {
	display:block;
	width:100%;
}

.basketTipDisplay {
	color: <?php echo $settings['nav-colour']?>;
	position: absolute;
	width: 100px;
	background: <?php echo $settings['background-colour']?>;
	padding: 7px;
	border-radius: 10px;
	border: 2px solid <?php echo $settings['nav-colour']?>;
	font-size: .8em;
	text-align: center;
	left:-130px;
	box-shadow: 0px 0px 10px 4px rgba(255, 255, 255, 0.75);
}

@media screen and (max-width:1288px) {

	.main-content {
		padding-top:150px;
	}
	
	body {
		overflow-y:scroll;
		overflow-x:hidden;
		width:100%;
	}
	#wrapper {
		width:100%;
	}
	
	#head-wrapper {
		width: 100%;
	}
	
	.header-container {
		width: 100%;
	}
	
	#top-search {
		margin-top:15px;
		margin-left:10px;
	}
	
	#searchInput {
		height: 35px;
	}
	
	#searchInput {
		width: 100%;
	}
	
	.basket {
		position:absolute;
		top:10px;
		right: 10px;
	}

	.search-icon {
		display: none;
	}
	
	.left-content {
		display:none;
		height: 50px;
		width: 100%;
		float:none;
		position:absolute;
		x: -90%;
	}

	.left-content:hover {
		height:auto;
	}

	.right-content {
		border: 0; 
		margin-left:0;
		padding-left:1px !important;
	}
	
	.basket {
		right: 5px;
	}
	
	#shop-name {
		padding-left: 10px;
	}

	.searchToggle {
		margin-right:15px;
	}
}

@media screen and (max-width:400px) {

	footer {
		text-align:center;
	}

	#copy {
		float:none;
	}
}
