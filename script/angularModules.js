var mainModule = angular.module("MainModule", []);

mainModule.service( 'classPage', [ '$rootScope', function( $rootScope ) {
	var service = {
		setClassPage: function ( page ) {
			$rootScope.classPage = page;
		}
	};
   return service;
 }]);

 
mainModule.service("modalWindowService", [function(){
	return{
		openModal: function(){
		var scope = angular.element("#myModal").scope();
			//$("#myModal").modal('show');
		
		}
	};
}]);


mainModule.controller("modalWindow", function($scope){
	$scope.queryMessage="";
	$scope.ErrorMessage="";
	$scope.redirect ="";
	$scope.okAction="";
});
 
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

mainModule.config(['$locationProvider',
	function($locationProvider) {
		 $locationProvider.html5Mode(true);
	}]
);

mainModule.run(function($rootScope) {
    $('[ng-app]').on('click', 'a', function() {
        window.location.href = $(this).attr('href');
    });
});
