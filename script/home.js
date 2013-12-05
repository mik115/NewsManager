var homeAppl = angular.module('homeApp', ["MainModule"]);

homeAppl.controller('mainCtrl', function mainCtrl($scope, classPage){
	classPage.setClassPage("Home"); //per evidenziare il link corrente
});

//necessario per poter gestire piu moduli di angular js nella stessa pagina!
$(document).ready(function(){
	angular.bootstrap($('#homeApp'),['homeApp']);	
});