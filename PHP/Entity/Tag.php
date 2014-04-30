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
		
	}
	
	public static function DeleteTag(){
		return 1;
	}
	
	public static function UpdateTag(){
		
	}
	
	public static function SaveTag(){
		
	}
}

?>