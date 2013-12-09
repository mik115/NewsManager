<html ng-app='MainModule'>
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
		<?php echo head($path); ?>
	</head>
	<body>
		<nav class="navbar navbar-default generalHeader" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" >News Manager</a>
			</div>
			<div class="collapse navbar-collapse" ng-controller="navagationBar">
				<ul class="nav navbar-nav">
					<li ng-class='{active:classPage=="Home"}'><a href="<?php echo $path?>contents/home.php">Home</a></li>
					<li ng-class='{active:classPage=="News"}'><a href="<?php echo $path?>contents/handleNews.php">News</a></li>
					<li ng-class='{active:classPage=="Impostazioni"}'><a href="<?php echo $path?>contents/impostazioni.php">Impostazioni</a></li>
				</ul>
			</div>
		</nav>
		<div id='mainContainer'>
		<!--Content della pagina specifica-->
		<?php echo content($path); ?>
		</div>
	</body>
</head>