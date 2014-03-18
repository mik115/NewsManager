<?php
const FILE_PATH = "../data/news.xml";

$dom = new DomDocument();
$dom->load(FILE_PATH);

switch($_POST["action"]){
	case "GetAllNews":
		$results = GetAllNews($dom);
		break;
	case "GetNews":
		$results = GetNews($dom, $_POST["id"]);
		break;
	case "SaveNews":
		if(isset($_POST["id"])){
			$results= UpdateNews($dom, $_POST);
		}
		else{
			$results = SaveNews($dom, $_POST);
		}
		break;
	case "DeleteNews":
		$results = DeleteNews($dom, $_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function GetAllNews($dom){
  $xpath = new DOMXpath($dom);
  $notizie = $xpath->query("notizia");
  $notizieArray = array();
  if(!is_null($notizie)){
	  foreach($notizie as $not){
		  $notizia = new Notizia($not);
		  array_push($notizieArray, $notizia);
	  }
  }
  return $notizieArray;
}

function GetNews($dom, $id){
  $xpath = new DOMXpath($dom);
  $notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
  if(!is_null($notiziaDom)){
	  $notizia = new Notizia($notiziaDom);
	  return $notizia;
  }else{
	  return "false";
  }

}

function SaveNews($dom, $POST){
	$xpath = new DOMXpath($dom);
	$date = new DateTime($POST["date"]);
	$now = new DateTime();
	if($date<$now){
		$date = "";
	}else{
		$date = $date->format("U");
	}
	$notizia = $dom->createElement("notizia");
	//ID
	$result = $xpath ->query('//id');
	if(!is_null($result)){
		$maxId = 0;
		foreach($result as $idResult){
			if($maxId< intval($idResult->textContent)){
				$maxId= intval($idResult->textContent);
			}
		}
		$maxId++;
	}else{
		$maxId = 1;
	}
	$id= $dom->createElement("id");
	$id->appendChild($dom->createTextNode($maxId));
	$notizia->appendChild($id);
	//TITOLO
	$title = $dom->createElement("titolo");
	$title->appendChild($dom->createTextNode($POST["title"]));
	$notizia->appendChild($title);
	//SOTOTITOLO
	$subtitle = $dom->createElement("sottotitolo");
	$subtitle->appendChild($dom->createTextNode($POST["subtitle"]));
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
	if($POST["important"]=="")
		$importantContent=false;
	else
		$importantContent=true;
	$important->appendChild($dom->createTextNode($importantContent));
	$notizia->appendChild($important);
	//CATEGORIA
	$category = $dom->createElement("categoria");
	$category ->appendChild($dom->createTextNode($POST["category"]));
	$notizia->appendChild($category);
	//TAGS
	$tags = $dom->createElement("tags");
	if($POST["tags"]){
		foreach($POST["tags"] as $t){
			$tag = $dom->createElement("tag");
			$tag->appendChild($dom->createTextNode($t));
			$tags->appendChild($tag);
		}
	}
	$notizia->appendChild($tags);
	//NEWSCONTENT
	$newsContent = $dom->createElement("corpo");
	$newsContent->appendChild($dom->createTextNode(base64_encode($POST["newsContent"])));
	$notizia->appendChild($newsContent);
	$dom->documentElement->appendChild($notizia);
	return $dom->save(FILE_PATH);
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

//////////////////////////////////////// Class region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


class Notizia {
	public $titolo;
	public $sottotitolo;
	public $id;
	public $tags;
	public $categoria;
	public $corpo;
	public $dataCreazione;
	public $dataPublicazione;
	public $importante;
	
	public function __construct($dom){
		$this->titolo = $dom->getElementsByTagName("titolo")->item(0)->textContent;
		$this->sottotitolo = $dom->getElementsByTagName("sottotitolo")->item(0)->textContent;
		$this->categoria = new Categoria($dom->getElementsByTagName("categoria")->item(0)->textContent);
		$corpoNewsCoded = $dom->getElementsByTagName("corpo")->item(0)->textContent;		
		$this->corpo= addslashes(base64_decode($corpoNewsCoded));
		$this->dataCreazione = $dom->getElementsByTagName("dataCreazione")->item(0)->textContent;
		$this->dataPublicazione = $dom->getElementsByTagName("dataPubblicazione")->item(0)->textContent;
		$this->id= $dom->getElementsByTagName("id")->item(0)->textContent;
		$this->importante =$dom->getElementsByTagName("importante")->item(0)->textContent;
		$this->tags= array();
		$tags = $dom->getElementsByTagName("tag");
		foreach($tags as $tag){
			array_push($this->tags, new Tag($tag->textContent));
		}
	}
}

class Tag{
	public $id;
	public $nome;
	
	public function __construct($tagId){
		$this->id = $tagId;
		$this->nome = $this->GetTagName();
	}
	
	private function GetTagName(){
		if($this->id != null){
			$dom = new DomDocument();
			$dom->load("../data/tags.xml");
			$xpath = new DOMXpath($dom);
			$tag = $xpath->query("tag[id=".$this->id."]")->item(0);
			$tagNome = $tag->getElementsByTagName("nome")->item(0)->nodeValue;
		}else{
			$tagNome= $this->categoriaNome = "Nessun Tag";
		}
		return $tagNome;
	}
	
}

class Categoria{
	public $id;
	public $nome;
	
	public function __construct($catId){
		$this->id = $catId;
		$this->nome = $this->GetCategory($this->id); 
	}
	
	private function GetCategory($categoryId){
		if($categoryId != null){
			$dom = new DomDocument();
			$dom->load("../data/categories.xml");
			$xpath = new DOMXpath($dom);
			$categoria = $xpath->query("categoria[id=".$categoryId."]")->item(0);
			$categoriaNome = $categoria->getElementsByTagName("nome")->item(0)->nodeValue;
		}else{
			$categoriaNome= $this->categoriaNome = "Nessuna Categoria";
		}
		return $categoriaNome;
	}
}
//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>