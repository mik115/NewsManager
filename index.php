<?php
	//path che lo distanzia dalla master page
	$path = "";
	//user controll per l'header...
	function head(){ ?>
		
		<title>Home Page</title>
		<script type='text/javascript' src='script/prova.js'></script>
		<script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="lib/ckeditor/adapters/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#editor').ckeditor();
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
	<div ng-app="phonecatApp">
		<div ng-controller="PhoneListCtrl">
			<label>Name:</label>
			<input type="text" ng-model="yourName" placeholder="Enter a name here">
			<hr>
			<h1>Hello {{yourName}}!</h1>
			
			<ul>
				<li class='phone' ng-repeat="phone in phones">
				  <p class='phoneName'>{{phone.name}}</p>
				  <p class='phoneCat'>{{phone.snippet}}</p>
				</li>
			</ul>
		 </div>
	</div>
	<div>
		<textarea id='editor'></textarea>
	</div>
	
	<?php }

	//chiamata alla masterPage
	require("master.php");
?>
