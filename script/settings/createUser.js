mainModule.controller("createUserController", function createUserController($scope, classPage, $http,  modalWindowService, $location){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	
	$scope.Save=function(){
		//TODO controllare i vari campi obbligatori che siano tutti corretti.
		if ($.trim($scope.tagName)!="") {
			modalWindowService.openModal({
				message: "Sei sicuro di voler salvare le modifiche?",
				okButtonText: "Salva",
				redirect : "contents/Settings/Tags/",
				okAction: function($modalScope){
					$modalScope.loading=true;
					
					$http({
						url: pagePath+"PHP/newsHandler.php",
						method: "POST",
						data : $.param({
							action: "SaveTag",
							id: parametersArray.id,
							nome: $scope.tagName
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
		location.href = pagePath+"contents/Settings/User";
	}
	
	$scope.onPress = 	function(event, element){
		if ($scope.username && $scope.username.length > 5) {
			$http({
				url: pagePath+"PHP/userHandler.php",
				method: "POST",
				data : $.param({
					action: "checkUsernameAvailability",
					name: $scope.userName
				})
			}).success(function(data, status, headers, config){ 
				if (data != false) {
					
				}else{
					
				}
			});
		}else{
			
		}
	}
});
