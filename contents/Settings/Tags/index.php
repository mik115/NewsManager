<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Tags</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/tags.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/tags.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="tagController">
			<h1>Gestisci i Tags</h1>
			<p>Crea nuovi tag, modifica quelli esistenti o eliminali</p>
		</div>
	<?php }


	require($path."master.php");
?>