<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>lib/bootstrap-multiselect/css/bootstrap-multiselect.css'/>
		<script type="text/javascript" src='<?php echo $path?>lib/ckeditor/ckeditor.js'></script>
		<script type= "text/javascript" src = '<?php echo $path?>lib/bootstrap-multiselect/js/bootstrap-multiselect.js'></script>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				CKEDITOR.replace( "textEditor",{
					uiColor: '#F4F4F4'
				});
				$("#tagsSelection").multiselect({
					enableCaseInsensitiveFiltering: true,
					maxHeight: "50px",
					buttonWidth: "200px"
				});
				
				$("#categoryButton").multiselect({
					enableCaseInsensitiveFiltering: true,
					buttonWidth: "200px"
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
					<p>Titolo: <input class='form-control' value='titolo'/></p>
					<p>Data Pubblicazione: <input class='form-control' value='DataPubblicazione {timePicker}'/></p>
					<select id='tagsSelection' multiple="multiple">
					<!--qui ci vanno i possibili tags-->
					<option>i possibili tag</option>
				</select>
				</div>
				<div class='rightDiv'>
					<p>Sottotitolo: <input class='form-control' value='sottotitolo'/></p>
					<p>Importante: <input class='form-control' value='importante {checkbox}'/></p>
					<select id='categoryButton'>
					<option>Una categoria</option>
				</select>
				</div>
			</div>
			<textarea id='textEditor'>{{newsBody}}</textarea>
		</div>
	<?php }


	require($path."master.php");
?>