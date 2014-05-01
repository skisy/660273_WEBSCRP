<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

#orderProducts {
	margin-bottom: 30px;
	visibility:hidden;
}

#browseCatLink {
	margin-bottom:15px;
}

.goHome {
	margin:3px 0 0 0;
	float:right;
	cursor:pointer;
}

.goHome svg {
	width:50px;
	height:40px;
	fill:<?php echo $settings["primary-colour"]?>;
}

.goHome:hover svg {
 	-webkit-filter: drop-shadow( -1px -1px 2px #666666 );
    filter: drop-shadow( -1px -1px 2px #666666 );
}

.addContainer .basketConfirmation {
	position:static;
}

.emptyBasket {
	cursor:pointer;
}

.qLabel {
	font-size:.9em;
	padding-top:5px;
	vertical-align:middle;
	width:auto;
	float:none;
	font-weight:bold;
}

.productAddBtn {
	display:inline-block;
	font-size:1em;
	color:<?php echo $settings["primary-colour"]?>;
	padding:10px;
	margin-left: 10px;
}

.addQuantity {
	width: 50px;
}

a svg {
	pointer-events:none;	
}

.viewSpan {
	pointer-events:none;
}

.addContainer {
	display:block;
	//background:<?php echo $settings["secondary-colour"]?>;
	//border:1px solid <?php echo $settings["primary-colour"]?>;
	//padding:20px 10px;
	//border-radius:3px;
	margin: 10px 10px 0 0;
	text-align:center;
}

.productImages {
	width:60px;
	display:inline-block;
	vertical-align:top;
}

.productMainInfo {
	display:inline;
	vertical-align:top;
}

.productDetailDiv {
	width:80%;
}

.addImgContainer {
	border:1px solid #cccccc;
	margin-bottom:3px;
	text-align:center;
	cursor:pointer;
	max-height:80px;
}

.addImgContainer:hover {
	border:1px solid <?php echo $settings["primary-colour"]?>;
}

.addImg {
	max-width:90%;
	max-height:90%;
	padding:2px;
} 

.prodImgContain {
	display:inline-block;
	width: 500px;
	max-width:30%;
	min-width:250px;
	max-height:250px;
	vertical-align:top;
	text-align:center;
	margin: 0 10px;
	cursor:pointer;
}

.prodDetailImg {
	max-width:90%;
	max-height:225px;
}

.prodDetailDiv {
	display:inline-block;
	vertical-align:top;
}

.prodDetailName {
	font-weight: 700;
	font-size:1.32em;
	margin:0 0 7px 0;
	color:<?php echo $settings["primary-colour"] ?>;
}

.prodDetailCat {
	margin: 0 0 20px 20px;
}

.prodDetailCat a {
	text-decoration:none;
	color:#666666;
}

.prodDetailCat a:hover {
	text-decoration:underline;
}

.prodDetailPrice {
	font-size:.8em;
	vertical-align:top;
	color:#666666;
}

.prodDetailPrice strong {
	font-size:1.5em !important;
	color:#900000;
}

.boldred {
	color:#900000;
}

.boldgreen {
	color:green;
}

.red {
	color:#900000;
}

.prodDetailDesc {
	color:#191919;
	font-size:.9em;
}

.productMeta {
	margin: 20px 0 30px 0;
}

.productData {
	min-height:172px;
}

#prodDetailDescHead, #productMetaHead {
	color:<?php echo $settings["primary-colour"]?>;
	padding:3px 0 !important;
	font-size:1em;
	margin-bottom:10px;	
}

#prodDetailDescHead {
	font-size:1.1em;
	display:block;
}

.productMeta td {
	min-width: 100px;
}

.emptyBasket {
	color:red;
	text-decoration:underline;
	font-size:.9em;
	font-weight:700;
	float:right;
	margin-right:15px;
}

.addCompareItemBasket {
	float:left;
}

.compareButtons {
	height:40px;
}

.itemCompareDiv .basketConfirmation {
	position:static !important;
	height:22px ;
}

.selectedCat {
	text-decoration:underline;
	cursor:pointer;
}

.browseCats h1 {
	padding:5px 0 5px 5px;
	border-bottom:1px solid #cccccc;
}

.closeOverlay {
	float:right;
	margin: 10px 7px 0 0;
	color:<?php echo $settings["primary-colour"]?>;
}

.browseCats {
	background:white;
	border:1px solid #cccccc;
	border-radius:5px;
	margin: 50px auto 0 auto;
	width: 70%;
}

