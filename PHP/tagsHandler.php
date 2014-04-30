<?php
const FILE_PATH = "../data/tags.xml";

include("Entity/Tag.php");

$dom = new DomDocument();
$dom->load(FILE_PATH);

switch($_POST["action"]){
	case "GetAllTags":
		$results = GetAllTag($dom);
		break;
	
	case "SaveTag":
		if(isset($_POST["id"])){
			$results= UpdateTag($dom, $_POST);
		}
		else{
			$results = SaveTag($dom, $_POST);
		}
		break;
	case "DeleteTag":
		$results = DeleteTag($dom, $_POST["id"]);
		break;
	default:
		$results = false;
}

echo json_encode($results, false);

//////////////////////////////////////// Method region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function GetAllTag($dom){
  $xpath = new DOMXpath($dom);
  $tags = $xpath->query("tag");
  $tagsArray = array();
  if(!is_null($tags)){
	  foreach($tags as $tag){
		  $tagElem = Tag::FromXml($tag);
		  array_push($tagsArray, $tagElem);
	  }
  }
  return $tagsArray;
}

function SaveTag($dom, $POST){
	
	return $dom->save(FILE_PATH);
}

function UpdateTag($dom, $post){
	$xpath = new DOMXpath($dom);
	$notizia = $xpath->query("//tag[id = ".intval($post["id"])."]")->item(0);
	return $dom->save(FILE_PATH);
}

function DeleteTag($dom, $id){
	$xpath = new DOMXpath($dom);
	$tagDom = $xpath->query("//tag[id = ".intval($id)."]")->item(0);
	if(!is_null($tagDom)){
	  $tagDom->parentNode->removeChild($tagDom);
	  return $dom->save(FILE_PATH);
	}else{
	  return "false";
	}
}

//////////////////////////////////////// end region \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

?>