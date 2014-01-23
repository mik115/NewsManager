mainModule.controller("handleNewsController", function handleNewsController($scope, classPage){
	classPage.setClassPage("News");
	//TODO rendere dinamico il caricamento delle news con una chiamata verso il file XML
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