.overlay {
	position:absolute;
	width:100%;
	height:100%;
	background: rgba(0,0,0,.7);
	z-index:100;
	transition:all .7s;
}

.inactive {
	width: 0;
	height: 0;
	opacity: 0;
	z-index:-1;
	overflow:hidden;
}

.compareButton {
	padding:5px;
	border: 1px solid #aaaaaa;
	border-radius: 5px;
	background: #f0f0f0;
	bottom:5px;
	height:27px;
	display:inline-block;
	color:<?php echo $settings["primary-colour"]?>;
	text-decoration:none;
	cursor:pointer;
}

.compareButton svg {
	pointer-events:none;
}

.itemMetaDiv {
	margin: 25px 0 5px 0;
}

.itemMetaDiv strong {
	border-bottom: 1px solid #cccccc;
	display:block;
	padding-bottom:2px;
}

.removeCompareItem {
	float:right;
}

.removeCompareItem svg {
	height:26px;
	width:26px;
}

.compareButton strong {
	vertical-align:middle;
}

.compareButton:hover {
	background: <?php echo $settings["primary-colour"]?>;
	color:white;
}

.compareButton:hover svg g {
	fill:white;
}

.compareButtons {
	margin-bottom:10px;
}

.itemCompareDiv {
	width:21%;
	margin: 5px;
	padding:10px;
	display:inline-block;
	border: 1px solid #cccccc;
	border-radius:5px;
	font-size: .9em;
	vertical-align:top;
	min-height:100%;
	position:relative;
	min-width:190px;
}

.compareImgDiv {
	text-align: center;
}

.compareImg {
	max-width:90%;
	max-height:90%;
}

.compareItemPrice {
	color:#900000;
}

.compareItemPrice strong {
	color:black;
}

.compareItemDetails > p
{
	margin: 10px 0;
}

.compareItemDesc {
	margin: 15px 0 !important;
	color:#4c4c4c;
}

.compareItemName {
	text-align:center;
	color:<?php echo $settings["primary-colour"]?>
}

.compareItemMeta {
	width:99%;
	max-width:99%;
	margin: 0 auto;
	display:block;
}

.compareMetaName {
	font-weight:bold;
}

.orderStatusResult {
	color:green;
}

.orderStatus {
	margin: 35px 0 20px 0;
}

.trackLabel {
	float:none;	
}

.trackBtn {
	display:inline-block;
	font-size:.9em;
	color: <?php echo $settings["primary-colour"] ?>;
	margin-left:30px;
	width:100px;
	text-align:center;
}

.closeNotif {
	margin-left:15px;
}

.removing {
	opacity:.8;
	height:0;
	overflow:hidden;
	transition: height .5 3s;
}

.payButton {
	float:none !important;
	margin: 0 5px 40px 5px !important; 
	padding: 15px 5px !important;
	text-align:center;
	top: 119px;
	right:0;
}

.payDiv span {
	font-size:1.4em;
	font-weight:700;
	color:#900000;
}

.payDiv {
	height:135px;
	text-indent: 10px;
	vertical-align:top;
	margin: 0 5px 5px 5px!important;
	max-width:24%;
	width:270px;
	min-width: 170px;
	position:absolute;
	top:59px;
	right:5px;
}

.detailsDiv {
	width:60%;
}

.checkoutBasket .checkoutItemRow:last-child {
	border:none;
}

.checkoutItemName {
	font-size:1.1em;
}

.checkoutItemRow {
	padding: 15px 15px 10px 15px;
	font-size:.9em;
	border-bottom:1px solid #cccccc;
}

.checkoutItemRow div {
	margin-bottom: 3px;
}

.checkoutItemPrice {
	color:#900000;
	margin-left:15px;
}

.checkoutBasketTitle {
	border-bottom:1px solid #cccccc;
	padding:10px;
}

.checkoutBasket {
	padding:0 !important;
	width:calc(60% + 10px);
}

.checkoutBasket > strong {
	font-size:1.2em;
}

.checkoutBasket a {
	margin-left:5px;
	font-size:.8em;
	text-decoration:none;	
}

.checkoutBasket a:hover {
	text-decoration:underline;
}

.checkoutDiv {
	display:inline-block;
	border: 1px solid #cccccc;
	border-radius:5px;
	padding:10px 5px;
	margin: 0 10px 10px 0;
}

.addressContent {
	display:inline-block;
	width:40%;
	margin-right:10px;
}

.addressContent a {
	margin-left:5px;
	font-size:.8em;
	text-decoration:none;
}

.addressContent a:hover {
	text-decoration:underline;
}

