<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>lib/bootstrap-select/bootstrap-select.css'/>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>lib/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'/>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<script type="text/javascript" src='<?php echo $path?>lib/ckeditor/ckeditor.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/bootstrap-select/bootstrap-select.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/moment/moment.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.it.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'></script>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				CKEDITOR.replace( "textEditor",{
					uiColor: '#F4F4F4'
				});
				$('.selectpicker').selectpicker({
					width: "100%"
				});
				$('#datetimepicker1').datetimepicker({
					language: 'it'
				});
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Anunlla'/>
			<div id='metaContent'>
				<div class='leftDiv'>
					<div class='formRow'>Titolo: <input class='form-control' value='titolo'/></div>
					<div class='formRow'>
						Data Pubblicazione:
						<div class="form-group">
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' class="form-control" data-format="ddd DD-MM-YYYY HH:mm" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<select id='tagsSelection' class='selectpicker' multiple data-live-search="true"
    						  title='Scegli dei tag' data-selected-text-format="count>2" data-count-selected-text="{0} selected" data-size=10>
						<!--qui ci vanno i possibili tags-->
						<option ng-repeat='tag in tags' value='{{tag.id}}'>{{tag.nome}}</option>
					</select>
				</div>
				<div class='rightDiv'>
					<div class='formRow'>Sottotitolo: <input class='form-control' value='sottotitolo'/></div>
					<div class='formRow'>Importante: <input type='checkbox'/></div>
					<select id='categoryButton' class='selectpicker' data-live-search="true" title='Scegli una categoria' data-size=10>
    					<option ng-repeat='category in categories' value='{{category.id}}'>{{category.nome}}</option>
					</select>
				</div>
			</div>
			<textarea id='textEditor'>{{newsBody}}</textarea>
		</div>
	<?php }


	require($path."master.php");
?>