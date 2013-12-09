mainModule.controller('pageTitleSetter', function pageTitleSetter($scope, $location){
	var parametersArray = $location.search();
	if (parametersArray.length !=0 && parametersArray.Id) {
		$scope.pageTitle="Edit News";
	}else{
		$scope.pageTitle="Add News";
	}
});

mainModule.controller('mainCtrl', function mainCtrl($scope, classPage, $location){
	classPage.setClassPage("News"); //per evidenziare il link corrente
	var parametersArray = $location.search();
	if (parametersArray.length !=0 && parametersArray.Id) {
		$scope.newsBody="<h1>ma che bella news</h1>";
		//TODO qui instanzio le azioni per la modifica della news indicata dall'id...quindi anche il caricamento del corpo e metadati della news
	}else{
		//TODO qui instanzio le azioni specifiche per la creazione di una nuova news
	}
	
});