.addressContent ul {
	list-style-type:none;
	font-size:.9em;
	margin:2px 0 0 0;
	padding:0;
	word-wrap:break-word;
}

.contactContent {
	display:inline-block;
	vertical-align:top;
}

.contactContent p {
	margin: 2px 0 0 0;
	font-size:.9em;
}

#custRef {
	display:none;
}

.optionalGrp {
	margin-top:30px !important;
	font-size:.9em;
}

.optionalGrp label {
	font-weight: normal;
	width:auto;
	margin-top:1px;
}

.checkoutBtn {
	float:right;
}

.basketRow:hover {
	background: <?php echo $settings["secondary-colour"]?>;
}

.priceChange {
	color: #900000 !important;
}

.notification {
	border:1px solid orange;
	background: rgba(255,165,0,0.3);
}

.basketMsg {
	width:90%;
	margin-bottom:10px;
}

.insufStock {
	border:1px solid orange !important;
}

.basketTotal {
	margin:25px 0;
	padding-left:calc(45% + 25px);
}

.basketTotal span {
	color: green;
	font-weight:600;
}

.goShoppingBtn {
	float:left !important;
	margin-left:5px !important;
}

.goShoppingBtn svg {
	-webkit-transform: scaleX(-1);
    transform: scaleX(-1);
}

.basketHead {
	border-bottom: 2px solid <?php echo $settings["primary-colour"]?>;
	padding-bottom:4px;
}

.basketHead div {
	display:inline-block;
	font-size: .9em;
	font-weight:600;
}

.nameHead {
	width:calc(50% + 70px);
	padding-left:10px;
}

.quantityHead {
	padding-left:20px;
}

.rowItemImg {
	max-width:85%;
	max-height:85%;
	display:block;
	margin: 0 auto;
}

.prodDelete {
	text-decoration:underline;
	font-size:.9em;
	cursor:pointer;
	width:auto;
	position:absolute;
	bottom:20px;
	left:20px;
}

.prodDelete:hover {
	color:red;
}

.prodNameLink {
	font-weight:600;
	white-space:nowrap;
	text-overflow:ellipsis;
	overflow:hidden;
}

.toOther {
	cursor:pointer;
	padding:16px 0;
}

.prodCatLink {
	margin-top:4px;
	display:inline-block;
	color: #aaaaaa !important;
	font-size:.8em;
	padding-left:20px;
	width: auto;
	position: absolute;
	top:30px;
	left:0;
	max-height:32px;
	overflow: hidden;
	text-overflow: ellipsis;
}

.basketRow {
	width:99%;
	height:100px;
	border-bottom: 1px solid #cccccc;
	position:relative;
	min-width:319px;
}

.basketRow div {
	display:inline-block;
}

.basketRow > div {
	height:90%;
	display:inline-block;
	padding:8px 5px 8px 5px;
}

.rowImg {
	width:100px;
}

.rowDetail {
	width:40%;
	vertical-align:top;
	position:relative;
	overflow:hidden;
	text-overflow:ellipsis;
}

.rowDetail a {
	color: <?php echo $settings["primary-colour"]?>;
	text-decoration:none;
}

.rowDetail a:hover {
	text-decoration:underline;
}

.rowPrice {
	width:10%;
	vertical-align:top;
	margin-top:10px;
	font-size:.9em;
	font-weight:600;
	color:green;
	text-align:right;
	padding-right:20px !important;
}

.rowQuantity {
	width:45px;
	vertical-align:top;
	margin-top:5px;
}

.rowQuantity input {
	width:40px;
	text-align:center;
}

.basketControls {
	font-size:1em;
	padding:5px;
	float:right;
	margin:6px 5px 0 0;
	color: <?php echo $settings["primary-colour"] ?>;
	font-weight:600;
}

.basketControls svg {
	display:inline;
	height:100%;
	width:25px;
	height:25px;
	margin:0 0 2px 10px;
	vertical-align:middle;
}

.basketControls:hover svg {
	fill:white;
}

.left-content h1 {
	padding: 10px 0 !important;
	margin-bottom: 7px;
	border-bottom: 1px solid #cccccc;
}

.stockOut {
	color:red !important;
}

.descText {
	position:absolute;
	width: 98%;
	margin: 10px;
	display:none;
}

.basketConfirmation {
	position:absolute;
	top:auto;
	bottom:5px;
	left:5px;
	right:5px;
	padding:10px 5px 5px 5px;
	text-align: center;
	border-radius:5px;
	border:1px solid green;
	background: #C8E2C8;
	height:22px;
	margin:0;
}

