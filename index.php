<html>
	<?php
		if(isset($_COOKIE["PHPSESSID"])){
			session_start();
			if($_SESSION["scope"]=="NewsManager"){
				header("Location: home.php");
			}
		}
	?>
	<head>
		<script type="text/javascript" src='lib/jquery-1.10.2.min.js'></script>
		<script type="text/javascript">
			function login() {
				if ($.trim($("input[name='username']").val())=="") {
					alert("non hai inserito uno username");
				}else if ($.trim($("input[name='passw']").val())=="") {
					alert("non hai inserito una password");
				}else{
					$.ajax({
						url: "PHP/login.php",
						type: "post",
						data: {uName: $("input[name='username']").val(), passw: $("input[name='passw']").val()}
					}).done(function(result){
						if (result) {
							location.reload(true);
						}else{
							alert("username o password errata!");
							$("input[name='passw']").val("");		
						}
					});
				}
			}
		</script>
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
			<p>Username: <input type='text' ng-model='username' /></p>
			<p>Password: <input type='password' ng-model='password' /></p>
			<p><input type='button' value='login' ng-click='login()' /></p>
		</div>
	</div>
	<div>
		<textarea id='editor'></textarea>
	</div>
	
	<?php }

	//chiamata alla masterPage
	require("master.php");
?>
