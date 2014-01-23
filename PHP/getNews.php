<?php
	$filePath = "../data/news.xml";
	$dom = new DomDocument();
	$dom->load($filePath);
	$xpath = new DOMXpath($dom);
	$notizie = $xpath->query("notizia");
	if(!is_null($notizie)){
		foreach($notizie as $not){
			$notizia = new Notizia($not);
			var_dump($notizia);
		}
	}

	//TODO completare la creazione della classe con tutte le varie cose che ci stanno dentro.
class Notizia {
	public $titolo ="";
	public $sottotitolo = "";
	
	public function __construct($dom){
		$this->titolo = $dom->getElementsByTagName("titolo")->item(0)->textContent;
		$this->sottotitolo = $dom->getElementsByTagName("sottotitolo")->item(0)->textContent;
	}
}

?>