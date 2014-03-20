<?php
const FILE_PATH = "../data/categories.xml";

$dom = new DomDocument();
$dom->load(FILE_PATH);

switch($_POST["action"]){
	case "GetAllCategories":
		$results = GetAllCategories($dom);
		break;
	case "SaveTag":
		if(isset($_POST["id"])){
			$results= UpdateCategory($dom, $_POST);
		}
		else{
			$results = SaveCategory($dom, $_POST);
		}
		break;
	case "DeleteTag":
		$results = DeleteCategory($dom, $_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function GetAllCategories($dom){
  $xpath = new DOMXpath($dom);
  $categories = $xpath->query("//categoria");
  $categoriesArray = array();
  if(!is_null($categories)){
	  foreach($categories as $category){
		  $categoryElem = new Category($category);
		  array_push($categoriesArray, $categoryElem);
	  }
  }
  return $categoriesArray;
}

function SaveCategory($dom, $POST){
	
	return $dom->save(FILE_PATH);
}

function UpdateCategory($dom, $post){
	$xpath = new DOMXpath($dom);
	$notizia = $xpath->query("//categoria[id = ".intval($post["id"])."]")->item(0);
	return $dom->save(FILE_PATH);
}

function DeleteCategory($dom, $id){
	$xpath = new DOMXpath($dom);
	$notiziaDom = $xpath->query("//categoria[id = ".intval($id)."]")->item(0);
	if(!is_null($notiziaDom)){
	  $notiziaDom->parentNode->removeChild($notiziaDom);
	  return $dom->save(FILE_PATH);
	}else{
	  return "false";
	}
}

//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

//////////////////////////////////////// Class region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

class Category{
	public $id;
	public $nome;
	
	public function __construct($dom){
		$this->id = $dom->getElementsByTagName("id")->item(0)->textContent;
		$this->nome = $dom->getElementsByTagName("nome")->item(0)->textContent;
	}
}
//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>