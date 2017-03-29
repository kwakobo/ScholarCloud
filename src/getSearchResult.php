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
	
	$author = $_GET["au"];
	$top_x = $_GET["hc"];
	
	$api_main_url = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?";
	$url_author_last_name = $api_main_url."au=".$author."&sortfield=au&sortorder=asc";
	$url_top_x_search = $url_author_last_name."hc=".$top_x;
	//$url_bibtex = "http://ieeexplore.ieee.org/xpl/downloadCitations?recordIds=".$article_num.
	//			"&citations-format=citation-only&download-format=download-bibtex&x=0&y=0";

	$response = getXMLResponse($url_top_x_search);
	$xml = simplexml_load_string($response);

	/*for ($i=0; $i<$top_x; $i++){
		echo $xml->document[$i]->title."<br>";
		echo $xml->document[$i]->authors."<br>";
		echo $xml->document[$i]->pdf."<br><br>";
	}*/
	
	
?>
