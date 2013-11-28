<?php
	$dom = new DOMDocument();
	$dom->load("../data/users.xml");
	$xpath = new DOMXPath($dom);
	$user = $xpath->query('/users/user[username="'.$_POST["username"].'"]', $dom);
	if($user->length>0){
		$passw=$user->item(0)->getElementsByTagName("password")->item(0)->nodeValue;
		if($passw== sha1($_POST["password"])){
			session_start();
			$_SESSION["user"]= $_POST["uName"];
			$_SESSION["scope"]="NewsManager";
			echo "OK";
		}
	}
?>