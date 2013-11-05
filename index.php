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
	</head>
	<body>
		<h1>
			Login
		</h1>
		<p>Username: <input name=username type="text"/></p>
		<p>Password: <input name="passw" type="password"/></p>
		<input type="button" value="Login" onclick="login()"/>
	</body>
</head>
