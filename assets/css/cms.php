<?php 
	header("Content-type: text/css; charset: UTF-8");
	include ('sitePaths.php');
	$settings = parse_ini_file(INCL_ROOT . "config.ini");
?>

.parentCatField {
	cursor:pointer;
}

.delIcon {
	margin-right: 5px;
	vertical-align:top;
}

.deleteRow {
	cursor: pointer;
	min-width:100px !important;
}

.actionHead {
	min-width:100px !important;
}

.deleteRow:hover {
	color: red;
}

th {
	cursor:pointer;
}

th:hover .orderIconHidden {
	display:inline-block !important;
	float:right;
}

.orderIcon {
	float:right;
	pointer-events:none !important;
}

.orderIconHidden {
	display:none;
}

.tableField:hover {
	color: <?php echo $settings['nav-colour'] ?>;
	text-decoration:underline;
}

table {
	border-spacing: 0;
}

table svg {
	width:20px;
	height:20px;
}

th {
	text-align:left;
	color: <?php echo $settings['nav-colour'] ?>;
	padding: 10px;
	margin:0;
	border-bottom:2px solid <?php echo $settings['nav-colour'] ?>;
	min-width:200px;
}

.tableValid {
	margin:0 !important;
	width: 550px !important;
	max-width:95%;
}

tr {
	color:#333333;
}

tr:nth-child(even) {
	background-color: #ebebeb;
}

tr:first-child:hover {
	background:none;
}

tr:hover {
	background: <?php echo $settings['background-colour'] ?>;
}

tr:hover td {
	color:black;
}

td {
	padding: 10px 15px 10px 5px;
	border-bottom: 1px solid #cccccc;
	min-width:200px;
	max-width:300px;
	text-overflow:ellipsis;
}

.cms h1 {
	padding:7px 0 !important;
	margin-bottom:7px;
	border-bottom: 1px solid #cccccc;	
}

.cmsSearch {
	width: 250px;
	height: 40px;
	vertical-align:top;
	font-size:1em;
}

.searchContainer {
	min-width: 400px;
}

.validateMsg {
	width:98% !important;
	bottom:0;
	position:absolute;
}

#maxWarning {
	pointer-events:none;
}

svg {
	pointer-events:none;	
}

.navDiv {
	text-align: right;
	transition: background 2.2s ease;
	display:block;
	background: rgb(250,250,250);
	border-bottom: 1px solid <?php echo $settings['background-colour']?>;
	position: relative;
	padding-right:20px;
}

.navDiv:hover {
	transition: background 0.5s ease;
	background: <?php echo $settings['background-colour'] ?>;
}

.navButton {
	padding:10px 0;
	width: 100%;
	display:block;
	text-decoration:none;
	color:<?php echo $settings['nav-colour']?>;
}

.svgLoader {
	width:194px;
}

.progress-success::-webkit-progress-value {
	background-color:green !important;
}

.progress-fail::-webkit-progress-value {
	background-color:red !important;
}

form {
	padding:5px 10px 10px 10px;
}

ellipse.highlightChev {
 
	fill:none;
	stroke:<?php echo $settings['nav-colour'] ?>;
	stroke-width: 12;
}

.upImgDiv {
	display:inline-block;
	width:194px;
	padding:5px;
	border:1px solid black;
}

.upImg {
	width: 194px;
	display:block;
}

.uploading {
	margin: 0 0 20px 0;
}

.hideProgress {
	margin: 10px auto;
	opacity:0;
	width:210px;
	height:0;
	transition: all 1s;
}

.showProgress {
	margin: 10px auto;
	opacity:1;
	width:210px;
	height:25px;
	transition: all .3s;
}

progress[value] {
  -webkit-appearance: none;
   appearance: none;

  width: 206px;
  height: 20px;
}

progress[value]::-webkit-progress-bar {
  background-color: #eee;
  box-shadow: 0 2px 5px #aaaaaa inset;
}

progress[value]::-webkit-progress-value {
  	background:<?php echo $settings['nav-colour'] ?>;
}

input[type=text] {
	width:200px;
	border: 1px solid rgb(169, 169, 169);
	padding: 2px;
}

input[type=number] {
	border: 1px solid rgb(169, 169, 169);
	padding: 2px;
	margin: 2px 0;
	width:200px;
}

select {
	padding:2px;
	width:205px;
}

.imgContainer {
	margin: 0 auto;
	text-align:center;
}

#addItemPrice {
	width: 200px;
}

#addItemDesc {
	width:449px;
	max-width:98%;
}

.formGroup {
	margin-bottom: 10px;
}

.upFile {
	margin-top:0;
	padding:2px;
	margin-bottom:10px;
}

input:focus, select:focus, textarea:focus {
	box-shadow: 0 0 5px <?php echo $settings['nav-colour'] ?>;
	border: 1px solid <?php echo $settings['nav-colour'] ?>;
}

.upFile:focus {
	box-shadow: 0 0 5px <?php echo $settings['nav-colour'] ?>;
	padding:1px;
	border: 1px solid <?php echo $settings['nav-colour'] ?>;
}

.formSubmit {
	margin: 20px 0 0 0;
	display:block;
}

