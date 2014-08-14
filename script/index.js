
//importante! va messo per la dichiarazione dell'app!
var mainApp = angular.module('mainApp', ["MainModule"]);

mainApp.controller("auth", function authCtrl($scope, $http){
	 
	 $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	 $scope.login = function(){
		  if ($.trim($scope.username)=="" || $.trim($scope.password)=="") {
			 $scope.emptyField=true;
		  }
		  else{
				$scope.emptyField=false;
				$http({
					 url:"PHP/userHandler.php",
					 method: "POST",
					 data : $.param({
						  action: "Login",
						  username : $scope.username,
						  password: $scope.password
						  })
				}).success(function(data, status, headers, config){
					 if (data=="true") {
						//è andato tutto a buon fine!! sei loggato
						window.location.href= "contents/home.php"
					 }else{
						 //non è andata bene
						 $scope.loginError=true;
						 $scope.password = "";
					 }
				}).error(function(data, status, headers, config){
				 
				});
		  }
	 }
});