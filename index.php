
	<?php function head(){ ?>
		<!--librearia di ckeditor-->
		<script type="text/javascript" src='lib/ckeditor/ckeditor.js'></script>
		<script type="text/javascript" src="lib/ckeditor/adapters/jquery.js"></script>
		
		<script type="text/javascript" src='script/prova.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				angular.element("#editor").ckeditor();	
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
		<div ng-controller='auth'>
			<p>Username: <input ng-change='{$scope.emptyName=false}' ng-class='{redBorder:emptyName}' type='text' ng-model='username' /></p>
			<p>Password: <input ng-change='{$scope.emptyPassword=false}' ng-class='{redBorder:emptyPassword}' type='password' ng-model='password' /></p>
			<p><input type='button' value='login' ng-click='login()' /></p>
		</div>
	</div>
	<div>
		<textarea id='editor'></textarea>
	</div>
	
	<?php }

	//chiamata alla masterPage
	require("publicMaster.php");
?>
