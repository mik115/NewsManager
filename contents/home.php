<?php
	$path = "../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Home Page</title>
		<script type="text/javascript" src="<?php echo $path?>script/home.js"></script>
	<?php }
	
	//user controll per il content..
	function content(){ ?>
		<div ng-app=homeApp>
			<div ng-controller='mainCtrl'>
				<p>ciao</p>
			</div>
		</div>
	<?php }

	require($path."master.php");
?>