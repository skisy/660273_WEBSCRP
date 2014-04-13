<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

.addToBasket {
	position: absolute;
	bottom: 10px;
	right: 10px;
}

.basketConfirmation {
	text-align: center;
	border-radius:5px;
	margin: 0 10px 10px 10px;
	padding: 7px;
	border:1px solid green;
	background-color: #C8E2C8;
}

.basketLink {
	height:50px;
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

.catButton, #otherCats {
	padding:10px 0;
	width: 100%;
	display:block;
	text-decoration:none;
	color:<?php echo $settings['nav-colour']?>;
}

.catDiv {
	text-align: right;
	transition: background 2.2s ease;
	display:block;
	background: rgb(250,250,250);
	border-bottom: 1px solid <?php echo $settings['background-colour']?>;
	position: relative;
	padding-right:20px;
	/*animation: fadeinright .5s;
    -moz-animation: fadeinright .5s;
    -webkit-animation: fadeinright .5s;
    -o-animation: fadeinright .5s;*/
}

.catDiv:hover {
	transition: background 0.5s ease;
	background: <?php echo $settings['background-colour'] ?>;
}

.catDropdown {
	display:inline-block;
	cursor:pointer;
	opacity:0;
	margin:9px 0 0 5px;
	position:absolute;
	top:2px;
	left:0;
	background: <?php echo $settings['background-colour'] ?>;
}

#catSelect {
	height: 24px;
	cursor:pointer;
	position:relative;
}

.currentCat {
	height: 15px;
	margin-top:10px;
	padding: 4px 15px;
	float:left;
	background: <?php echo $settings['background-colour'] ?> url('/660273/img/search-down-arrow.png') 99% 50% no-repeat;
	border: 1px solid rgb(220,220,220);
	border-top-left-radius:10px;
	border-bottom-left-radius:10px;
}

.draggedProduct {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 240px;
	height: 360px;
	border:1px solid <?php echo $settings['background-colour'] ?>;
	background: <?php echo $settings['background-colour'] ?>;
	position: relative;
	cursor: pointer;
	opacity: 0.3;
	outline:none;
	transition: all .8s;
}

#goBack {
	cursor: pointer;
	display:inline-block;
	margin: 10px;
	padding: 10px;
	background: <?php echo $settings['background-colour'] ?>;
	border: 2px solid <?php echo $settings['nav-colour'] ?>;
	border-radius: 5px;
	animation: fadein .5s;
    -moz-animation: fadein .5s; 
    -webkit-animation: fadein .5s;
    -o-animation: fadein .5s;
}

#goBack:hover {
	box-shadow: 0 0 5px gray;
}

.hiddenProduct {
	display:none;
}

.itemCat {
	position:absolute;
	bottom:65px;
	white-space: nowrap;
	width: 96%;
	margin-left:10px;               
	overflow: hidden;
	text-overflow:ellipsis;
}

.itemName {
	margin: 5px auto;
	font-size: 1.2em;
	font-weight: 700;
	text-align: center;
	white-space: nowrap;
	width: 97%;                   
	overflow: hidden;
	text-overflow:ellipsis;
}

.itemPrice {
	position:absolute;
	bottom: 50px;
	margin: 5px 0;
	display:block;
	float: left;
	left: 10px;
}

.itemPrice strong {
	color: green;
}

.itemQuantity {
	margin: 5px 0;
	display:block;
	float:right;
	position:absolute;
	bottom: 50px;
	right: 10px;
}

.itemQuantity strong {
	color: red;
}

#loader {
	float:none;
	display:inline-block;
	margin: 23% auto 0 auto;
	animation: fadein .5s;
    -moz-animation: fadein .5s;
    -webkit-animation: fadein .5s;
    -o-animation: fadein .5s; 
}

#noProducts {
	margin: 10px;
	padding:10px;
	background: <?php echo $settings['background-colour'] ?>;
	border: 2px solid <?php echo $settings['nav-colour'] ?>;
	border-radius: 5px;
	text-align: center;
	animation: fadein .5s;
    -moz-animation: fadein .5s; 
    -webkit-animation: fadein .5s;
    -o-animation: fadein .5s;
}


.notDisplayed {
	display: none;
}

.productButtons {
	position:absolute;
	bottom:0;
	left:0;
	right:0;
}

.productImg {
	display: block;
	margin: 10px auto 5px auto;
	border: 1px solid gray;
	border-radius: 5px;
	max-height:60%;
	max-width:80%
}

.productItem {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 240px;
	height: 360px;
	border:1px solid <?php echo $settings['background-colour'] ?>;
	position: relative;
	cursor: pointer;
	animation: fadein .8s;
    -moz-animation: fadein .8s; 
    -webkit-animation: fadein .8s;
    -o-animation: fadein .8s;
    transition: all .3s;
}

.productItem a {
	color: <?php echo $settings['nav-colour']?>;
}

.productItem:focus {
	background: <?php echo $settings['background-colour'] ?>;
	box-shadow: 3px 3px 3px #DDDDDD;
	outline:none;
}

.productItem:hover {
	background: <?php echo $settings['background-colour'] ?>;
	box-shadow: 3px 3px 3px #DDDDDD;
}

#products {
	display:inline-block;
	float:none;
	width:auto;
}

.viewItem, .addToBasket {
	color: <?php echo $settings['nav-colour']?>;
	text-decoration: none;
	padding: 7px 12px;
	border: 1px solid <?php echo $settings['nav-colour']?>;
	border-radius: 5px;
	background-color: <?php echo $settings['background-colour'] ?>;
}

.viewItem {	
	position: absolute;
	bottom: 10px;
	left: 10px;
}

.viewItem:hover, .addToBasket:hover {
	color: black;
}

@media screen and (max-width:1288px) {
	
	.catButton {
		text-align:left;
		margin-left:20px;
	}	

	.catDiv {
		background:<?php echo $settings['background-colour'] ?>;
	}

	.currentCat {
		padding: 10px 15px 9px 10px;
		height: 16px;
	}

	#products {
		position: relative;
		margin: 0 auto;
	}
}

@media screen and (max-width:400px) {

	.productItem {
		margin: 2.5% auto;
		width: 99%;
	}
}
