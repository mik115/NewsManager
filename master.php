<html ng-app='MainModule'>
	<?php
		if(!isset($_COOKIE["PHPSESSID"])){
			header("Location: ".$path."index.php");
		}else{
			session_start();
			if($_SESSION["scope"]!="NewsManager"){
				header("Location: ".$path."index.php");
			}
		}
	?>
	<head>
		
		<script type='text/javascript'>
			var pagePath = "<?php echo $path ?>";
		</script>
		
		<?php include("includes/generalHead.php")?>
		<!--Header della pagina specifica-->
		<?php echo head($path); ?>
		
	</head>
	<body>
		<nav class="navbar navbar-default generalHeader" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" >News Manager</a>
			</div>
			<div class="collapse navbar-collapse" ng-controller="navagationBar">
				<ul class="nav navbar-nav">
					<li ng-class='{active:classPage=="Home"}'><a ng-href="<?php echo $path?>contents/home.php">Home</a></li>
					<li ng-class='{active:classPage=="News"}'><a ng-href="<?php echo $path?>contents/handleNews.php">News</a></li>
					<li ng-class='{active:classPage=="Impostazioni"}'><a ng-href="<?php echo $path?>contents/impostazioni.php">Impostazioni</a></li>
				</ul>
			</div>
		</nav>
		<div id='mainContainer'>
		<!--Content della pagina specifica-->
		<?php echo content($path); ?>
		
		<!-- modal window-->
			<div class="modal fade" data-keyboard="false" data-backdrop="static" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller='modalWindow'>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div ng-show='!errore && !success && !loading && !errorLogic' ng-bind-html-unsafe="queryMessage"></div>
							<div ng-show ='success' ng-bind-html-unsafe="OnSuccessMessage"></div>
							<div ng-show='loading'><img src='<?php echo $path?>images/loading.gif'/></div>
							<div ng-show='errore' ng-bind-html-unsafe="errorMessage"></div>
						</div>
						<div class="modal-footer">
							<button type="button" ng-show='!loading' class="btn btn-default" data-dismiss="modal" data-target="#myModal">{{!success && cancelButtonText || cancelButtonTextOnSuccess}}</button>
							<button ng-show='!errore && !loading && !success && needConfirm' type="button" class="btn btn-primary" ng-click='okButtonAction()'>{{okButtonText}}</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
	</body>
</head>