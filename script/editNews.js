mainModule.controller('pageTitleSetter', function pageTitleSetter($scope, $location){
	var parametersArray = $location.search();
	if (parametersArray && parametersArray.id) {
		$scope.pageTitle="Edit News";
	}else{
		$scope.pageTitle="Add News";
	}
});

mainModule.controller('mainCtrl', function mainCtrl($scope, classPage, $location, $http, modalWindowService){
	classPage.setClassPage("News"); //per evidenziare il link corrente
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";
	
	//Load dei tags
	$http({
		url: pagePath+"PHP/tagsHandler.php",
		method: "POST",
		data : $.param({
			action: "GetAllTags"
		})
	}).success(function(data, status, headers, config){
		if (data != false) {
			$scope.tags = data;
			setTimeout(function(){
				angular.element("#tagsSelection").selectpicker("refresh");
				//jQuery("#tagsSelection").selectpicker("refresh");
			}, 1);
		}else{
			//non è andata bene
			//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
		}
	}).error(function(data, status, headers, config){
		
	});
	
	
	$http({
		url: pagePath+"PHP/categoryHandler.php",
		method: "POST",
		data : $.param({
			action: "GetAllCategories"
		})
	}).success(function(data, status, headers, config){
		if (data != false) {
			$scope.categories = data;
			setTimeout(function(){
				angular.element("#categorySelect").selectpicker("refresh");
			}, 1);
		}else{
			//non è andata bene
			//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
		}
	}).error(function(data, status, headers, config){
		
	});
	
	
	
	var parametersArray = $location.search();
	if (parametersArray && parametersArray.id) {
		$scope.newsId = parametersArray.id;
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
				//non è andata bene
				//TODO mostrare un messaggio di errore sul caricamento della news all'interno della pagina.
			}
		}).error(function(data, status, headers, config){
			
		});
		$scope.newsBody="<h1>ma che bella news</h1>";
		//TODO qui instanzio le azioni per la modifica della news indicata dall'id...quindi anche il caricamento del corpo e metadati della news
	}else{
		//TODO qui instanzio le azioni specifiche per la creazione di una nuova news
	}
	
	$scope.saveNews = function(){
		if ($scope.title && $scope.title!="" && CKEDITOR.instances.textEditor.getData()!="") {
			modalWindowService.openModal({
				message: "Sei sicuro di voler salvare la news?",
				okButtonText: "Salva",
				confirm : true,
				successMessage: "News salvata con successo!",
				errorMessage: "Si è verificato un errore imprevisto; riprova e se si ripete contatta l'amministratore.",
				redirect : "contents/handleNews.php",
				okAction: function($modalScope){
					$http({
						url: pagePath+"PHP/newsHandler.php",
						method: "POST",
						data : $.param({
							id: $scope.newsId,
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
						$modalScope.loading= false;
						if (data != "false") {
							$modalScope.loading=false;
							$modalScope.success=true;
						}else{
							//non è andata bene
							$modalScope.error = true;
						}
					}).error(function(data, status, headers, config){
						$modalScope.loading= false;
						$modalScope.error = true;
					});
				},
			});		
		}else{
			modalWindowService.openModal({
				message: "<p class='text-danger'>Devi Indicare almeno un titolo e un corpo della news per poterne creare una nuova.</p>",
				confirm : false
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
});
