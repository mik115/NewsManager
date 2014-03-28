<?php
include("Entity/News.php");

switch($_POST["action"]){
	case "GetAllNews":
		$results = Notizia::GetAll();
		break;
	case "GetAllNewsWithElements":
		$results = Notizia::GetAllNewsWithElements();
		break;
	case "GetNews":
		$results = Notizia::GetNews($_POST["id"]);
		break;
	case "GetNewsWithElements":
		$results = Notizia::GetNewsWithElements($_POST["id"]);
		break;
	case "SaveNews":
		$results = SaveNews($_POST);
		break;
	case "DeleteNews":
		$results = Notizia::DeleteNews($_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function SaveNews($POST){
	//TODO spostare tutta la parte di creazione del dom all'interno dell'oggetto news...
	if(!isset($POST["id"])){
		echo "aaaaaaaaaaa";
		$date = new DateTime();
		$POST["dataCreazione"] = $date->format("U");
	}
	$not = new Notizia($POST, false);
	var_dump($not);
	return $not->SaveNews();
}

//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>