<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Impostazioni</title>
		<script type='text/javascript' src='<?php echo $path ?>script/impostazioni.js'></script>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
	<div> 
		<div ng-controller='impMainCtrl'>
			
		</div>
	</div>
	<?php }


	require($path."master.php");
?>