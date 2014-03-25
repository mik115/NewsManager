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
		$results = DeleteNews($_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

function SaveNews($dom, $POST){
	//TODO spostare tutta la parte di creazione del dom all'interno dell'oggetto news...
	$not = new Notizia($POST);
	var_dump($not);
	return $not->SaveNews();
}

function UpdateNews($dom, $post){
	$xpath = new DOMXpath($dom);
	$notizia = $xpath->query("//notizia[id = ".intval($post["id"])."]")->item(0);
	//TITOLO
	$titolo = $notizia->GetElementsByTagName("titolo")->item(0);
	$titolo -> nodeValue = $post["title"];
	//SOTOTITOLO
	$subtitle = $notizia->GetElementsByTagName("sottotitolo")->item(0);
	$subtitle->nodeValue = $post["subtitle"];
	//DATAPUBBLICAZIONE
	$date = new DateTime($post["date"]);
	$now = new DateTime();
	if($date<$now){
		$date = "";
	}else{
		$date = $date->format("U");
	}
	$datePublication = $notizia->GetElementsByTagName("dataPubblicazione")->item(0);
	$datePublication ->nodeValue = $date;
	//IMPORTANTE
	$important= $notizia->GetElementsByTagName("importante")->item(0);
	if($post["important"]=="")
		$important-> nodeValue =false;
	else
		$important->nodeValue=true;
	//CATEGORIA
	$category = $notizia->GetElementsByTagName("categoria")->item(0);
	$category ->nodeValue = $post["category"];
	//TAGS
	$tags = $notizia->GetElementsByTagName("tags")->item(0);
	
	while ($parentNode->hasChildNodes()) {
		$parentNode->removeChild($parentNode->firstChild);
	}
	
	if($post["tags"]){
		foreach($post["tags"] as $t){
			$tag = $dom->createElement("tag");
			$tag->appendChild($dom->createTextNode($t));
			$tags->appendChild($tag);
		}
	}
	//NEWSCONTENT
	$newsContent = $notizia->GetElementsByTagName("corpo")->item(0);
	$newsContent->nodeValue = base64_encode($post["newsContent"]);
	
	return $dom->save(FILE_PATH);
}

function DeleteNews($dom, $id){
	$xpath = new DOMXpath($dom);
	$notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
	if(!is_null($notiziaDom)){
	  $notiziaDom->parentNode->removeChild($notiziaDom);
	  return $dom->save(FILE_PATH);
	}else{
	  return "false";
	}
}

//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>