.cmsSearchBtn {
	display:inline-block;
}

.cmsSearchBtn:active {
	box-shadow: inset 0 1px 4px rgba(0, 0, 0, .8);
}

#attrSubmit {
	margin-left:300px;
}

.status {
	text-align:center;
	font-size:.8em;
	border-radius:5px;
	width:400px;
	padding: 10px;
	margin: 0 auto;
}

.error {
	border: 1px solid red;
	background-color: rgba(255,0,0,0.2);
}

.success {
	border: 1px solid green;
	background-color: rgba(0,128,0, 0.2);
}

.showStatus {
	opacity:1;
	height: 38px;
	position:relative;
	margin:10px 0;
	transition: all .5s;
}

.hidden {
	display:none;	
}

.hideStatus {
	position:relative;
	opacity:0;
	height:0;
	transition: all .5s;
	z-index:-999;
	pointer-events:none;
}

form label {
	display:inline;
	margin-top:3px;
	width:130px;
	font-weight:700;
}

.extraImages {
	max-width:625px;
}

#moreAttr {
	padding-top:10px;
}

.validation {
	border-top: 1px solid #cccccc;
	z-index:-1;
	position:relative;
}

.dropGroup {
	border-bottom:1px solid #cccccc;
	padding-bottom:10px;
}

.parentCat {
	display:block;
	border: 1px solid #cccccc;
	border-radius:5px;
}

.aboveLabel {
	float:none;
	display:block;
}

.catTree {
	list-style-type:none;
}

.catTree ul {
	list-style-type:none;
	padding-left:40px;
}

.catTree li {
	margin-top:10px;
}

.hideList {
	display:none;
}

.showList {
	display:block;
}

.icon {
	margin-right:10px;
	cursor:pointer;
	color: <?php echo $settings['nav-colour']?>;
}

.catTree label {
	float:none;
	margin:1px 0 0 5px;
	font-weight: 400;
	font-size:.9em;
	display:inline-block;
	vertical-align:top;
	cursor:pointer;
	width:auto;
	max-width:60%;
}

.formButton {
	cursor:pointer;
	border-radius:5px;
	padding: 5px 10px;
	font-size:.7em;
	background: #eeeeee;
	border:1px solid #cccccc;
}

.formButton:hover {
	border-color: #aaaaaa; 
	background: <?php echo $settings['nav-colour'] ?>; 
	color: white;
}

.formButton:active {
	box-shadow: inset 0 1px 4px rgba(0, 0, 0, .8);
}

.formButton:disabled {
	color:#cccccc;
}

.formButton:disabled:hover {
	background: #eeeeee;
	color:#cccccc;
	border-color:#cccccc;
}

.formButton svg {
	margin: 0 auto 3px auto;
	width:25px;
	height:25px;
	display:block;
}

.formButton svg g {
	fill:#cccccc;
}

.formContainer {
	max-width: 600px;
	opacity: 1;
	transition: all 2s .5s;
}

.submitProgress {
	height: calc(100% - 20px);
	background: <?php echo $settings['nav-colour'] ?>;
	width:0;
	padding:10px 0 ;
	display:block;
	color:white;
	text-align:center;
	transition: all 1.5s;
}

.completeMsg {
	opacity: 1;
	margin: 0;
	transition: all .5s;
}

.left {
	float:left;
}

.right {
	float:right;
}

.formControls {
	margin-top:20px;
}

.extraImages {
	border: 1px solid #cccccc;
	border-radius:5px;
	margin-bottom:20px;
}

@media screen and (max-width:1288px) {
	.cms {
		padding-top:80px !important;
	}

	.validateMsg {
		width:95% !important;
	}
}

@media screen and (max-width:700px) and (min-width:401px) {
	.extraImages {
		width:90%;
		min-width: 0;
	}

	#addItemDesc {
		width:98%;
	}

	.uploading {
		width:98%;
		margin-left:0;
	}

	.status {
		width:90%;
	}

	.showStatus {
		height:50px;
	}
}

@media screen and (max-width:700px) {
	table, thead, tbody, th, td, tr { 
		display: block; 
	}

	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		color:#555555;
		position: absolute;
		top: 9px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}

	tr:first-child:hover {
		background:<?php echo $settings['background-colour']?> !important;
	}

	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "Category:"; }
	td:nth-of-type(2):before { content: "Parent Category:"; }
	td:nth-of-type(3):before { content: "Action:"; }
	
}


@media screen and (max-width:400px) {
	
	#addItemPrice, input[type=text], input[type=number] {
		width:98%;
		height:30px;
	}

	#addItemDesc {
		width:98%;
		max-width:98%;
	}

	select {
		width:99%;
		height:35px;
	}

	.uploading {
		width:98%;
		margin-left:0;
	}

	.status {
		width:96%;
	}

	.extraImages {
		width:90%;
		min-width:246px;
	}

	.addExImages {
		margin:0;
	}

	.hideStatus {
		margin-right:10px;
	}

	.showStatus {
		height: 50px;
		margin-right:10px;
	}

	#attrSubmit {
		width: 98%;
		height:50px;
		margin: 20px auto;
	}
}