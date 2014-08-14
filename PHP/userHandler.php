<?php
include("Entity/User.php");


switch($_POST["action"]){
	
	case "Login":
		$results = Utente::Login($_POST["username"], $_POST["password"]);
		break;
	case "GetAllUser":
		$results = Utente::GetAllUser();
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