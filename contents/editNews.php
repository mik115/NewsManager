<?php
	$path = "../";
	//user controll per l'header...
	
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<title> Title</title>
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
				$('#datetimepicker').datetimepicker({
					language: 'it'
				});
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' ng-click='backAction()' type='button' class='btn btn-default' value='Anunlla'/>
			<div id='metaContent'>
				<div class='leftDiv'>
					<div class='formRow'>Titolo: <input ng-model='title' class='form-control' value='titolo'/></div>
					<div class='formRow'>
						Data Pubblicazione:
						<div class="form-group">
							<div class='input-group date' id='datetimepicker'>
								<input ng-model='publishDate' type='text' class="form-control" data-format="ddd DD/MM/YYYY HH:mm" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<select ng-model='tagSelect' id='tagsSelection' class='selectpicker' multiple data-live-search="true"
    						  title='Scegli dei tag' data-selected-text-format="count>2" data-count-selected-text="{0} selected" data-size=10>
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
			<input ng-click='saveNews()' id='saveButton' type ='button' class='btn btn-primary' value='Salva'/>
			<textarea id='textEditor' ng-model='newNewsBody'>{{newsBody}}</textarea>
		</div>
	<?php } 

	require($path."master.php");
?>