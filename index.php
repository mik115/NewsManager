
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
			<p class='errorMessage' ng-show='emptyField'>Entrambi i campi sono required</p>
			<p>Username: <input class='form-control' type='text' ng-model='username' required/></p>
			<p>Password: <input class='form-control' type='password' ng-model='password' required /></p>
			<p><input class="btn btn-default" type='button' value='login' ng-click='login()' /></p>
		</div>
	</div>        
	
	<?php }

	//chiamata alla masterPage
	require("publicMaster.php");
?>
