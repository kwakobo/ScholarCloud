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

	function getTitle($xml,$i)
	{
		return $xml->document[$i]->title->__toString();
	}
	function getArthors($xml,$i)
	{
		return $xml->document[$i]->authors->__toString();
	}
	function getArticle($xml,$i)
	{
		return $xml->document[$i]->pdf->__toString();
	}
	function getBibtext($url_bibtex,$xml,$i)
	{
		$article_num = $xml->document[$i]->arnumber->__toString();
		return $url_bibtex.$article_num;

	}
	function getConference($xml,$i)
	{
		return $xml->document[$i]->pubtitle->__toString();
	}
	function getAbstract($xml,$i)
	{
		return $xml->document[$i]->abstract->__toString();
	}
	function getDOI($xml, $i)
	{
		return $xml->document[$i]->doi->__toString();
	}
	function createArticleArray($xml, $top, $url_bibtex)
	{
		$articles = array();
		if ($xml->totalfound < $top) {
			$top = $xml->totalfound;
		}
		for ($i=0; $i<$top; $i++) {
			/*$title = $xml->document[$i]->title->__toString();
			$article_num = $xml->document[$i]->arnumber->__toString();
			$authors = $xml->document[$i]->authors->__toString();
			$pdf = $xml->document[$i]->pdf->__toString();
			$bibtex = $url_bibtex.$article_num;
			$conference = $xml->document[$i]->pubtitle->__toString();
			$abstract = $xml->document[$i]->abstract->__toString();

			$article_elem = array();
			$article_elem["title"] = $title;
			//$article_elem["arnumber"] = $article_num;
			$article_elem["authors"] = $authors;
			$article_elem["article"] = $pdf;
			$article_elem["bibtex"] = $bibtex;
			$article_elem["conference"] = $conference;
			//$article_elem["publication_type"] = "PDF";
			$article_elem["abstract"] = $abstract;*/

			$article_elem = array();
			$article_elem["title"] = getTitle($xml,$i);
			//$article_elem["arnumber"] = $article_num;
			$article_elem["doi"] = getDOI($xml, $i);
			$article_elem["authors"] = getArthors($xml,$i);
			$article_elem["article"] = getArticle($xml,$i);
			$article_elem["bibtex"] = getBibtext($url_bibtex,$xml,$i);
			$article_elem["conference"] = getConference($xml,$i);
			//$article_elem["publication_type"] = "PDF";
			$article_elem["abstract"] = getAbstract($xml,$i);
			$article_elem["text"] = getAbstract($xml,$i);

			array_push($articles, $article_elem);
		}
		return $articles;
	}

	function get($author, $hc)
	{
		$api_main_url = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?&sortfield=au&sortorder=asc";
		$url_search = $api_main_url."&md=".$author."&hc=".$hc;
		$url_search = str_replace ( ' ', '%20', $url_search);
		$url_bibtex = "http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=";
		$response = getXMLResponse($url_search);
		$xml = simplexml_load_string($response);

		$articles = createArticleArray($xml, $hc, $url_bibtex);

		return $articles;
	}

	/*$array =get("halfond", 2);

	for ($i=0; $i < count($array); $i++) {
		echo "title: ".$array[$i]["title"]."<br>";
		echo "authors: ".$array[$i]["authors"]."<br>";
		echo "article: ".$array[$i]["article"]."<br>";
		echo "bibtex: ".$array[$i]["bibtex"]."<br>";
		echo "conference: ".$array[$i]["conference"]."<br>";
		echo "abstract: ".$array[$i]["abstract"]."<br>";
		echo "<br>";
	}*/

?>
