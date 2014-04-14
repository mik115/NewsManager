<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Categorie</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/categorie.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/catogorie.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="categoryController">
			<h1>Gestisci le Categorie</h1>
			<p>Crea nuove categorie, modifica quelle esistenti o eliminale</p>
		</div>
	<?php }


	require($path."master.php");
?>