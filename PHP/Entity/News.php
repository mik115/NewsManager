<?php

include("Tag.php");
include("Category.php");

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
	
	public function __construct($array, $complete){
		$this->titolo = $array["titolo"];
		$this->sottotitolo = $array["sottotitolo"];
		if($array["categoria"]!=""){
			if($complete)
				$this->categoria = Categoria::GetCategoryById($array["categoria"]);
			else
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
			
		$this->id = $array["id"];
		$this->importante = $array["importante"];
		if($complete){
			$this->tags = array();
			foreach($array["tags"] as $tag){
				array_push($this->tags, Tag::GetTagById($tag));
			}
		}else{
			$this->tags = $array["tags"];
		}
	}
	
	public static function FromXml($dom, $complete){
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
		
		return new Notizia($not, $complete);
	}
	
	
	public static function GetAllNewsWithElements(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notizie = $xpath->query("notizia");
		$notizieArray = array();
		if(!is_null($notizie)){
			foreach($notizie as $not){
				$notizia = Notizia :: FromXml($not, true);
				array_push($notizieArray, $notizia);
			}
		}
		return $notizieArray;
	}
	
	public static function GetAllNews(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notizie = $xpath->query("notizia");
		$notizieArray = array();
		if(!is_null($notizie)){
			foreach($notizie as $not){
				$notizia = new Notizia($not, false);
				array_push($notizieArray, $notizia);
			}
		}
		return $notizieArray;
	}
	
	public static function GetNewsWithElements($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
		if(!is_null($notiziaDom)){
			$notizia = Notizia::FromXml($notiziaDom, true);
			return $notizia;
		}else{
			return "false";
		}
	}
	
	public static function GetNews($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$notiziaDom = $xpath->query("notizia[id = ".intval($id)."]")->item(0);
		if(!is_null($notiziaDom)){
			$notizia = Notizia::FromXml($notiziaDom, false);
			return $notizia;
		}else{
			return "false";
		}
	}
	
	public function SaveNews(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		//TODO capire se va chiamato un save new news o un update news!!
		//lo si capisce dall'id!
		if(!is_int($this->id)){ //caso in cui sto aggiungendo una nuova news...quindi ho bisogno di un id
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
				$this->id =1;
			}
		}
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
		
		$dom->documentElement->appendChild($this->ToXml());
		return $dom->save(self::FILE_PATH);
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
		foreach($this->tags as $t){
			$tag = $dom->createElement("tag");
			if(is_object($t))
				$tag->appendChild($dom->createTextNode($t->id));
			else
				$tag->appendChild($dom->createTextNode($t));
			$tags->appendChild($tag);
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