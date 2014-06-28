<?php
class Tag{
	
	const FILE_PATH = "../data/tags.xml";
	
	private static $dom=null;
	
	public $id;
	public $nome;
	
	public function __construct($array){
		if(isset($array["id"]) && trim($array["id"])!="")
			$this->id = $array["id"];
		$this->nome = $array["nome"];
	}
	
	private static function GetDom(){
		if(self::$dom == null){
			self::$dom = new DomDocument();
			self::$dom->load(self::FILE_PATH);
		}
		return self::$dom;
	}
	
	public static function GetTagById($tagId){
		$dom = new DomDocument();
		$dom->load(self::FILE_PATH);
		$xpath = new DOMXpath($dom);
		$tagDom = $xpath->query("//tag[id = ".intval($tagId)."]")->item(0);
		$tag = Tag::FromXml($tagDom);
		return $tag;
	}
	
	public static function FromXml($dom){
		$array = array();
		$array["id"] = $dom->getElementsByTagName("id")->item(0)->textContent;
		$array["nome"] = $dom->getElementsByTagName("nome")->item(0)->textContent;
		return new Tag($array);
	}
	
	public static function GetAllTags(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$tags = $xpath->query("//tag");
		$tagsArray = array();
		if(!is_null($tags)){
			foreach($tags as $t){
				$tag = Tag::FromXml($t);
				array_push($tagsArray, $tag);
			}
		}
		return $tagsArray;
	}
	
	public static function DeleteTag($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$tagToDelete = $xpath->query("//tag[id = ".intval($id)."]")->item(0);
		if(!is_null($tagToDelete)){
		  $tagToDelete->parentNode->removeChild($tagToDelete);
		  $dom->save(self::FILE_PATH);
		  return true;
		}else{
		  return false;
		}
	}
	
	public function SaveTag(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		if(isset($this->id)){
			//updateAction
			$result = $xpath->query("//tag[id=".$this->id."]")->item(0);
			$name = $result->getElementsByTagName("nome")->item(0);
			$name->nodeValue = $this->nome;
		}else{
			$allIds = $xpath->query("//id");
			$maxId = 0;
			foreach($allIds as $id){
				$id = intval($id->textContent);
				if($maxId < $id)
					$maxId = $id;
			}
			$this->id = $maxId + 1;
			$dom->documentElement->appendChild($this->ToXml());
		}
		return $dom->save(self::FILE_PATH);
	}
	
	public function ToXml(){
		$dom = self::GetDom();
		$tagElement = $dom->createElement("tag");
		//ID
		$id = $dom->createElement("id");
		$id->appendChild($dom->createTextNode($this->id));
		$tagElement->appendChild($id);
		//NOME
		$nome = $dom->createElement("nome");
		$nome->appendChild($dom->createTextNode($this->nome));
		$tagElement->appendchild($nome);
		return $tagElement;
	}
}

?>