
	<?php
	$path = "";
	
	//user control per l'head
	function head(){ ?>
		<!--librearia di ckeditor
		<script type="text/javascript" src='lib/ckeditor/ckeditor.js'></script>
		<script type="text/javascript" src="lib/ckeditor/adapters/jquery.js"></script>-->
		<link rel='stylesheet' type='text/css' src='style/index.css'/>
		<script type="text/javascript" src='script/index.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
		//		angular.element("#editor").ckeditor();
		//document.ready event
			});
		</script>
		<style>
			.redBorder{
				border: 2px solid red;
			}
		</style>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
	<div ng-app="mainApp">
		<div ng-controller='auth'>
			<p class='errorMessage' ng-show='loginError'>Username o Password Errati</p>
			<p>Username: <input ng-change='emptyName = false' ng-class='{redBorder:emptyName}' type='text' ng-model='username' /></p>
			<p>Password: <input ng-change='emptyPassword = false' ng-class='{redBorder:emptyPassword}' type='password' ng-model='password' /></p>
			<p><input type='button' value='login' ng-click='login()' /></p>
		</div>
	</div>
	
	<?php }

	//chiamata alla masterPage
	require("publicMaster.php");
?>
