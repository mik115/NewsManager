<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Users</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/user.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/user.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="userController">
			<input id="backButton" type="button" value="Indietro" class="btn btn-default" ng-click="backAction();" />
			<h1>Gestione Utenti</h1>
			<p>Crea nuovi utenti, modifica i dati e i ruoli di utenti esistenti o eliminali</p>
			<p class="filterRow">Filtra: <input type="text" id="searchField" ng-model="search" class="form-control" /></p>
			<input type="button" class="btn btn-primary addTagButton" value="Aggiungi" ng-click="add();"/>
			<table class="table table-striped table-responsive">
				<tr>
					<th ng-click="orderable='username'; reverse=!reverse" class="orderable">Username
						<span ng-show="orderable=='username' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='username' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th ng-click="orderable='name'; reverse=!reverse" class="orderable">Nome
						<span ng-show="orderable=='name' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='name' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th ng-click="orderable='surname'; reverse=!reverse" class="orderable">Cognome
						<span ng-show="orderable=='surname' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='surname' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th ng-click="orderable='mail'; reverse=!reverse" class="orderable">mail
						<span ng-show="orderable=='mail' && !reverse" class="glyphicon glyphicon-chevron-up orderVersus"></span>
						<span ng-show="orderable=='mail' && reverse" class="glyphicon glyphicon-chevron-down orderVersus"></span>
					</th>
					<th></th>
				</tr>
				<tr ng-repeat="user in users | filter: searchFunction | orderBy: orderable: reverse">
					<td>{{user.username}}</td>
					<td>{{user.name}}</td>
					<td>{{user.surname}}</td>
					<td>{{user.mail}}</td>
					<td class='buttonCell'><input type= "button" value="Advanced"  class="btn btn-success" ng-click="edit(user.id);" /></td>
				</tr>
			</table>
		</div>
	<?php }


	require($path."master.php");
?>