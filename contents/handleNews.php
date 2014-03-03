<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Handle News</title>
		<link type = "text/css" rel='stylesheet' href='<?php echo $path?>style/handleNews.css'/>
		<script type="text/javascript" src="<?php echo $path?>script/handleNews.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='handleNewsController'>
			<h1>Gestione delle news</h1>
			<p> Qui di seguito potrai accedere alle news gia create per modificarle o crearne di nuove.</p>
			<input id='addNewsButton' type='button' class="btn btn-primary" value='+ Aggiungi' ng-click='addNewNews($event)'/>
			<div class='table-responsive'>
				<table id='newsList' class='table table-striped table-bordered table-hover'>
					<tr>
						<th>Titolo</th>
						<th>Creata</th>
						<th>Tags</th>
						<th>Categoria</th>
						<th></th>
					<tr newsId="{{notizia.id}}" ng-click='showDetails(notizia.id)' ng-repeat='notizia in notizie' ng-click='modifyNews()'>
						<td>{{notizia.titolo}}</td>
						<td>{{moment(notizia.dataCreazione, "X").format("DD/MM/YYYY : HH:mm")}}</td>
						<td>{{notizia.tags.length}}</td>
						<td>{{notizia.categoria.nome}}</td>
						<td class='btnCell'><input type='button' class='btn btn-danger btn-sm' value='Elimina' ng-click='onDelButtonEvent($event)'/></td>
					</tr>
				</table>
			</div>
			<!-- modal window-->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div ng-show='!errore && !success && !loading'> Sei sicuro di voler eliminare la news?</div>
							<div ng-show ='success'> La news è stata eliminata</div>
							<div ng-show='loading'><img src='<?php echo $path?>images/loading.gif'/></div>
							<div ng-show='errore'> Si è verificato un errore imprevisto. Riprovare.</div>
						</div>
						<div class="modal-footer">
							<button type="button" ng-show='!loading' class="btn btn-default" data-dismiss="modal" data-target="#myModal">{{!success && 'Annulla' || 'Chiudi'}}</button>
							<button ng-show='!errore && !loading && !success' type="button" class="btn btn-primary" ng-click='deleteNews()'>Elimina</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
	<?php }
	
	require($path."master.php");
?>