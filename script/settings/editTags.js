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
			//TODO richiesta di salvataggio.
			/*salvare il tag con la funzione save tag passando un tag completo e aggionato...
			 *vedi come edit news
			 */
		} else {
			$scope.emptyField=true;
		}
	}
});