.basketLink {
	height:50px;
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

.catButton, #otherCats {
	padding:10px 0;
	width: 100%;
	display:block;
	text-decoration:none;
	color:<?php echo $settings['primary-colour']?>;
}

.catDiv {
	text-align: right;
	transition: background 2.2s ease;
	display:block;
	background: rgb(250,250,250);
	border-bottom: 1px solid <?php echo $settings['secondary-colour']?>;
	position: relative;
	padding-right:10px;
	/*animation: fadeinright .5s;
    -moz-animation: fadeinright .5s;
    -webkit-animation: fadeinright .5s;
    -o-animation: fadeinright .5s;*/
}

.catDiv:hover {
	transition: background 0.5s ease;
	background: <?php echo $settings['secondary-colour'] ?>;
}

.catDropdown {
	display:inline-block;
	cursor:pointer;
	opacity:0;
	position:absolute;
	top:2px;
	left:0;
	background: <?php echo $settings['secondary-colour'] ?>;
	padding:10px 0 20px 0;
}

#catSelect {
	cursor:pointer;
	position:relative;
}

.currentCat {
	height: 21px;
	padding: 15px 15px;
	float:left;
	background: <?php echo $settings['secondary-colour'] ?> url('/660273/img/search-down-arrow.png') 95% 50% no-repeat;
	border-bottom: 1px solid rgb(220,220,220);
	width:160px;
	font-size:1.3em;
}

.draggedProduct {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 240px;
	height: 360px;
	border:1px solid <?php echo $settings['secondary-colour'] ?>;
	background: <?php echo $settings['secondary-colour'] ?>;
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
	background: <?php echo $settings['secondary-colour'] ?>;
	border: 2px solid <?php echo $settings['primary-colour'] ?>;
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
	pointer-events:none;
}

.itemPrice {
	position:absolute;
	bottom: 50px;
	margin: 5px 0;
	display:block;
	float: left;
	left: 10px;
	pointer-events:none;
}

.itemPrice strong {
	color: #900000;
}

.itemQuantity {
	margin: 5px 0;
	display:block;
	float:right;
	position:absolute;
	bottom: 50px;
	right: 10px;
	pointer-events:none;
}

.itemQuantity strong {
	color: green;
}

#loader {
	float:none;
	margin-top:22%;
	animation: fadein .5s;
    -moz-animation: fadein .5s;
    -webkit-animation: fadein .5s;
    -o-animation: fadein .5s; 
}

#noProducts {
	margin: 10px;
	padding:10px;
	background: <?php echo $settings['secondary-colour'] ?>;
	border: 2px solid <?php echo $settings['primary-colour'] ?>;
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
	max-height:55%;
	max-width:80%;
	pointer-events:none;
}

.productItem {
	float:left;
	font-size: .9em;
	margin: 10px 10px 0 0;
	width: 240px;
	height: 330px;
	border:1px solid <?php echo $settings['secondary-colour'] ?>;
	position: relative;
	cursor: pointer;
	animation: fadein .8s;
    -moz-animation: fadein .8s; 
    -webkit-animation: fadein .8s;
    -o-animation: fadein .8s;
    transition: all .3s;
    background:white;
}

.productItem a {
	color: <?php echo $settings['primary-colour']?>;
}

.productItem:focus {
	background: <?php echo $settings['secondary-colour'] ?>;
	box-shadow: 3px 3px 3px #DDDDDD;
	outline:none;
}

.productItem:hover {
	background: <?php echo $settings['secondary-colour'] ?>;
	box-shadow: 3px 3px 3px #DDDDDD;
}

#products {
	display:block;
	float:none;
}

.productOptBtn {
	text-decoration: none;
	padding:5px;
	border: 1px solid #aaaaaa;
	border-radius: 5px;
	background: #f0f0f0;
	position:absolute;
	bottom:5px;
	height:27px;
}

.productOptBtn:hover {
	background:<?php echo $settings['primary-colour'] ?>;
	color: white;
}

.productOptBtn:hover g {
	fill:white;
}

.compareItem {
	right:50px;	
}

.viewItem {	
	left: 5px;
	width:128px;
}

.viewItem svg {
	vertical-align:middle;
}

.viewSpan {
	padding-left: 10px;
	vertical-align:middle;
	display:inline;
}

.addToBasket {
	right: 5px;
}

.iconG {
	fill:#aaaaaa;
}

@media screen and (max-width:1288px) {

	.currentCat {
		padding: 10px 15px 9px 10px;
		height: 16px;
	}

	#products {
		position: relative;
		margin: 0 auto;
	}

	.goShoppingBtn {
		display:block;
	}
}

