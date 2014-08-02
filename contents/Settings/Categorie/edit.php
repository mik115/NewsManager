<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Edit Categorie</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/categorie.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/editCategories.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="editTagController">
			<input id="backButton" type="button" value="Annulla" class="btn btn-default" ng-click="backAction();" />
			<h1>Edit Categoria</h1>
			<p>Modifica il nome della categoria e  salva per confermare le modifiche.</p>
			<p class="errorMessage" ng-show="emptyField"> Devi indicare un nome per poter salvare.</p>
			<p>Nome della categoria: <input type="text" ng-model="catName" class='form-control' required /></p>
			<input type="button" ng-click="Save()" class="btn btn-primary" value="Salva"/>
		</div>
	<?php }


	require($path."master.php");
?>