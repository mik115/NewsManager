<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Edit Tags</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/tags.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/editTags.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="editTagController">
			<h1>Edit Tag</h1>
			<p>Modifica il nome del tag e  salva per confermare le modifiche.</p>
			<p class="errorMessage" ng-show="emptyField"> Devi indicare un nome per poter salvare.</p>
			<p>Nome del tag: <input type="text" ng-model="tagName" class='form-control' class='form-control' required /></p>
			<input type="button" ng-click="Save()" class="btn btn-primary" value="Salva"/>
		</div>
	<?php }


	require($path."master.php");
?>