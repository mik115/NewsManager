<?php

class Categoria{
	const FILE_PATH = "../data/categories.xml";
	
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
	
	public static function GetCategoryById($categoryId){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$categoria = $xpath->query("//categoria[id=".intval($categoryId)."]")->item(0);
		return Categoria::FromXml($categoria);
	}
	
	public static function FromXml($dom){
		$array = array();
		$array["id"] = $dom->getElementsByTagName("id")->item(0)->textContent;
		$array["nome"] = $dom->getElementsByTagName("nome")->item(0)->textContent;
		return new Categoria($array);
	}
}

?>