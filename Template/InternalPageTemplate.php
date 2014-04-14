<?php
	$path = "";
	//user controll per l'header...
	function head($path){ ?>
		<title>[PAGE TITLE]</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/[CSS_PATH]" />
		<script type='text/javascript' src = "<?php echo $path?>script/[SCRIPT_PATH]"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="[CONTROLLER_NAME]">
			[CONTENT PAGE]
		</div>
	<?php }


	require($path."master.php");
?>