<?php

class Categoria{
	const FILE_PATH = "../data/categories.xml";
	
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
	
	public static function GetCategoryById($categoryId){
		if(!is_null($categoryId)){
			$dom = self::GetDom();
			$xpath = new DOMXpath($dom);
			$categoria = $xpath->query("//categoria[id=".intval($categoryId)."]")->item(0);
			return Categoria::FromXml($categoria);
		}else{
			return null;
		}
	}
	
	public static function FromXml($dom){
		$array = array();
		$array["id"] = $dom->getElementsByTagName("id")->item(0)->textContent;
		$array["nome"] = $dom->getElementsByTagName("nome")->item(0)->textContent;
		return new Categoria($array);
	}
	
	public static function GetAllCategories(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$categories = $xpath->query("//categoria");
		$categoriesArray = array();
		if(!is_null($categories)){
			foreach($categories as $c){
				$category = Categoria::FromXml($c);
				array_push($categoriesArray, $category);
			}
		}
		return $categoriesArray;
	}
	
	public static function DeleteCategory($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$catToDelete = $xpath->query("//categoria[id = ".intval($id)."]")->item(0);
		if(!is_null($catToDelete)){
		  $catToDelete->parentNode->removeChild($catToDelete);
		  $dom->save(self::FILE_PATH);
		  return true;
		}else{
		  return false;
		}
	}

	public function SaveCategory(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		if(isset($this->id)){
			//updateAction
			$result = $xpath->query("//categoria[id=".$this->id."]")->item(0);
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
		$catElement = $dom->createElement("categoria");
		//ID
		$id = $dom->createElement("id");
		$id->appendChild($dom->createTextNode($this->id));
		$catElement->appendChild($id);
		//NOME
		$nome = $dom->createElement("nome");
		$nome->appendChild($dom->createTextNode($this->nome));
		$catElement->appendchild($nome);
		return $catElement;
	}
}

?>