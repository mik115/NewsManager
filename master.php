<html>
	<?php
		if(!isset($_COOKIE["PHPSESSID"])){
			header("Location: ".$path."index.php");
		}else{
			session_start();
			if(!$_SESSION["scope"]=="NewsManager"){
				header("Location: ".$path."index.php");
			}
		}
	?>
	<head>
		<script type="text/javascript" src='<?php echo $path ?>lib/jquery-1.10.2.min.js'></script>
		<script type="text/javascript" src='<?php echo $path ?>lib/angular.min.js'></script>
		<!--Header della pagina specifica-->
		<?php echo head() ?>
	</head>
	<body>
		<!--Content della pagina specifica-->
		<?php echo content() ?>
	</body>
</head>