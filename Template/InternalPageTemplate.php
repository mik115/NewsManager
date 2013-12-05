<?php
	$path = "";
	//user controll per l'header...
	function head($path){ ?>
		<title>[PAGE TITLE]</title>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
	[CONTENT PAGE]
	<?php }


	require($path."master.php");
?>