mainModule.controller('pageTitleSetter', function pageTitleSetter($scope, $location){
	$scope.pageTitle="Dettaglio della news.";
});

mainModule.controller('mainCtrl', function mainCtrl($scope, classPage, $location, $http, modalWindowService){
	classPage.setClassPage("News"); //per evidenziare il link corrente

	var parametersArray = $location.search();
	if (parametersArray && parametersArray.id) {
		$scope.newsId = parametersArray.id;
		$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
		$http({
			url: pagePath+"PHP/newsHandler.php",
			method: "POST",
			data : $.param({
				action: "GetNewsWithElements",
				id : parametersArray.id
			})
		}).success(function(data, status, headers, config){
			if (data != false) {
				$scope.notizia=data;
			}else{
				//non è andata bene
			}
		}).error(function(data, status, headers, config){
			
		});
	}else{
		//TODO qui inserisco il messaggio di errore...o addirittura potrei fare un bel redirect verso handleNews
	}
	
	$scope.moment = moment;
	$scope.unescape=unescape;
	$scope.getData= function(data, format){
		if (!data) {
			return "";
		}else{
			return moment(notizia.dataPubblicazione, "X").format("DD/MM/YYYY : HH:mm")
		}
	}
	
	$scope.editNews=function(){
		location.href=pagePath+'contents/editNews.php?id='+parametersArray.id;
	}
	
	$scope.back = function(){
		location.href=pagePath+'contents/handleNews.php';
	}
	
	$scope.deleteNews = function(){
		modalWindowService.openModal({
			message: "Sei sicuro di voler eliminare la news?",
			okButtonText: "Elimina",
			successMessage: "Operazione eseguita con successo",
			confirm : true,
			redirect: "contents/handleNews.php",
			okAction: function($modalScope){
				$http({
					url: pagePath+"PHP/newsHandler.php",
					method: "POST",
					data : $.param({
						action: "DeleteNews",
						id: $scope.newsId
					})
				}).success(function(data, status, headers, config){
					if (data != false) {
						$modalScope.loading=false;
						$modalScope.success=true;
					}else{
						//non è andata bene
						$modalScope.error=true;
					}
				}).error(function(data, status, headers, config){
					$modalScope.error = true;
				})
			}
		});
	}
});
