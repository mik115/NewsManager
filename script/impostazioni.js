var impAppl = angular.module('implAppl', ["MainModule"]);

impAppl.controller('impMainCtrl', function impMainCtrl($scope, classPage){
	classPage.setClassPage("Impostazioni"); //per evidenziare il link corrente
});

//necessario per poter gestire piu moduli di angular js nella stessa pagina!
$(document).ready(function(){
	angular.bootstrap($('#implAppl'),['implAppl']);
});