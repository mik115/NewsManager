
mainModule.controller('mainCtrl', function mainCtrl($scope, classPage){
	classPage.setClassPage("Home"); //per evidenziare il link corrente
	
	$scope.mostra=false;
	$scope.mostrami=false;
});
