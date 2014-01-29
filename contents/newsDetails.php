<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Dettaglio della News</title>
		<script type='text/javascript' src="<?php echo $path?>script/newsDetails.js"></script>
		<link rel = "stylesheet" type='text/css' href='<?php echo $path?>style/newsDetails.css'></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Indietro'/>
			<div id='metaContent'>
				<div class='leftDiv'>
					<div class='formRow'>Titolo: {{notizia.titolo}}</div>
					<div class='formRow'>
						Data Pubblicazione: {{notizia.dataPubblicazione}}
					</div>
					<div class='formRow'>
						Data Creazione: {{notizia.dataCreazione}}
					</div>
					<select ng-model='tagSelect' id='tagsSelection' class='selectpicker' multiple data-live-search="true"
    						  title='Scegli dei tag' data-selected-text-format="count>2" data-count-selected-text="{0} selected" data-size=10>
						<!--qui ci vanno i possibili tags-->
						<option ng-repeat='tag in tags' value='{{tag.id}}'>{{tag.nome}}</option>
					</select>
				</div>
				<div class='rightDiv'>
					<div class='formRow'>Sottotitolo: <input ng-model='subtitle' class='form-control' value='sottotitolo'/></div>
					<div class='formRow'>Importante: <input ng-model='important' type='checkbox'/></div>
					<select ng-model='catSelect' id='categoryButton' class='selectpicker' data-live-search="true" title='Scegli una categoria' data-size=10>
    					<option ng-repeat='category in categories' value='{{category.id}}'>{{category.nome}}</option>
					</select>
				</div>
			</div>
			<input ng-click='checkCompleteness()' id='saveButton' type ='button' class='btn btn-primary' value='Salva' data-toggle="modal" data-target="#myModal"/>
		</div>
	<?php }


	require($path."master.php");
?>