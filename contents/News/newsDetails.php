<?php
	$path = "../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Dettaglio della News</title>
		<script type='text/javascript' src="<?php echo $path?>script/news/newsDetails.js"></script>
		<link rel = "stylesheet" type='text/css' href='<?php echo $path?>style/news/newsDetails.css'></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Indietro' ng-click='back()'/>
			<input ng-click='editNews()' id='editButton' type ='button' class='btn btn-success' value='Edit'/>
			<input ng-click='deleteNews()' id='deleteButton' type ='button' class='btn btn-danger' value='Elimina'/>
			<div id='metaContent'>
				<div class='leftDiv'>
					<div class='formRow'>Titolo: {{notizia.titolo}}</div>
					<div class='formRow'>
						Data Creazione: {{moment(notizia.dataCreazione, "X").format("DD/MM/YYYY HH:mm")}}
					</div>
					<div class='formRow'>
						Data Pubblicazione: {{notizia.dataPubblicazione &&
						moment(notizia.dataPubblicazione, "X").format("DD/MM/YYYY HH:mm") ||
						moment(notizia.dataCreazione, "X").format("DD/MM/YYYY HH:mm")}}
					</div>
				</div>
				<div class='rightDiv'>
					<div class='formRow'>Sottotitolo: {{notizia.sottotitolo}}</div>
					<div class='formRow'>Importante: {{notizia.importante && "Si" || "No"}}</div>
					<div class = 'formRow'>Categoria: {{notizia.categoria.nome}}</div>
				</div>
				<div class ='formRow'>
						Tags <span>({{notizia.tags.length}}):
						<div class='tagList' >
							<ul class="list-group" ng-show='notizia.tags.length > 0'>
								<li class='list-group-item' ng-repeat='tag in notizia.tags'>{{tag.nome}}</li>
							</ul>
							<p ng-show='notizia.tags.length == 0'>Nessun Tag</p>
						</div>
					</div>
			</div>
			<div class='bodyContainer'>
				<p>Contenuto:</p>
				<div class='newsBody' ng-bind-html-unsafe="notizia.corpo"></div>
			</div>
		</div>
	<?php }


	require($path."master.php");
?>