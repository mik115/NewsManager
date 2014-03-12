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
		openModal: function(okAction, options){
			var scope = angular.element("#myModal").scope();
			if(options){
				if(options.message)
					scope.queryMessage=options.message;
				if(options.ErrorMessage)
					scope.ErrorMessage = options.ErrorMessage;
				if(options.redirect)
					scope.redirect = options.redirect;
				if(options.okButtonText)
					scope.okButtonText = options.okButtonText;
			}
			
			scope.okAction= okAction;
			$("#myModal").modal('show');
		}
	};
}]);


mainModule.controller("modalWindow", function($scope){
	$scope.queryMessage="Sei sicuro di procedere?";
	$scope.ErrorMessage="Si è verificato un errore imprevisto, se si ripete contatta il gestore.";
	$scope.okButtonText = "Conferma";
	$scope.cancelButtonText = "Annulla";
	$scope.redirect = false;
	$scope.okAction = false;
	//status bit
	$scope.errore = false;
	$scope.success = false;
	$scope.loading = false;
	$scope.okAction = function(){
		$scope.loading = true;
		if($scope.okAction)
			$scope.okAction($scope);
		else
			$scope.loading = false;
			$scope.success = true;
	}
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
