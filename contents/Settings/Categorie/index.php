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
			<input id="backButton" type="button" value="Indietro" class="btn btn-default" ng-click="backAction();" />
			<h1>Gestisci le Categorie</h1>
			<p>Crea nuove categorie, modifica quelle esistenti o eliminale</p>
			<p class="filterRow">Filtra: <input type="text" id="searchField" ng-model="search" class="form-control" /></p>
			<input type="button" class="btn btn-primary addCatButton" value="Aggiungi" ng-click="add();"/>
			<table class="table table-striped table-responsive">
				<tr>
					<th ng-click="orderable='nome'; reverse=!reverse" class="orderable">Tag Name
						<span ng-show="orderable=='nome' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='nome' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th ng-click="orderable='ricorrenze'; reverse=!reverse" class="orderable">Ricorrenze
						<span ng-show="orderable=='ricorrenze' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='ricorrenze' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th></th>
					<th></th>
				</tr>
				<tr ng-repeat="cat in categories | filter: searchFunction | orderBy: orderable: reverse">
					<td>{{cat.nome}}</td>
					<td>{{cat.ricorrenze}}</td>
					<td class='buttonCell'><input type= "button" value="Edit"  class="btn btn-success" ng-click="edit(cat.id);" /></td>
					<td class='buttonCell'><input type= "button" value="Delete" class="btn btn-danger" ng-click="del(cat.id, categories.indexOf(cat));" /></td>
				</tr>
			</table>
		
		</div>
		
		
		
	<?php }


	require($path."master.php");
?>