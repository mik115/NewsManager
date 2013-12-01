//angular.module("main", [])
	 


//importante! va messo per la dichiarazione dell'app!
var mainApp = angular.module('mainApp', []);

mainApp.controller("auth", function authCtrl($scope, $http){
	 
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

mainApp.directive("keyPress", function(){
		  return {
	//			restrict: 'A',
				link: function(scope, elem, attrs) {
					  // this next line will convert the string
					  // function name into an actual function
					  var functionToCall = scope.$eval(attrs.keyPress);
					  elem.on('keydown', function(e){
							 // on the keydown event, call my function
							 // and pass it the keycode of the key
							 // that was pressed
							 // ex: if ENTER was pressed, e.which == 13
							 functionToCall(e.which);
					  });
				}
		  };
	 });
