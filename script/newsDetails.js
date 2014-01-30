mainModule.controller('pageTitleSetter', function pageTitleSetter($scope, $location){
	var parametersArray = $location.search();
	if (parametersArray.length !=0 && parametersArray.Id) {
		$scope.pageTitle="Edit News";
	}else{
		$scope.pageTitle="Add News";
	}
});

mainModule.controller('mainCtrl', function mainCtrl($scope, classPage, $location, $http){
	classPage.setClassPage("News"); //per evidenziare il link corrente
	//TODO capire bene come funziona il $location in questione! modificare anche in addNews.php
	var parametersArray = $location.search();
	if (parametersArray.length !=0 && parametersArray.id) {
		$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
		$http({
			url: pagePath+"PHP/getNews.php",
			method: "POST",
			data : $.param({
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
	$scope.getData= function(data, format){
		if (!data) {
			return "";
		}else{
			return moment(notizia.dataPubblicazione, "X").format("DD/MM/YYYY : HH:mm")
		}
	}
	
	$scope.back = function(){
		if ($scope.success) {
			location.href=pagePath+'contents/handleNews.php';
		}
	}
});
