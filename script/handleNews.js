mainModule.controller("handleNewsController", function handleNewsController($scope, classPage, $http){
	classPage.setClassPage("News");
	//TODO rendere dinamico il caricamento delle news con una chiamata verso il file XML
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	$http({
		url: pagePath+"PHP/getNews.php",
		method: "POST"
	}).success(function(data, status, headers, config){
		if (data != false) {
			//$("#myModal").modal('hide');
			$scope.loading=false;
			$scope.success=true;
			//TODO gestire messaggio di conferma e di errore lato AngularJS su codice!!
		}else{
			//non è andata bene
			
		}
	}).error(function(data, status, headers, config){
		
	});
	
	
	$scope.notizie = [{
		Titolo : "una bella news di prova!",
		Sottotitolo: "ma va che bella news!!",
		Corpo: "Niente da dire...Lorem ipsum..."
	},
	{
		Titolo : "una bella news di prova!",
		Sottotitolo: "ma va che bella news!!",
		Corpo: "Niente da dire...Lorem ipsum..."
	},
	{
		Titolo : "una bella news di prova!",
		Sottotitolo: "ma va che bella news!!",
		Corpo: "Niente da dire...Lorem ipsum..."
	},
	{
		Titolo : "una bella news di prova!",
		Sottotitolo: "ma va che bella news!!",
		Corpo: "Niente da dire...Lorem ipsum..."
	},
	{
		Titolo : "una bella news di prova!",
		Sottotitolo: "ma va che bella news!!",
		Corpo: "Niente da dire...Lorem ipsum..."
	}];
	
	//TODO gestire l'evento
	$scope.modifyNews = function($event){
		//onclick su una riga della grid
		if ($event) {
			$event.stopImmediatePropagation();
		}
//		location.href='editNews.php?id = {{l'id della news da modificare}}';
	}
	
	$scope.addNewNews=function($event){
		//onclick sul bottona add new news
		if ($event) {
			$event.stopImmediatePropagation();
		}
		location.href='editNews.php';
	}
	
	//TODO gestire l'evento
	$scope.deleteNews = function($event){
		//onclick sull'elliminazione della news
		if ($event) {
			$event.stopImmediatePropagation();
		}
	}
});