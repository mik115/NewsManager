<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<script type="text/javascript" src='<?php echo $path?>lib/ckeditor/ckeditor.js'></script>
		<script type="text/javascript" src="<?php echo $path?>	lib/ckeditor/adapters/jquery.js"></script>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
		<script type='text/javascript'>
			angular.element(document).ready(function(){
				angular.element("#textEditor").ckeditor();
			});
		</script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-default' value='Anunlla'/>
			<textarea id='textEditor'>{{newsBody}}</textarea>
		</div>
	<?php }


	require($path."master.php");
?>