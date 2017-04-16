<?php
class ACM_API
{
	private function get_response($url_top_x_search) {
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

	private function createArticleArray($json, $top, $url_bibtex, $is_conference_mode)
	{
		$json_articles = $json['message']['items'];

		$articles = array();
		if (count($json_articles) < $top) {
			$top = count($json_articles);
		}

		for ($i=0; $i<$top; $i++) {
			$title = $json_articles[$i]['title'][0];
			$article_num = $this->get_article_num($json_articles[$i]['DOI']);
			$authors = $this->get_authors($json_articles[$i]['author']);
			$pdf = "http://dl.acm.org/ft_gateway.cfm?id=".$article_num;
			$bibtex = $url_bibtex.$article_num;
			//$abstract = $this->get_abstract("http://dl.acm.org/citation.cfm?id=".$article_num);
			$conference = $json_articles[$i]['event']['name'];

			$article_elem = array();
			$article_elem["title"] = $title;
			$article_elem["arnumber"] = $article_num;
			$article_elem["doi"] = $json_articles[$i]['DOI'];
			$article_elem["authors"] = $authors;
			$article_elem["article"] = $pdf;
			$article_elem["bibtex"] = $bibtex;
			$article_elem["publication_type"] = "PDF";
			//$article_elem["abstract"] = $abstract;
			$article_elem["conference"] = $conference;

			array_push($articles, $article_elem);
		}
		return $articles;
	}

	// INPUT: "10.1145/1496653.1496657"
	// OUTPUT: "1496657"
	private function get_article_num($doi)
	{
		return explode(".", $doi)[2];
	}

	/* INPUT: author": [
							{
								"given": "William G. J.",
								"family": "Halfond",
								"affiliation": [ ]
							},
							{
								"given": "Alessandro",
								"family": "Orso",
								"affiliation": [ ]
							}
						]*/
	// OUTPUT: "William G. J. Halfond, Alessandro Orso"
	private function get_authors($authors)
	{
		$author_single_string = "";

		$size = count($authors);
		for($i = 0; $i < $size; $i++)
		{
			$author_single_string = $author_single_string.$authors[$i]['given'].' '.$authors[$i]['family'];

			// add commas between names;
			if($i != $size - 1)
				$author_single_string = $author_single_string.";  ";
		}

		return $author_single_string;
	}

	// INPUT: http://dl.acm.org/citation.cfm?id=1496657
	// OUTPUT: The goal of my work is to improve quality assurance techniques for web applications. I will develop automated techniques for modeling web applications and use these models to improve testing and analysis of web applications.
	public function get_abstract($url)
	{
		// page must be single page view
		$url = $url."&preflayout=flat";
		$abstract_id =  " <div style=\"display:inline\">";
		$abstract_id_end = "</div>";
		$html_file = file_get_contents($url);
		if(!$html_file)
			return "";

		$html_dom_doc = new DOMDocument();
		libxml_use_internal_errors(true);
		$html_dom_doc->loadHTML($html_file);

		// delete everything before abstract
		$precut = substr(strstr($html_file, $abstract_id), strlen($abstract_id));

		// delete everything after abstract
		$postcut = strstr($precut, $abstract_id_end, true);

		// delete remaining html tags
		$abstract = strip_tags($postcut);
		return $abstract;
	}

	function get_acm($author, $hc, $is_conference_mode)
	{
		$api_main_url = "http://api.crossref.org/members/320/works?";
		$url_search = $api_main_url."query=".$author."&rows=".$hc;
		$url_search = str_replace ( ' ', '%20', $url_search);
		$url_bibtex = "http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=";

		$response = json_decode($this->get_response($url_search), true);

		$articles = $this->createArticleArray($response, $hc, $url_bibtex, $is_conference_mode);
		
		return $articles;
	}
}
?>