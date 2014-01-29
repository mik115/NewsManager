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
						<th></th>
					<tr newsId = "{{notizia.id}}" ng-repeat='notizia in notizie' ng-click='modifyNews()'>
						<td>{{notizia.titolo}}</td>
						<td>{{moment(notizia.dataCreazione, "X").format("DD/MM/YYYY : HH:mm")}}</td>
						<td>{{notizia.tags.length}}</td>
						<td>{{notizia.categoria.nome}}</td>
						<td class='btnCell'><input type='button' class='btn btn-info btn-sm' value='Modifica' ng-click='modifyNews($event)'/>
						<td class='btnCell'><input type='button' class='btn btn-danger btn-sm' value='Elimina' ng-click='deleteNews($event)'/>
					</tr>
				</table>
			</div>
		</div>
	<?php }


	require($path."master.php");
?>