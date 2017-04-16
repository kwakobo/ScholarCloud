<?php
	require 'documentparser.php';
	//include_once 'ACM_Parser.php';
	require 'acm_api.php';
	require 'ieee_api.php';
	require 'sql/sql_search.php';

	$is_conference_mode = (isset($_GET['is_conf']) && $_GET['is_conf'] == "1");

	/*$parser = new ACMParser();
	$acm = $parser->parse($_GET["au"], $_GET["hc"]);*/
	$acm = new ACM_API;
	$acm_articles = $acm->get_acm($_GET["au"], $_GET["hc"], $is_conference_mode);
	$ieee = get($_GET["au"], $_GET["hc"]);

	if($is_conference_mode == false)
	{
		$acm_articles_parsed = array();
		$acm_articles_to_parse = array();

		// check sql
		foreach($acm_articles as $article)
		{
			$sql_result = sql_get('acm', $article['doi']);
			if($sql_result != false)
			{
				$article['text'] = $sql_result['text'];
				$article['abstract'] = $sql_result['abstract'];
				array_push($acm_articles_parsed, $article);
			}
			else
			{
				$article['abstract'] = $acm->get_abstract("http://dl.acm.org/citation.cfm?id=".$article['arnumber']);
				array_push($acm_articles_to_parse, $article);
			}
		}

		// parse
		$docparser = new DocumentParser($acm_articles_to_parse);
		$acm_newly_parsed = json_decode(json_encode($docparser->parseDocuments()), true);

		// add newly parsed to sql and grab abstract
		foreach ($acm_newly_parsed as $parsed_article) {
			sql_add('acm', $parsed_article['doi'], $parsed_article['text'], $parsed_article['abstract']);
		}
		$acm_parsed = array_merge_recursive($acm_newly_parsed, $acm_articles_parsed);

		$output = array_merge_recursive($acm_parsed, $ieee);
	}
	else
	{
		$output = array_merge_recursive($acm_articles, $ieee);
	}
	
	echo json_encode($output);
?>