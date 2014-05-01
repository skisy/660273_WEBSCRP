<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

@import url('admin.php');
@import url('cms.php');
@import url('keyframes.css');
@import url('shop.php');

/** Droid Sans is a Google Web Font. Retrieved from https://www.google.com/fonts#UsePlace:use/Collection:Droid+Sans **/
@font-face {
	font-family: 'Droid Sans';
	src: url('../fonts/DroidSans.ttf') format('truetype');
	font-weight:normal;
}

@font-face {
	font-family: 'Droid Sans';
	src: url('../fonts/DroidSans-Bold.ttf') format('truetype');
	font-weight:bold;
}

label[for=sample]{
	width:200px;
}

#sample {
	height:20px;
	width:20px;
}

.textNav {
	color: white;
	vertical-align:top;	
	margin:15px 25px 0 0;
	display:inline-block;
}

.sitenotification {
	background: <?php echo $settings["primary-colour"]?>;
	color:white;
	font-size:1.8em;
	text-align:center;
	margin:0;
	padding:15px 0;
}

.notificationClose {
	color:white;
	display:block;
}

html {
	min-width:300px;
}

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

.main-content h1  {
	padding:10px 0 !important;
	margin-bottom:7px;
	border-bottom: 1px solid #cccccc;	
}

h1 {
	line-height:1.3em;
	margin-top:0px;
	margin: 0;
	font-weight: 700;
	font-size: 1.5em;
	color: #333333;
}

h2 {
	font-size:1.1em;
}

.left-content h1 {
	margin:0;
	padding-left: 10px !important;
}

.centered {
	margin: 0 auto;
	display:block;
}

.rightClose {
	float:right;
}

.hoverMenuTitle {
	display:block;
	padding-bottom:2px;
	border-bottom: 1px solid #cccccc;
}

.hoverMenuTitle a {
	color:<?php echo $settings["primary-colour"]?>;
	text-decoration:underline;
}

.menuNavBtn {
	margin:5px;
}

.hoverMenuContent {
	margin: 10px 0;
	max-height:300px;
	overflow-y:scroll;
}

.hoverMenuBtn {
	font-size:1em;
	text-align:center;
	color: <?php echo $settings["primary-colour"] ?>;
}

.quickBasketRow {
	width: 100%;
	height: 100px;
}

.quickBasketRow > div {
	height:93%;
	padding: 8px 5px;
	display:inline-block;
}

.quickBasketRow p {
	margin: 2px 0;
}

.quickBasketRow a {
	text-decoration:none;
	display:block;
	margin: 2px 0;
}

.quickProdNameLink {
	color: <?php echo $settings["primary-colour"] ?>;
	font-weight: 600;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	margin: 2px 0 5px 0;
}

.quickProdCatLink {
	color: #aaaaaa;
}

.quickBasketRow a:hover {
	text-decoration: underline;
}

.quickRowPrice {
	color:#900000;
}

.quickRowImg {
	width:30%;
}

.quickRowItemImg {
	max-height:85%;
	max-width:85%;
	display:block;
	margin: 0 auto;
}

.quickRowDetail {
	width:60%;
	vertical-align:top;
	position:relative;
	overflow:hidden;
	text-overflow: ellipsis;
}

.quickTotal {
	margin:10px 0;
	font-size:1.2em;
	color:green;
}

.quickTotal strong {
	color:black;
}

.menuNav {
	width: 180px !important;
}

.menuNav .hoverMenuContent {
	overflow-y:hidden;
}

.menuNav:before, .menuNav:after {
	left:88%;
}

.hoverMenu {
	visibility:hidden;
	position:absolute;
	top:55px;
	width:300px;
	right:-5px;
	background:white;
	border-radius:3px;
	border: 1px solid #bbbbbb;
	padding:10px;
	font-size:.9em;
	box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2);
}

.hoverMenu:after, .hoverMenu:before {
	bottom: 100%;
	border: solid transparent;
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	content: " ";
}

.quickBasket:after, .quickBasket:before {
	left: 93%;
}

.hoverMenu:after {
	border-color: transparent;
	border-bottom-color: white;
	margin-left: -10px;
	border-width: 10px;
}

.hoverMenu:before {
	border-color: transparent;
	border-bottom-color: #bbbbbb;
	margin-left: -11px;
	border-width: 11px;
}

#head-wrapper {
	position:fixed;
	background: <?php echo $settings['primary-colour']?>;
	box-shadow: rgba(0, 0, 0, .2) 0 3px 3px, rgba(0, 0, 0, .15) 0 -1px 0 inset;
	padding: 5px 0;
	width: 100%;
	z-index: 10;
	min-width:340px;
}

.header-container {
	margin: 0 auto;
	width: 1288px;
	min-height:55px;
}

