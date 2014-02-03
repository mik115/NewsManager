mainModule.controller("handleNewsController", function handleNewsController($scope, classPage, $http){
	classPage.setClassPage("News");
	//TODO rendere dinamico il caricamento delle news con una chiamata verso il file XML
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	$http({
		url: pagePath+"PHP/getNews.php",
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
	
	//TODO gestire l'evento
	$scope.deleteNews = function($event){
		//onclick sull'elliminazione della news
		if ($event) {
			$event.stopImmediatePropagation();
		}
	}
});