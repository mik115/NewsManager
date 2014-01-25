<?php
	$filePath = "../data/news.xml";
	$dom = new DomDocument();
	$dom->load($filePath);
	$xpath = new DOMXpath($dom);
	$notizie = $xpath->query("notizia");
	$notizieArray = array();
	if(!is_null($notizie)){
		foreach($notizie as $not){
			$notizia = new Notizia($not);
			array_push($notizieArray, $notizia);
		}
	}
	echo json_encode($notizieArray, false);

	//TODO completare la creazione della classe con tutte le varie cose che ci stanno dentro.
class Notizia {
	public $titolo;
	public $sottotitolo;
	public $id;
	public $tags;
	public $categoria;
	public $corpo;
	public $dataCreazione;
	public $dataPublicazione;
	public $importante;
	
	public function __construct($dom){
		$this->titolo = $dom->getElementsByTagName("titolo")->item(0)->textContent;
		$this->sottotitolo = $dom->getElementsByTagName("sottotitolo")->item(0)->textContent;
		$this->categoria = $dom->getElementsByTagName("categoria")->item(0)->textContent;
		$corpoNewsCoded = $dom->getElementsByTagName("corpo")->item(0)->textContent;		
		$this->corpo= urlencode(base64_decode($corpoNewsCoded));
		$this->dataCreazione = $dom->getElementsByTagName("dataCreazione")->item(0)->textContent;
		$this->dataPublicazione = $dom->getElementsByTagName("dataPubblicazione")->item(0)->textContent;
		$this->id= $dom->getElementsByTagName("id")->item(0)->textContent;
		$this->importante =$dom->getElementsByTagName("importante")->item(0)->textContent;
		$this->tags= array();
		$tags = $dom->getElementsByTagName("tag");
		foreach($tags as $tag){
			array_push($this->tags, $tag->textContent);
		}
	}
}

?>