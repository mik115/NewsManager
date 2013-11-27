
//importante! va messo per la dichiarazione dell'app!
var mainApp = angular.module('mainApp', []);
 
//dichiarazione del comtroller!!
mainApp.controller('PhoneListCtrl', function PhoneListCtrl($scope) {
  $scope.phones = [
    {'name': 'Nexus S',
     'snippet': 'Fast just got faster with Nexus S.'},
    {'name': 'Motorola XOOM with Wi-Fi',
     'snippet': 'The Next, Next Generation tablet.'},
    {'name': 'MOTOROLA XOOM',
     'snippet': 'The Next, Next Generation tablet.'}
  ];
});

mainApp.controller("auth", function authCtrl($scope, $http){
	 
	 $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	 
	 $scope.login = function(){
		
		if ($.trim($scope.username)=="") {
		  $scope.emptyName=true;
		}
		if ($.trim($scope.password)=="") {
		  $scope.emptyPassword=true;
			alert("non hai inserito una password");
		}
		if($.trim($scope.username)!="" && $.trim($scope.password)!=""){
			$http({
		  url:"PHP/login.php",
		  method: "POST",
		  data : $.param({username : $scope.username, password: $scope.password})
		}).success(function(data, status, headers, config){
		  if (data != "") {
			 //è andato tutto a buon fine!! sei loggato
		  }else{
			  alert("username o password errata!");
			  //non è andata bene
		  }
		}).error(function(data, status, headers, config){
		  
		});
		}
	 }
  });
