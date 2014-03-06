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
						Tags:
						<div class='tagList' >
							<ul class="list-group">
								<li class='list-group-item' ng-repeat='tag in notizia.tags'>{{tag.nome}}</li>
							</ul>
						</div>
					</div>
			</div>
			<input ng-click='editNews()' id='editButton' type ='button' class='btn btn-success' value='Edit'/>
			<div>
				Contenuto:
				<div class='newsBody' ng-bind-html-unsafe="unescape(notizia.corpo)"></div>
			</div>
		</div>
	<?php }


	require($path."master.php");
?>