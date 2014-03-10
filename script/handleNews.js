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
		$scope.loading=false;
		$scope.success=false;
		$scope.error=false;
		modalWindowService.openModal();
	}
	
	//TODO gestire l'evento
	$scope.deleteNews = function(){
		//onclick sull'elliminazione della news
		$scope.loading= true;
		$http({
			url: pagePath+"PHP/deleteNews.php",
			method: "POST",
			data : $.param({
				id: $scope.notiziaSelezionata
			})
		}).success(function(data, status, headers, config){
			if (data != false) {
				//$("#myModal").modal('hide');
				$scope.loading=false;
				$scope.success=true;
				for (var n in $scope.notizie) {
					//TODO trovo la notizia selezionata attraverso l'id e la elimino dall'array
					if ($scope.notizie[n].id == $scope.notiziaSelezionata) {
						delete $scope.notizie[n];
					}
				}
			}else{
				//non è andata bene
				$scope.error=true;
			}
		}).error(function(data, status, headers, config){
			$scope.error = true;
		});
	}
});