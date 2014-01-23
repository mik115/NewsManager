<?php
	$filePath = "../data/news.xml";
	$dom = new DomDocument();
	$dom->load($filePath);
	$xpath = new DOMXpath($dom);
	$date = new DateTime($_POST["date"]);
	$now = new DateTime();
	if($date<$now){
		$date = "";
	}else{
		$date = $date->format("U");
	}
	$notizia = $dom->createElement("notizia");
	//ID
	//TODO capire bene come recuperare il max id presente nel xml!!
	$result = $xpath ->query("/notizia/id[not(preceding-sibling::id/text() > text() or following-sibling::id/text() > text())]");
	if(!is_null($result)){
		var_dump($result);
		$maxIdVal = intVal($result->item(0)->textContent);
		var_dump($maxIdVal);
	}else{
		$idValue = 1;
	}
	$id= $dom->createElement("id");
	$id->appendChild($dom->createTextNode($idValue));
	$notizia->appendChild($id);
	//TITOLO
	$title = $dom->createElement("titolo");
	$title->appendChild($dom->createTextNode($_POST["title"]));
	$notizia->appendChild($title);
	//SOTOTITOLO
	$subtitle = $dom->createElement("sottotitolo");
	$subtitle->appendChild($dom->createTextNode($_POST["subtitle"]));
	$notizia->appendChild($subtitle);
	//DATACREAZIONE
	$dateCreation = $dom->createElement("dataCreazione");
	$dateCreation ->appendChild($dom->createTextNode($now->format("U")));
	$notizia->appendChild($dateCreation);
	//DATAPUBBLICAZIONE
	$datePublication = $dom->createElement("dataPubblicazione");
	$datePublication ->appendChild($dom->createTextNode($date));
	$notizia -> appendChild($datePublication);
	//IMPORTANTE
	$important= $dom->createElement("importante");
	if($_POST["important"]=="")
		$importantContent=false;
	else
		$importantContent=true;
	$important->appendChild($dom->createTextNode($importantContent));
	$notizia->appendChild($important);
	//CATEGORIA
	$category = $dom->createElement("categoria");
	$category ->appendChild($dom->createTextNode($_POST["category"]));
	$notizia->appendChild($category);
	//TAGS
	$tags = $dom->createElement("tags");
	foreach($_POST["tags"] as $t){
		$tag = $dom->createElement("tag");
		$tag->appendChild($dom->createTextNode($t));
		$tags->appendChild($tag);
	}
	$notizia->appendChild($tags);
	//NEWSCONTENT
	$newsContent = $dom->createElement("corpo");
	$newsContent->appendChild($dom->createTextNode(base64_encode($_POST["newsContent"])));
	$notizia->appendChild($newsContent);
	$dom->documentElement->appendChild($notizia);
	echo  1;//$dom->save($filePath);
?>