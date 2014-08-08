<?php

class Notizia {
	const FILE_PATH = "../data/news.xml";
	
	private static $dom=null;
	
	public $titolo;
	public $sottotitolo;
	public $id;
	public $tags;
	public $categoria;
	public $corpo;
	public $dataCreazione;
	public $dataPubblicazione;
	public $importante;
	
	private static function GetDom(){
		if(self::$dom == null){
			self::$dom = new DomDocument();
			self::$dom->load(self::FILE_PATH);
		}
		return self::$dom;
	}
	
	public function __construct($array){
		$this->titolo = $array["titolo"];
		$this->sottotitolo = $array["sottotitolo"];
		if($array["categoria"]!=""){
			$this->categoria = $array["categoria"];
		}
		if (base64_decode($array["corpo"], true) == true)
		{          
			$array["corpo"] = addslashes(base64_decode($array["corpo"]));    
		}	
		
		$this->corpo = $array["corpo"];
		
		$this->dataCreazione = $array["dataCreazione"];
		if(isset($array["dataPubblicazione"]))
			$this->dataPubblicazione = $array["dataPubblicazione"];
		else
			$this->dataPubblicazione = $this->dataCreazione;
		
		if(isset($array["id"]))
			$this->id = $array["id"];
		
		$this->importante = $array["importante"];

		if(isset($array["tags"])){
			$this->tags = $array["tags"];
		}else{
			$this->tags= array();
		}
	}
	
	public static function FromXml($dom){
		$not= array();
		$not["titolo"] = $dom->getElementsByTagName("titolo")->item(0)->textContent;
		$not["sottotitolo"] = $dom->getElementsByTagName("sottotitolo")->item(0)->textContent;
		$not["categoria"] = $dom->getElementsByTagName("categoria")->item(0)->textContent;
		$not["corpo"]= $dom->getElementsByTagName("corpo")->item(0)->textContent;	
		$not["dataCreazione"] = $dom->getElementsByTagName("dataCreazione")->item(0)->textContent;
		$not["dataPubblicazione"] = $dom->getElementsByTagName("dataPubblicazione")->item(0)->textContent;
		$not["id"]= $dom->getElementsByTagName("id")->item(0)->textContent;
		$not["importante"] =$dom->getElementsByTagName("importante")->item(0)->textContent;
		$not["tags"]= array();
		$tags = $dom->getElementsByTagName("tag");
		
		foreach($tags as $tag){
			array_push($not["tags"], $tag->textContent);
		}
		
		return new Notizia($not);
	}
	
	public static function GetAllNews(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notizie = $xpath->query("notizia");
		$notizieArray = array();
		if(!is_null($notizie)){
			foreach($notizie as $not){
				$notizia = Notizia :: FromXml($not, false);
				array_push($notizieArray, $notizia);
			}
		}
		return $notizieArray;
	}
	
	public static function GetNews($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
		if(!is_null($notiziaDom)){
			$notizia = Notizia::FromXml($notiziaDom);
			return $notizia;
		}else{
			return false;
		}
	}
	
	public static function DeleteNews($newsId){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notiziaDom = $xpath->query("notizia[id = ".intval($newsId)."]")->item(0);
		if(!is_null($notiziaDom)){
		  $notiziaDom->parentNode->removeChild($notiziaDom);
		  return $dom->save(self::FILE_PATH);
		}else{
		  return false;
		}
	}
	
	public static function DeleteTagsReference($tagId){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$tags = $xpath->query("notizia/tags/tag[text() = ".intval($tagId)."]");
		var_dump($tags);
		foreach($tags as $tag){
			$tag->parentNode->removeChild($tag);
		}
		$dom->save(self::FILE_PATH);
		return true;
	}
	
	public static function DeleteCategoryReference($catId){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$cats = $xpath->query("notizia/categoria[text() = ".intval($catId)."]");
		foreach($cats as $cat){
			$cat->nodeValue = "";
		}
		$dom->save(self::FILE_PATH);
		return true;
	}
	
