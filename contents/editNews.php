<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title ng-controller='pageTitleSetter'>{{pageTitle}}</title>
		<link rel="stylesheet" type='text/css' href='<?php echo $path?>style/editNews.css'/>
		<script type='text/javascript' src='<?php echo $path?>script/editNews.js'></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='mainCtrl'>
			<input id='backButton' type='button' class='btn btn-info' value='<- Anunlla'/>
			<!--c'è bisogno di un bottone annulla per tornare alla pagina precedente...-->
		</div>
	<?php }


	require($path."master.php");
?>