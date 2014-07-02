
mainModule.controller('categoryController', function impMainCtrl($scope, classPage, $http){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";

	$http({
		url: pagePath+"PHP/newsHandler.php",
		method: "POST",
		data : $.param({
			action: "GetAllCategories"
		})
	}).success(function(data, status, headers, config){
		if (data != false) {
			$http({
				url: pagePath+"PHP/newsHandler.php",
				method: "POST",
				data : $.param({
					action: "GetAllNews"
				})
			}).success(function(result){
				$scope.categories = data;
				
				for (var t in $scope.categories) {
					$scope.categories[t].ricorrenze = 0;
					for (var i in result){
						if (result[i].categoria == $scope.categories[t].id){
							$scope.categories[t].ricorrenze++;
						}
					}
				}
			});
		}else{
			//non � andata bene
			//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
		}
	}).error(function(data, status, headers, config){
		//non � andata bene
		//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
	});
	
	
	
});
