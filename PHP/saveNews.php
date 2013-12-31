<?php
	$dom = new DomDocument();
	$dom->load("../data/news.xml");
	//etc
	var_dump($_POST);
	$date = new DateTime($_POST["date"]);
	echo $date->format("d/m/Y H:i");
?>