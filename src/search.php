<?php
	function get_pdf_text($article_url)
	{
		
	}

	require __DIR__ . '/vendor/autoload.php';
	include 'ieee_api.php';
	include_once 'ACMData/ACM_Parser.php';
	
	$author = $_GET["au"];
	$hc = $_GET["hc"];

	$ieee = json_decode(get($author, $hc), true);
	$acm = ((new ACMParser())->parse($author, $hc));

	$results = array();
	for($i = 0; $i < $ieee.length; $i++)
	{
		$article_entry = array();
		$article_entry["title"] = $ieee[$i]["title"];
		$article_entry["authors"] = $ieee[$i]["authors"];
		$article_entry["article"] = $ieee[$i]["article"];
		$article_entry["bibtex"] = $ieee[$i]["bibtex"];
		$article_entry["text"] = get_pdf_text($ieee[$i]["article"]);
	}
?>