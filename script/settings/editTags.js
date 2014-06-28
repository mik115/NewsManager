mainModule.controller("editTagController", function editTagController($scope, classPage, $http,  modalWindowService, $location){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	
	var parametersArray = $location.search();
	
	if (parametersArray && parametersArray.id) {
		
		$http({
			url: pagePath+"PHP/newsHandler.php",
			method: "POST",
			data : $.param({
				action: "GetTagById",
				id: parametersArray.id
			})
		}).success(function(data, status, headers, config){
			$scope.tagName = data.nome;
		});
		
	}
	
	$scope.Save=function(){
		if ($.trim($scope.tagName)!="") {
			modalWindowService.openModal({
				message: "Sei sicuro di voler salvare le modifiche?",
				okButtonText: "Salva",
				redirect : "contents/contents/Settings/Tags/",
				okAction: function($modalScope){
					$modalScope.loading=true;
					
					$http({
						url: pagePath+"PHP/newsHandler.php",
						method: "POST",
						data : $.param({
							action: "SaveTag",
							id: parametersArray.id,
							name: $scope.tagName
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
});
