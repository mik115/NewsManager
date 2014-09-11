
mainModule.controller('userController', function impUserCtrl($scope, classPage, $http,  modalWindowService){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	
	$scope.orderable="username";
	$scope.reverse= false;
	
	$http({
		url: pagePath+"PHP/userHandler.php",
		method: "POST",
		data : $.param({
			action: "GetAllUser"
		})
	}).success(function(data, status, headers, config){
		if (data != false) {
				$scope.users = data;
		}else{
			//non è andata bene
			//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
		}
	}).error(function(data, status, headers, config){
		
	});
	
	$scope.searchFunction =  function (obj){
		if (!$scope.search ||$scope.search =="") {
			return true;
		}
		return obj.nome.indexOf($scope.search) >-1 || obj.ricorrenze.toString().indexOf($scope.search)>-1 ;
	}
	
	$scope.backAction= function(){
		location.href = pagePath+"contents/Settings";
	}
	
	$scope.edit = function(id){
		location.href = pagePath + "contents/Settings/Tags/edit.php?id="+id;
	}
	
	$scope.add = function(){
		location.href = pagePath + "contents/Settings/User/create.php";
	}
	
	$scope.del = function(id, position){
		modalWindowService.openModal({
			message: "Sei sicuro di voler eliminare il tag?",
			okButtonText: "Elimina",
			okAction: function($modalScope){
				$modalScope.loading=true;
				
				$http({
					url: pagePath+"PHP/newsHandler.php",
					method: "POST",
					data : $.param({
						action: "DeleteTag",
						id: id
					})
				}).success(function(data, status, headers, config){
					if (data != false) {
						$modalScope.loading=false;
						$modalScope.success=true;
						$scope.tags.splice(position, 1);
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
	}
	
});
