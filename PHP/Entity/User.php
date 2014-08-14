<?php

class Utente{
	const FILE_PATH = "../data/users.xml";
	
	private static $dom =null;
	
	public $id;
	public $username;
	public $password;
	public $name;
	public $surname;
	public $mail;
	
	private static function GetDom(){
		if(self::$dom == null){
			self::$dom = new DomDocument();
			self::$dom->load(self::FILE_PATH);
		}
		return self::$dom;
	}
	
	public function __construct($array){
		if(isset($array["id"]))
			$this->id = $array["id"];
		
		$this->username = $array["username"];
		
		$this->password = $array["password"];
		$this->mail = $array["mail"];
		$this->name = $array["name"];
		$this->surname = $array["surname"];
		
	}
	
	public static function FromXml($dom){
		$array = array();
		$array["id"] = $dom->getElementsByTagName("id")->item(0)->textContent;
		$array["username"] = $dom->getElementsByTagName("username")->item(0)->textContent;
		$array["password"] = $dom->getElementsByTagName("password")->item(0)->textContent;
		$array["mail"] = $dom->getElementsByTagName("mail")->item(0)->textContent;
		$array["name"] = $dom->getElementsByTagName("name")->item(0)->textContent;
		$array["surname"] = $dom->getElementsByTagName("surname")->item(0)->textContent;
		
		$user = new Utente($array);
		return $user;
	}
	
	public static function Login(){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$users = $xpath->query('/users/user[username="'.$_POST["username"].'"]', $dom);
		if($users->length>0){
			$user = Utente::FromXml($users->item(0));
			if($user->password == sha1($_POST["password"])){
				session_start();
				$_SESSION["user"]= $_POST["username"];
				$_SESSION["scope"]="NewsManager";
				return true;
			}
		}
		return false;
	}
	
	public static function GetAllUser(){
		session_start();
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$utentiDom = $xpath->query("user[username != '".$_SESSION["user"]."']");
		$utentiArray = array();
		if(!is_null($utentiDom)){
			foreach($utentiDom as $user){
				$utente = Utente::FromXml($user);
				array_push($utentiArray, $utente);
			}
		}
		return $utentiArray;
	}
	
	public static function GetUser($id){
		$dom = self::GetDom();
		$xpath = new DOMXpath($dom);
		$utenteDom = $xpath->query("user[id = ".intval($id)."]")->item(0);
		if(!is_null($utenteDom)){
			$utente = Utente::FromXml($utenteDom);
			return $utente;
		}else{
			return false;
		}
	}
	
}





?>