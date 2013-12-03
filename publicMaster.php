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
		<?php include("includes/generalHead.php")?>
		<!--Header della pagina specifica-->
		<?php echo head() ?>
	</head>
	<body>
		<!--Content della pagina specifica-->
		<?php echo content() ?>
	</body>
</head>