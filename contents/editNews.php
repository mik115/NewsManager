<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<script type="text/javascript" src='<?php echo $path?>lib/ckeditor/ckeditor.js'></script>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				CKEDITOR.replace( "textEditor",{
					uiColor: '#F4F4F4'
				});
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Anunlla'/>
			<select id='tagsSelection'>
				<!--qui ci vanno i possibili tags-->
				<option>i possibili tag</option>
			</select>
			<select>
				<option>Una categoria</option>
			</select>
			<input class='form-control' value='titolo'/>
			<input class='form-control' value='sottotitolo'/>
			<input class='form-control' value='DataCreazione {timePicker}'/>
			<input class='form-control' value='DataPubblicazione {timePicker}'/>
			<input class='form-control' value='importante {checkbox}'/>
			<textarea id='textEditor'>{{newsBody}}</textarea>
		</div>
	<?php }


	require($path."master.php");
?>