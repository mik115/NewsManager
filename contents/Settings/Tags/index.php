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
			<input id="backButton" type="button" value="Indietro" class="btn btn-default" ng-click="backAction();" />
			<h1>Gestisci i Tags</h1>
			<p>Crea nuovi tag, modifica quelli esistenti o eliminali</p>
			<p class="filterRow">Filtra: <input type="text" id="searchField" ng-model="search" class="form-control" /></p>
			<input type="button" class="btn btn-primary addTagButton" value="Aggiungi" ng-click="add();"/>
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
				<tr ng-repeat="tag in tags | filter: searchFunction | orderBy: orderable: reverse">
					<td>{{tag.nome}}</td>
					<td>{{tag.ricorrenze}}</td>
					<td class='buttonCell'><input type= "button" value="Edit"  class="btn btn-success" ng-click="edit(tag.id);" /></td>
					<td class='buttonCell'><input type= "button" value="Delete" class="btn btn-danger" ng-click="del(tag.id, tags.indexOf(tag));" /></td>
				</tr>
			</table>
		</div>
	<?php }


	require($path."master.php");
?>