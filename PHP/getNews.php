<?php
	$filePath = "../data/";
	$dom = new DomDocument();
	$dom->load($filePath."news.xml");
	$methods = new Methods();
	
	if(!isset($_POST["id"])){
		//recupero tutte le news
		$results = $methods->GetAllNews($dom);
	}else{
		//recupero solo la news con l'id corrispondente al parametro in ingresso
		$results = $methods->GetNews($dom, $_POST["id"]);
	}
	echo json_encode($results, false);

//////////////////////////////////////// Class Region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
class Methods{
	public function GetAllNews($dom){
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
	public function GetNews($dom, $id){
		$xpath = new DOMXpath($dom);
		$notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
		if(!is_null($notiziaDom)){
			$notizia = new Notizia($notiziaDom);
			return $notizia;
		}else{
			return "false";
		}
	}
}


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
		$this->corpo= urlencode(base64_decode($corpoNewsCoded));
		$this->dataCreazione = $dom->getElementsByTagName("dataCreazione")->item(0)->textContent;
		$this->dataPublicazione = $dom->getElementsByTagName("dataPubblicazione")->item(0)->textContent;
		$this->id= $dom->getElementsByTagName("id")->item(0)->textContent;
		$this->importante =$dom->getElementsByTagName("importante")->item(0)->textContent;
		$this->tags= array();
		$tags = $dom->getElementsByTagName("tag");
		foreach($tags as $tag){
			array_push($this->tags, $tag->textContent);
		}
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


?>