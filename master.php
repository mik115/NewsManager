<html>
	<?php
		if(!isset($_COOKIE["PHPSESSID"])){
			header("Location: ".$path."index.php");
		}else{
			session_start();
			if($_SESSION["scope"]!="NewsManager"){
				header("Location: ".$path."index.php");
			}
		}
	?>
	<head>
		<?php include("includes/generalHead.php")?>
		<!--Header della pagina specifica-->
		<?php echo head() ?>
	</head>
	<body>
		<nav class="navbar navbar-default generalHeader" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" >News Manager</a>
			</div>
			<div class="collapse navbar-collapse navbar-inner">
				<ul class="nav navbar-nav">
				  <li class="active"><a href="#">Home</a></li>
				  <li><a href="#">Impostazioni</a></li>
				</ul>
			</div>
		</nav>
		<!--Content della pagina specifica-->
		<?php echo content() ?>
	</body>
</head>