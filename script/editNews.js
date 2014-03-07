mainModule.controller('pageTitleSetter', function pageTitleSetter($scope, $location){
	var parametersArray = $location.search();
	if (parametersArray && parametersArray.id) {
		$scope.pageTitle="Edit News";
	}else{
		$scope.pageTitle="Add News";
	}
});

mainModule.controller('mainCtrl', function mainCtrl($scope, classPage, $location, $http){
	classPage.setClassPage("News"); //per evidenziare il link corrente
	var parametersArray = $location.search();
	if (parametersArray && parametersArray.id) {
		$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
		$http({
			url: pagePath+"PHP/newsHandler.php",
			method: "POST",
			data : $.param({
				action: "GetNews",
				id: parametersArray.id
			})
		}).success(function(data, status, headers, config){
			if (data != false) {
				$scope.title = data.titolo;
				$scope.newNewsBody= unescape(data.corpo);
				if (data.dataPublicazione=="") {
					$('#datetimepicker').data("DateTimePicker").setValue(moment(data.dataCreazione, "X"));
		//			$scope.publishDate = new Date(parseInt(data.dataCreazione));
				}else{
					$scope.publishDate = data.dataPublicazione;
				}
				$scope.subtitle =  data.sottotitolo;
				$scope.important = data.importante;
				var tagListId= new Array();
				for (var tag in data.tags) {
					tagListId.push(data.tags[tag].id);
				}
				//TODO capire come valorizzare la select!
				$("tagsSelection").selectpicker("val", tagListId)
				//TODO gestire messaggio di conferma e di errore lato AngularJS su codice!!
			}else{
				//non � andata bene
				
			}
		}).error(function(data, status, headers, config){
			
		});
		$scope.newsBody="<h1>ma che bella news</h1>";
		//TODO qui instanzio le azioni per la modifica della news indicata dall'id...quindi anche il caricamento del corpo e metadati della news
	}else{
		//TODO qui instanzio le azioni specifiche per la creazione di una nuova news
	}
	
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	$scope.save = function(){
		$scope.saveError = false;
		if ($scope.title && $scope.title!="" && CKEDITOR.instances.textEditor.getData()!="") {
			//TODO inserire qui le azioni per il salvataggio della news...
			$scope.loading= true;
			$http({
				url: pagePath+"PHP/newsHandler.php",
				method: "POST",
				data : $.param({
					action: "SaveNews",
					title : $scope.title,
					newsContent: CKEDITOR.instances.textEditor.getData(),
					date: $('#datetimepicker').data("DateTimePicker").getDate().toString(),
					tags: $scope.tagSelect,
					subtitle: $scope.subtitle,
					important: $scope.important,
					category: $scope.catSelect
				})
			}).success(function(data, status, headers, config){
				if (data != "false") {
					//$("#myModal").modal('hide');
					$scope.loading=false;
					$scope.success=true;
					//TODO gestire messaggio di conferma e di errore lato AngularJS su codice!!
				}else{
					//non � andata bene
					$scope.saveError = true;
				}
			}).error(function(data, status, headers, config){
				$scope.saveError = true;
			}).always(function(){
				$scope.loading= false;
			});
		}
	}
	
	$scope.backAction= function(){
		location.href=pagePath+'contents/handleNews.php';
	}
	
	$scope.redirect = function(){
		if ($scope.success) {
			location.href=pagePath+'contents/handleNews.php';
		}
	}
	
	$scope.checkCompleteness=function(){
		$scope.saveError = false;
		$scope.errore = (!$scope.title || $scope.title=="" || CKEDITOR.instances.textEditor.getData()=="");
	}
	//TODO caricare dinamicamente le categories e i tags dall'apposito XML
	$scope.tags = [
		{
			nome: "primo tag",
			id: 0
		},
		{
			nome: "prissmo tag",
			id: 1
		},
		{
			nome: "pridfdfmo tag",
			id: 2
		},
		{
			nome: "priamo tag",
			id: 3
		},
		{
			nome: "priamo tag",
			id: 4
		},
		{
			nome: "prifmo tag",
			id: 5
		},
		{
			nome: "primo tsdag",
			id: 6
		}
	];
	
	$scope.categories = [
		{
			nome: "prima categoria",
			id: 0
		},
		{
			nome: "prima categoria",
			id: 1
		},
		{
			nome: "priadsma categoria",
			id: 2
		},
		{
			nome: "primda categoria",
			id: 3
		},
		{
			nome: "paarima categoria",
			id: 4
		}
	];
});
