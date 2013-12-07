var mainModule = angular.module("MainModule", []);
var classPage='';

 mainModule.service( 'classPage', [ '$rootScope', function( $rootScope ) {
    var service = {
      setClassPage: function ( page ) {
		$rootScope.classPage = page;
     }
   };
   return service;
 }]);

var navigationBar= mainModule.controller("navagationBar", function($rootScope, $scope ) {
	$scope.classPage = "";
	$scope.$watch($rootScope.classPage, function(){
		$scope.classPage = $rootScope.classPage;
	});
});


mainModule.directive("returnpress", function(){
	return {
		 link: function(scope, elem, attrs) {
				var functionToCall = scope.$eval(attrs.returnpress);
				elem.on('keydown', function(e){
					if(e.which==13){
						 functionToCall();
					}
			  });
		 }
	};
});