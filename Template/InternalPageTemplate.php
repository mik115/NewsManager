<?php
	$path = "";
	//user controll per l'header...
	function head(){ ?>
		<title>[PAGE TITLE]</title>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
	[CONTENT PAGE]
	<?php }


	require("master.php");
?>