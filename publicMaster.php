<html>
	<?php
	/*	decommentare per avere l'effetto di login automatico
	 	if(isset($_COOKIE["PHPSESSID"])){
			session_start();
			if($_SESSION["scope"]=="NewsManager"){
				header("Location: ".$path."home.php");
			}
		}
	*/
	?>
	<head>
		<link rel='stylesheet' type='text/css' src='style/general.css'/>
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