mainModule.controller("editTagController", function editTagController($scope, classPage, $http,  modalWindowService, $location){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	
	var parametersArray = $location.search();
	
	if (parametersArray && parametersArray.id) {
		
		$http({
			url: pagePath+"PHP/newsHandler.php",
			method: "POST",
			data : $.param({
				action: "GetCategoryById",
				id: parametersArray.id
			})
		}).success(function(data, status, headers, config){
			$scope.catName = data.nome;
		});
		
	}
	
	$scope.Save=function(){
		if ($.trim($scope.catName)!="") {
			modalWindowService.openModal({
				message: "Sei sicuro di voler salvare le modifiche?",
				okButtonText: "Salva",
				redirect : "contents/Settings/Categorie/",
				okAction: function($modalScope){
					$modalScope.loading=true;
					
					$http({
						url: pagePath+"PHP/newsHandler.php",
						method: "POST",
						data : $.param({
							action: "SaveCategory",
							id: parametersArray.id,
							nome: $scope.catName
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
				},
				confirm : true,
				successMessage: "Operazione eseguita con successo"
			});
		} else {
			$scope.emptyField=true;
		}
	}
	
	$scope.backAction = function(){
		location.href = pagePath+"contents/Settings/Categorie";
	}
});
