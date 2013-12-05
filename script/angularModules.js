var mainModule = angular.module("MainModule", []);
var classPage='';

 mainModule.service( 'classPage', [ '$rootScope', function( $rootScope ) {
    var service = {
      setClassPage: function ( page ) {
		classPage = page;
      $rootScope.$broadcast( 'classPage.update' );
     }
   }
   return service;
 }]);

mainModule.controller("navagationBar", [ '$scope', function( scope ) {
   scope.$on( 'classPage.update', function( event ) {
     scope.classPage = classPage;
   });
 }]);


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