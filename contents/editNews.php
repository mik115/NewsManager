<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>lib/bootstrap-select/bootstrap-select.css'/>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<script type="text/javascript" src='<?php echo $path?>lib/ckeditor/ckeditor.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/bootstrap-select/bootstrap-select.js'></script>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				CKEDITOR.replace( "textEditor",{
					uiColor: '#F4F4F4'
				});
				$('.selectpicker').selectpicker();
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Anunlla'/>
			<div id='metaContent'>
				<div class='leftDiv'>
					<p>Titolo: <input class='form-control' value='titolo'/></p>
					<p>Data Pubblicazione: <input class='form-control' value='DataPubblicazione {timePicker}'/></p>
					<select id='tagsSelection' class='selectpicker' multiple data-live-search="true"
    						  title='Scegli dei tag' data-selected-text-format="count>2" data-count-selected-text="{0} selected" data-size=10>
						<!--qui ci vanno i possibili tags-->
						<option>i possibili tag</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
						<option>altre opzioni</option>
					</select>
				</select>
				</div>
				<div class='rightDiv'>
					<p>Sottotitolo: <input class='form-control' value='sottotitolo'/></p>
					<p>Importante: <input class='form-control' value='importante {checkbox}'/></p>
					<select id='categoryButton' class='selectpicker show-tick' data-live-search="true" title='Scegli una categoria' data-size=10>
    					<option>Una categoria</option>
						<option>un'altra categoria</option>
						<option>un'altra categoria</option>
						<option>un'altra categoria</option>
						<option>un'altra categoria</option>
						<option>un'altra categoria</option>
					</select>
				</div>
			</div>
			<textarea id='textEditor'>{{newsBody}}</textarea>
		</div>
	<?php }


	require($path."master.php");
?>