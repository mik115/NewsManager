<?php
	$path = "../../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Edit User</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/user.css" />
		<script type='text/javascript' src = "<?php echo $path?>script/settings/createUser.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="createUserController">
			<input id="backButton" type="button" value="Annulla" class="btn btn-default" ng-click="backAction();" />
			<h1>Edit User</h1>
			<p>Modifica le proprietà dell'utente e  salva per confermare le modifiche.</p>
			<p class="errorMessage" ng-show="emptyField"> Devi indicare un nome per poter salvare.</p>
			<p class="formRow">Username: <input type="text" ng-model="username" class='form-control'  data-rule-minlength="5" required ng-keypress="onPress($event)"/></p>
			<p class="formRow">Password: <input type="text" ng-model="password" class='form-control' required /></p>
			<p class="formRow">Nome: <input type="text" ng-model="name" class='form-control' required /></p>
			<p class="formRow">Cognome: <input type="text" ng-model="surname" class='form-control' required /></p>
			<p class="formRow">Indirizzo mail: <input type="text" ng-model="mail" class='form-control' required /></p>
			<p class="formRow"><input type="button" ng-click="Save()" class="btn btn-primary saveButton" value="Salva"/></p>
		</div>
	<?php }


	require($path."master.php");
?>