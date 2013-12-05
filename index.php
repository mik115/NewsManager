
	<?php
	$path = "";
	
	//user control per l'head
	function head($path){ ?>
		<!--librearia di ckeditor
		<script type="text/javascript" src='lib/ckeditor/ckeditor.js'></script>
		<script type="text/javascript" src="lib/ckeditor/adapters/jquery.js"></script>-->
		<link rel='stylesheet' type='text/css' href='style/index.css'/>
		<script type="text/javascript" src='script/index.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
		//		angular.element("#editor").ckeditor();
		//document.ready event
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
	<div ng-app="mainApp">
		<div ng-controller='auth'>
			<div id='welcomeDiv'>
				<h1>Benvenuto</h1>
				<p>Per poter accedere alle funzionalità del News Manager devi prima effettuare il login.</p>
			</div>
			<p class='errorMessage' ng-show='loginError'>Username o Password Errati</p>
			<p class='errorMessage' ng-show='emptyField'>Entrambi i campi sono required</p>
			<p>Username: <input returnpress="login" class='form-control' type='text' ng-model='username' required /></p>
			<p>Password: <input returnpress="login" class='form-control' type='password' ng-model='password' required /></p>
			<p><input class="btn btn-default" type='button' value='login' ng-click='login()' /></p>
		</div>
	</div>        
	
	<?php }

	//chiamata alla masterPage
	require("publicMaster.php");
?>