#shop-name {
	position: relative;
	display:inline-block;
	vertical-align:top;
	width: 210px;
	height: 100%;
	max-height:32px;
	padding:8px 35px 0 7.2px;
	overflow:hidden;
	font-size:1em;
	word-wrap:break-word;
}

#shop-name h1 {
	font-size:1.5em;
	margin: 0;
}

#shop-name a {
	font-family: Arial;
	text-decoration: none;
	color: <?php echo $settings['tertiary-colour']?>;
	font-weight:700;
}

#search-bar {
	width: 100%;
	position: relative;
}

.shopSearch {
	display:inline-block;
	vertical-align:top;
	position: relative;
	font-size: 0.73em;
	width:calc(100% + 13px);
	margin-left:-13px;
}

#searchInput {
	padding: 0 0 0 10px;
	height:51px;
	width:calc(100% - 10px);
	background: <?php echo $settings["secondary-colour"]?> url('/660273/img/svg/search.svg') left no-repeat;
	background-position: 10px;
	background-size:36px;
	border-bottom: 1px solid rgb(220, 220, 220);
	border-left: none;
	border-right:none;
	border-top:none;
	position:relative;
	font-size:2em;
	color:<?php echo $settings["primary-colour"]?>;
	text-indent:45px;
}

#searchInput::-webkit-input-placeholder {
	color:gray;
}

#searchInput:focus {
	box-shadow: 0 0 5px white;
	outline:none;
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
	border: solid 2px <?php echo $settings['tertiary-colour']?>;
	position: relative;
}

.search-icon:hover {
	box-shadow: 0 0 5px white;
}

.topButton {
	cursor:pointer;
	display:inline-block;
}

.topButton svg {
	fill: <?php echo $settings['basket-colour']?>;
	width:50px;
	height:45px;
	pointer-events:none;
}

.topButton:hover svg {
	-webkit-filter: drop-shadow( 1px 1px 1px #fff );
    filter: drop-shadow( 1px 1px 1px #fff );
}

.topNav {
	position:relative;
	top:5px;
	display:inline-block;
	float:right;
}

.menuButton {
	right:15px;
	position:relative;
}

.basketButton { 
	min-width: 50px; 
	position: relative;
}

#quantityContainer {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	text-align:center;
	pointer-events:none;
}

.basket-quantity {
	display:inline-block;
	margin:5px 0 0 5px;
	text-decoration: none;
	color: <?php echo $settings['tertiary-colour']?>;
	font-style: italic;
	font-weight: 700;
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
	padding-top:65px;
}

.main-content h1 {
	padding: 5px 0 0 5px;
}

.left-content {
	height: auto;
	width: 205px;
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
	border-left: 1px solid <?php echo $settings['primary-colour']?>;
	position:relative;
	margin-left:205px;
}

footer {
	border-top: 1px solid gray;
	overflow:hidden;
	margin: 0 auto;
	padding-left: 20px;
	background: <?php echo $settings['primary-colour']?>;
	font-size: 0.9em;
	clear:both;
}

footer a {
	font-weight: 600;
	color: <?php echo $settings['tertiary-colour']?>;
}

#copy {
	display: inline;
	float: left;
	color: <?php echo $settings['tertiary-colour']?>;
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

.formGroup {
	display:block;
	width:100%;
}

.basketTipDisplay {
	color: <?php echo $settings['primary-colour']?>;
	position: absolute;
	width: 100px;
	background: <?php echo $settings['secondary-colour']?>;
	padding: 7px;
	border-radius: 10px;
	border: 2px solid <?php echo $settings['primary-colour']?>;
	font-size: .8em;
	text-align: center;
	left:-130px;
	box-shadow: 0px 0px 10px 4px rgba(255, 255, 255, 0.75);
}

@media screen and (max-width:1288px) {

	.topNav {
		position: absolute;
		right:5px;
		top:10px;
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
		padding: 5px 0;
	}
	
	.header-container {
		width: 100%;
	}

	.navDown {
		position:fixed;
		width:100%;
		height: auto;
		top:60px;
		background: <?php echo $settings["primary-colour"]?>;
		transition: all .3s;
	}

	.basket {
		position:absolute;
		top:4px;
		right: 10px;
	}
	
	.basket {
		right: 5px;
	}
	
	#shop-name {
		padding:0;
		position:absolute;
		top:13px;
		left:8px;
	}
}

@media screen and (max-width:400px) {

	footer {
		text-align:center;
		padding-bottom:10px;
	}

	#copy {
		float:none;
	}

	#quantityToAdd {
		height:auto;
	}

	.textNav {
		display:none;
	}
}

@media screen and (max-width:532px) {
	.right-content {
		padding-left:1px !important;
	}
}
