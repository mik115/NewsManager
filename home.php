<?php
	$path = "";
	//user controll per l'header...
	function head(){ ?>
		<title>Home Page</title>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
		<div>General content</div>
	<?php }

	require($path."master.php");
?>