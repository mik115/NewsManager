<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Handle News</title>
		<script type="text/javascript" src="<?php echo $path?>script/handleNews.js"></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller='handleNewsController'></div>
	<?php }


	require($path."master.php");
?>