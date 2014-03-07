<html>
	<?php
	 	if(isset($_COOKIE["PHPSESSID"])){
			session_start();
			if($_SESSION["scope"]=="NewsManager"){
				header("Location: ".$path."home.php");
			}
		}
	?>
	<head>
		<?php include("includes/generalHead.php")?>
		<!--Header della pagina specifica-->
		<?php echo head($path); ?>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <a class="navbar-brand" >News Manager</a>
		</div>
	</nav>
		<!--Content della pagina specifica-->
		<?php echo content($path); ?>
	</body>
</head>