<?php
include("Entity/News.php");
include("Entity/Tag.php");
include("Entity/Category.php");


switch($_POST["action"]){
	//NEWS
	case "GetAllNews":
		$results = Notizia::GetAllNews();
		break;
	case "GetAllNewsWithElements":
		$results = GetAllNewsWithElements();
		break;
	case "GetNews":
		$results = Notizia::GetNews($_POST["id"]);
		break;
	case "GetNewsWithElements":
		$results = GetNewsWithElements($_POST["id"]);
		break;
	case "SaveNews":
		$results = SaveNews($_POST);
		break;
	case "DeleteNews":
		$results = Notizia::DeleteNews($_POST["id"]);
		break;
	
	//TAGS
	case "GetTagById":
		$results = Tag::GetTagById($_POST["id"]);
		break;
	
	case "GetAllTags":
		$results = Tag::GetAllTags();
		break;
	
	case "SaveTag":
		$results = SaveTag($_POST);
		break;
	
	case "DeleteTag":
		$results = Tag::DeleteTag($_POST["id"]);
		if($results){
			Notizia::DeleteTagsReference($_POST["id"]);
		}
		break;
	
	//CATEGORIES
	case "GetAllCategories":
		$results = Categoria::GetAllCategories();
		break;
	case "SaveCategory":
		$results = SaveCategory($_POST);
		break;
	case "DeleteCategory":
		$results = Categoria::DeleteCategory($_POST["id"]);
		if($results){
			Notizia::DeleteCategoryReference($_POST["id"]);
		}
		break;
	case "GetCategoryById":
		$results = Categoria::GetCategoryById($_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function SaveNews($POST){
	if(!isset($POST["id"]) || trim($POST["id"]=="")){
		$date = new DateTime();
		$POST["dataCreazione"] = $date->format("U");
	}
	$not = new Notizia($POST, false);
	return $not->SaveNews();
}

function GetAllNewsWithElements(){
	$notizie = Notizia::GetAllNews();
	foreach($notizie as $not){
		$not->categoria = Categoria::GetCategoryById($not->categoria);
		for($i=0; $i< count($not->tags); $i++){
			$not->tags[$i] = Tag::GetTagById($not->tags[$i]);
		}
	}
	return $notizie;
}

function GetNewsWithElements($id){
	$notizia = Notizia::GetNews($id);
	$notizia->categoria = Categoria::GetCategoryById($notizia->categoria);
	for($i=0; $i< count($notizia->tags); $i++){
		$notizia->tags[$i] = Tag::GetTagById($notizia->tags[$i]);
	}
	return $notizia;
}

function SaveTag($POST){
	$tag = new Tag($POST);
	return $tag->SaveTag();
}

function SaveCategory($POST){
	$category = new Categoria($POST);
	return $category->SaveCategory();
}

//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>