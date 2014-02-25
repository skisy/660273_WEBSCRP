<?php 
	header("Content-type: text/css; charset: UTF-8");
	$settings = parse_ini_file("../../incl/config.ini");
?>

body {
	font-family: "Helvetica Neue", "Helvetica", "Arial", "Tahoma", "Geneva", sans-serif;
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

#head-wrapper {
	position:fixed;
	background: <?php echo $settings['nav-colour']?>;
	box-shadow: rgba(0, 0, 0, .2) 0 3px 3px, rgba(0, 0, 0, .15) 0 -1px 0 inset;
	padding: 16px 0 9.6px;
	width: 100%;
	z-index: 2;
	overflow:hidden;
}

.header-container{
	margin: 0 auto;
	width: 1288px;
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

#products {
	display:inline-block;
	float:none;
	width:auto;
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

#admin-nav {
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

.productItem {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 240px;
	height: 360px;
	background: <?php echo $settings['background-colour'] ?>;
	position: relative;
	cursor: pointer;
	animation: fadein .8s;
    -moz-animation: fadein .8s; 
    -webkit-animation: fadein .8s;
    -o-animation: fadein .8s;
    transition: all .8s;
}

.draggedProduct {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 220px;
	height: 330px;
	background: <?php echo $settings['background-colour'] ?>;
	position: relative;
	cursor: pointer;
	opacity: 0.3;
	transition: all .8s;
}

.hiddenProduct {
	display:none;
}

.productItem:hover {
	box-shadow: 3px 3px 3px #DDD;
}

.productImg {
	display: block;
	margin: 10px auto 5px auto;
	border: 1px solid gray;
	border-radius: 5px;
	max-height:60%;
	max-width:80%
}

.itemName {
	margin: 5px auto;
	font-size: 1.2em;
	font-weight: 700;
	text-align: center;
	white-space: nowrap;
	width: 100%;                   
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

.viewItem, .addToBasket {
	color: <?php echo $settings['nav-colour']?>;
	text-decoration: none;
	padding: 7px 12px;
	border: 1px solid <?php echo $settings['nav-colour']?>;
	border-radius: 5px;
	background-color: <?php echo $settings['background-colour'] ?>;
}

.viewItem:hover, .addToBasket:hover {
	color: black;
}

.viewItem {	
	position: absolute;
	bottom: 10px;
	left: 10px;
}

.addToBasket {
	position: absolute;
	bottom: 10px;
	right: 10px;
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

label {
	float:left;
	text-align:right;
	margin-right: 15px;
	width: 100px;
}

.catDiv {
	text-align:right;
	transition: background 2.2s ease;
	display:block;
	width: 100%;
	background: rgb(250,250,250);
	border-bottom: 1px dashed <?php echo $settings['nav-colour']?>;
	position: relative;
	/*animation: fadeinright .5s;
    -moz-animation: fadeinright .5s;
    -webkit-animation: fadeinright .5s;
    -o-animation: fadeinright .5s;*/
}

.catButton, #otherCats {
	padding:15px 0;
	width: 100%;
	display:block;
	text-decoration:none;
	position:relative;
	right:10px;
	color:<?php echo $settings['nav-colour']?>;
}

.catDiv:hover {
	transition: background 0.5s ease;
	background: <?php echo $settings['background-colour'] ?>;
}

.basketLink {
	height:50px;
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

.searchToggle {
	margin-top:5px;
	display:inline-block;
	color: white;
	float:right;
	margin-right:70px;
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

.notDisplayed {
	display: none;
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

@keyframes fadeinright {
    from {
        margin-left: 220px;
		opacity: 0;
    }
    to {
        margin-left:0;
		opacity: 1;
    }
}
@-moz-keyframes fadeinright {
    from {
        margin-left: 220px;
		opacity: 0;
    }
    to {
        margin-left:0;
		opacity: 1;
    }
}
@-webkit-keyframes fadeinright {
    from {
        margin-left: 220px;
		opacity: 0;
    }
    to {
        margin-left:0;
		opacity: 1;
    }
}
@-o-keyframes fadeinright {
    from {
        margin-left: 220px;
		opacity: 0;
    }
    to {
        margin-left:0;
		opacity: 1;
    }
}

@keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-moz-keyframes fadein { /* Firefox */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-webkit-keyframes fadein { /* Safari and Chrome */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-o-keyframes fadein { /* Opera */
    from {
        opacity:0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fadeoutright {
    from {
        margin-left: 0;
		opacity: 0;
    }
    to {
        margin-left:220px;
		opacity: 1;
    }
}
@-moz-keyframes fadeoutright {
    from {
        margin-left: 0;
		opacity: 0;
    }
    to {
        margin-left:220px;
		opacity: 1;
    }
}
@-webkit-keyframes fadeoutright {
    from {
        margin-left: 0;
		opacity: 0;
    }
    to {
        margin-left:220px;
		opacity: 1;
    }
}
@-o-keyframes fadeoutright {
    from {
        margin-left: 0;
		opacity: 0;
    }
    to {
        margin-left:220px;
		opacity: 1;
    }
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

	.catButton {
		text-align:left;
		margin-left:20px;
	}	

	.catDiv {
		background:<?php echo $settings['background-colour'] ?>;
	}

	.left-content:hover {
		height:auto;
	}

	.right-content {
		border: 0; 
		margin-left:0;
	}

	#products {
		position: relative;
		margin: 0 auto;
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

	.currentCat {
		padding: 9px 15px 9px 10px;
		height: 17px;
	}
}

@media screen and (max-width:400px) {
	.productItem {
		margin: 2.5% auto;
		width: 95%;
	}

	.productImg {

	}

	footer {
		text-align:center;
	}

	#admin-nav {
		float:none;
		padding:0;
	}

	#copy {
		float:none;
	}
}
