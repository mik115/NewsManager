<?php
	$path = "../../";
	//user controll per l'header...
	function head($path){ ?>
		<title>Settings</title>
		<link type='text/css' rel="stylesheet" href = "<?php echo $path?>style/settings/impostazioni.css" />
		<script type="text/javascript" src='<?php echo $path?>script/settings/impostazioni.js'></script>
	<?php }
	
	//user controll per il content..
	function content($path){ ?>
		<div ng-controller="impMainCtrl">
			<h1>Impostazioni</h1>
			<div id="settingContainer">
				<ul>
					<li><a href="<?php echo $path?>contents/Settings/Categorie">Gestisci Categorie</a></li>
					<li><a href="<?php echo $path?>contents/Settings/Tags">Gestisci Tag</a></li>
				</ul>
			</div>
		</div>
	<?php }


	require($path."master.php");
?>