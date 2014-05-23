<?php
class Tag{
	
	const FILE_PATH = "../data/tags.xml";
	
	private static $dom=null;
	
	public $id;
	public $nome;
	
	public function __construct($array){
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
	
	public static function UpdateTag(){
		return false;
	}
	
	public static function SaveTag(){
		return false;
	}
}

?>