	public function SaveNews(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		
		if(!is_bool($this->importante)){
			if($this->importante == "")
				$this->importante=false;
			else
				$this->importante=true;
		}
		
		if(!is_int($this->dataCreazione)){
			$now = new DateTime();
			$date = new DateTime();
			$date = $date->format("U");
		}
		
		if(!is_int($this->dataPubblicazione)){
			$this->dataPubblicazione = $this->dataCreazione;
		}
				
		if(!is_int($this->id) || !trim($this->id)==""){ //caso in cui sto aggiungendo una nuova news...quindi ho bisogno di un id
			$result = $xpath ->query('//id');
			if(!is_null($result)){
				$maxId = 0;
				foreach($result as $idResult){
					if($maxId< intval($idResult->textContent)){
						$maxId= intval($idResult->textContent);
					}
				}
				$this->id = $maxId+1;
			}else{
				echo "oldNews";
				$this->id =1;
			}
			
			$dom->documentElement->appendChild($this->ToXml());
			return $dom->save(self::FILE_PATH);
		}else{
			return $this->UpdateNews();
			//TODO cambiare l'update news in modo che sia la distruzione e ricreazione di una news...
		}
	}
	
	private function UpdateNews(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notizia = $xpath->query("notizia[id = ".intval($this->id)."]")->item(0);
		//TITOLO
		$titolo = $notizia->GetElementsByTagName("titolo")->item(0);
		$titolo -> nodeValue = $this->titolo;
		//SOTOTITOLO
		$subtitle = $notizia->GetElementsByTagName("sottotitolo")->item(0);
		$subtitle->nodeValue = $this->sottotitolo;
		//DATAPUBBLICAZIONE	
		$datePublication = $notizia->GetElementsByTagName("dataPubblicazione")->item(0);
		$datePublication ->nodeValue = $this->dataPubblicazione;
		//IMPORTANTE
		$important= $notizia->GetElementsByTagName("importante")->item(0);
		if($this->importante=="")
			$important-> nodeValue =false;
		else
			$important->nodeValue=true;
		//CATEGORIA
		$category = $notizia->GetElementsByTagName("categoria")->item(0);
		$category ->nodeValue = $this->categoria;
		//TAGS
		$tags = $notizia->GetElementsByTagName("tags")->item(0);
		
		while ($tags->hasChildNodes()) {
			$tags->removeChild($tags->firstChild);
		}
		
		if(count($this->tags) > 0){
			foreach($this->tags as $t){
				$tag = $dom->createElement("tag");
				$tag->appendChild($dom->createTextNode($t));
				$tags->appendChild($tag);
			}
		}
		//NEWSCONTENT
		$newsContent = $notizia->GetElementsByTagName("corpo")->item(0);
		$newsContent->nodeValue = base64_encode($this->corpo);
		$dom->save(self::FILE_PATH);
	}
	
	private function ToXml(){
		$dom = self::GetDom();
		$notizia = $dom->createElement("notizia");
		
		//ID
		$id= $dom->createElement("id");
		$id->appendChild($dom->createTextNode($this->id));
		$notizia->appendChild($id);
		
		//TITOLO
		$title = $dom->createElement("titolo");
		$title->appendChild($dom->createTextNode($this->titolo));
		$notizia->appendChild($title);
		
		//SOTOTITOLO
		$subtitle = $dom->createElement("sottotitolo");
		$subtitle->appendChild($dom->createTextNode($this->sottotitolo));
		$notizia->appendChild($subtitle);
		
		//DATACREAZIONE
		$dateCreation = $dom->createElement("dataCreazione");
		$dateCreation ->appendChild($dom->createTextNode($this->dataCreazione));
		$notizia->appendChild($dateCreation);
		
		//DATAPUBBLICAZIONE
		$datePublication = $dom->createElement("dataPubblicazione");
		$datePublication ->appendChild($dom->createTextNode($this->dataPubblicazione));
		$notizia -> appendChild($datePublication);
		
		//IMPORTANTE
		$important= $dom->createElement("importante");
		$important->appendChild($dom->createTextNode($this->importante));
		$notizia->appendChild($important);
		
		//CATEGORIA
		$category = $dom->createElement("categoria");
		if(is_object($this->categoria))
			$category ->appendChild($dom->createTextNode($this->categoria->id));
		else
			$category ->appendChild($dom->createTextNode($this->categoria));
		$notizia->appendChild($category);
		
		//TAGS
		$tags = $dom->createElement("tags");
		if(is_array($this->tags)){
			foreach($this->tags as $t){
				$tag = $dom->createElement("tag");
				if(is_object($t))
					$tag->appendChild($dom->createTextNode($t->id));
				else
					$tag->appendChild($dom->createTextNode($t));
				$tags->appendChild($tag);
			}
		}
		$notizia->appendChild($tags);
		
		//NEWSCONTENT
		$newsContent = $dom->createElement("corpo");
		$newsContent->appendChild($dom->createTextNode(base64_encode($this->corpo)));
		$notizia->appendChild($newsContent);
		
		return $notizia;
	}
	
}

?>