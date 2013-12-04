var mainModule = angular.module("MainModule", []);

mainModule.controller("navagationBar", function($scope){
//	$scope.classPage="Home";
});

mainModule.factory('setClassPage', function(page) {
  $scope.classPage=page;
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