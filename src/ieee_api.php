<?php
	function getXMLResponse($url_top_x_search) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_top_x_search);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$xml_response = curl_exec($ch);
		curl_close($ch);
		return $xml_response;
	}
	

	function createArticleArray($xml, $top, $url_bibtex)
	{
		$articles = array();
		if ($xml->totalfound < $top) {
			$top = $xml->totalfound;
		}
		for ($i=0; $i<$top; $i++) {
			$title = $xml->document[$i]->title->__toString();
			$article_num = $xml->document[$i]->arnumber->__toString();
			$authors = $xml->document[$i]->authors->__toString();
			$pdf = $xml->document[$i]->pdf->__toString();
			$bibtex = $url_bibtex.$article_num;
			$abstract = $xml->document[$i]->abstract->__toString();
			
			$article_elem = array();
			$article_elem["title"] = $title;
			//$article_elem["arnumber"] = $article_num;
			$article_elem["authors"] = $authors;
			$article_elem["article"] = $pdf;
			$article_elem["bibtex"] = $bibtex;
			$article_elem["abstract"] = $abstract;
			
			array_push($articles, $article_elem);
		}
		return $articles;
	}
	
	$author = $_GET["au"];
	$top_x = $_GET["hc"];
	
	$api_main_url = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?&sortfield=au&sortorder=asc";
	$url_search = $api_main_url."&au=".$author."&hc=".$top_x;
	$url_bibtex = "http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=";

	$response = getXMLResponse($url_search);
	$xml = simplexml_load_string($response);
	
	$articles = createArticleArray($xml, $top_x, $url_bibtex);
	
	echo json_encode($articles,JSON_UNESCAPED_SLASHES);
?>
