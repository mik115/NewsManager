
//importante! va messo per la dichiarazione dell'app!
var mainApp = angular.module('mainApp', ["MainModule"]);

mainApp.controller("auth", function authCtrl($scope, $http, setClassPage){
	 
	 setClassPage($scope, "Home");
	 
	 $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	 $scope.login = function(){
		  if ($.trim($scope.username)=="" || $.trim($scope.password)=="") {
			 $scope.emptyField=true;
		  }
		  else{
				$scope.emptyField=false;
				$http({
					 url:"PHP/login.php",
					 method: "POST",
					 data : $.param({username : $scope.username, password: $scope.password})
				}).success(function(data, status, headers, config){
					 if (data != "") {
						//è andato tutto a buon fine!! sei loggato
						window.location.href= "contents/home.php"
					 }else{
						 //non è andata bene
						 $scope.loginError=true;
					 }
				}).error(function(data, status, headers, config){
				 
				});
		  }
	 }
	 
	 $scope.aaa=function(){
		  alert("aaa");
	 }
});