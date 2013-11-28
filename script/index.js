
//importante! va messo per la dichiarazione dell'app!
var mainApp = angular.module('mainApp', []);

mainApp.controller("auth", function authCtrl($scope, $http){
	 
	 $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	 
	 $scope.login = function(){
		if ($.trim($scope.username)=="") {
		  $scope.emptyName=true;
		}
		if ($.trim($scope.password)=="") {
		  $scope.emptyPassword=true;
		}
		if($.trim($scope.username)!="" && $.trim($scope.password)!=""){
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
				 $scope.emptyPassword=true;
				 $scope.emptyName=true;
			 }
		 }).error(function(data, status, headers, config){
			
		 });
		}
	 }
  });
