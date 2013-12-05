var homeAppl = angular.module('homeApp', ["MainModule"]);

homeAppl.controller('mainCtrl', function mainCtrl($scope, classPage){
	//$scope.classPage=classPage;
	classPage.setClassPage("Home");
});