@media screen and (max-width:918px) {
	.itemCompareDiv {
		width:40%
	}
}

@media screen and (max-width:750px) {

	.left-content {
		display:none;
	}

	.right-content {
		margin-left:0 !important;
	}

	.productItem {
		width:45%;
	}

	.browseCats {
		width:90%;
	}

	.compareItemMeta {
		display:initial !important;
	}

	.compareItemMeta tr {
		border: initial !important;
	}

	.checkoutDiv {
		width:95% !important;
		margin: 0 0 10px 0 !important;
	}
 
	.checkoutBasket {
		width:calc(95% + 10px) !important;
	}

	.payDiv {
		text-align:center;
		display:block;
		position:static;
		max-width:95% !important;
	}

	.itemCompareDiv {
		width: 43%;
	}
}

@media screen and (max-width:532px) {
	.browseCats {
		width:100%;
	}

	#searchInput {
		background-position:15px !important;
	}

	.itemCompareDiv {
		width:90%;
	}

	.optionalGrp {
		margin: 15px 0 !important;
	}

	.detailsDiv div {
		width:100%;
	}

	.contactContent {
		margin:15px 0 0 0;
		display:block;
	}

	.productItem {
		width: 99%;
	}

	.rowDetail {
		width:50%;
	}

	.rowImg {
		width:80px;
	}

	.rowQuantity input {
		height: 25px;
	}

	.basketTotal {
		margin:30px auto;
		padding:0;
		text-align:center;
	}

	.emptyBasket {
		float:left;
		margin: 0 0 0 15px;
	}

	.rowQuantity:before
	{
		content: "Quantity:";
		font-size:.8em;
		position:absolute;
		left:-60px;
		top:18px;
	}

	.priceHead {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	.rowQuantity {
		position:absolute;
		top:48px;
		left: calc(60% + 60px);
	}

	.quantityHead {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	.bottomBasketControls {
		margin: 10px auto;
		float:none !important;
		margin: 0 auto;
		width:90%;
		text-align:center;
	}

	.goShoppingBtn {
		margin:20px auto 10px auto !important;
	}

	#toPay {
		margin:30px auto;
	}
}

@media screen and (max-width:600px) {
	.productImages {
		display:block;
		width:auto;
		margin: 0 0 10px 10px;
	}

	.addImgContainer {
		display:inline-block;
		margin-right:4px;
		height:50px;
		vertical-align:top;
	}

	.addContainer {
		min-width:0;
		width:90%;
	}

	.prodDetailDiv {
		margin:5px auto;
	}

	.productData {
		text-align:center;
	}

	.trackBtn {
		display:block;
		width:90%;
		margin: 20px auto 10px auto;
		height:27px;
		font-size:1.2em;
		font-weight:bold;
	}
}

@media screen and (orientation:landscape) and (max-height:526px) {
	.productItem {
		float:none;
		display:block;
		width: 100%;
		height:180px;
		min-width: 600px;
	}

	.productImg {
		float:left;
		margin-left: 10px;
		max-height:150px;
		max-width:150px;
	}

	#products {
		width:99%;
	}

	.itemName {
		width:auto;
		position:absolute;
		top: 5px;
		left: 190px;
	}

	.itemCat {
		width:auto;
		margin:0;
		top:110px;
		left:190px;
		bottom:auto;
	}

	.itemPrice {
		margin:0;
		float:none;
		bottom:auto;
		top:140px;
		left:190px;
	}

	.itemQuantity {
		margin:0;
		float:none;
		bottom:auto;
		right:auto;
		top:140px;
		left:400px;
	}

	.viewItem {
		bottom:auto;
		left:auto;
		right:0;
	}

	.addToBasket {
		top:0;
		right:0;
	}

	.compareItem {
		top:0;
		right:45px;
	}

	.compareItem svg {
		pointer-events:none;
	}

	.viewItem {
		bottom:10px;
		width:110px;
	}

	.viewItem svg {
		pointer-events:none;
	}

	.productButtons {
		height:100%;
		position:absolute;
		left: auto;
		bottom: auto;
		top: 5px;
		right: 5px;
	}

	.basketConfirmation {
		text-align: center;
		border-radius:5px;
		padding: 7px;
		border:1px solid green;
		background-color: #C8E2C8;
		position:absolute;
		top:50px;
		left:auto;
		bottom:auto;
		height:auto;
	}

	.descText {
		display:block;
		position:absolute;
		top:30px;
		left:200px;
		color:gray;
		max-width:50%;
		max-height:50px;
		overflow: hidden;
	}	
}