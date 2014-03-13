mainModule.controller("handleNewsController", function handleNewsController($scope, classPage, $http, modalWindowService){
	classPage.setClassPage("News");
	//TODO rendere dinamico il caricamento delle news con una chiamata verso il file XML
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	$http({
		url: pagePath+"PHP/newsHandler.php",
		data : $.param({
				action: "GetAllNews"
			}),
		method: "POST"
	}).success(function(data, status, headers, config){
		$scope.notizie = data;
	}).error(function(data, status, headers, config){
		
	});
	
	$scope.unescape=unescape;
	$scope.moment = moment;
	
	$scope.showDetails= function(id){
		location.href = pagePath+ "contents/newsDetails.php?id="+id;
	}
	
	$scope.addNewNews=function($event){
		//onclick sul bottona add new news
		if ($event) {
			$event.stopImmediatePropagation();
		}
		location.href=pagePath + 'contents/editNews.php';
	}
	
	$scope.onDelButtonEvent = function($event){
		if ($event) {
			$event.stopImmediatePropagation();
		}
		$scope.notiziaSelezionata = event.currentTarget.parentNode.parentNode.attributes["newsid"].textContent;
		modalWindowService.openModal({
			message: "Sei sicuro di voler eliminare la news <b>"+$scope.notizie[$scope.notiziaSelezionata].titolo+"</b>?",
			okButtonText: "Elimina",
			okAction: function($modalScope){
				$http({
					url: pagePath+"PHP/newsHandler.php",
					method: "POST",
					data : $.param({
						action: "DeleteNews",
						id: $scope.notizie[$scope.notiziaSelezionata].id
					})
				}).success(function(data, status, headers, config){
					if (data != false) {
						$modalScope.loading=false;
						$modalScope.success=true;
						$scope.notizie.splice($scope.notiziaSelezionata, 1);
					}else{
						//non è andata bene
						$modalScope.error=true;
					}
				}).error(function(data, status, headers, config){
					$modalScope.error = true;
				});,
			confirm : true,
			successMessage: "Operazione eseguita con successo"
		});
	}
});