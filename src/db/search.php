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

	$articles = array_merge_recursive($ieee, $acm_articles);

	if($is_conference_mode == false)
	{
		$articles_parsed = array();
		$articles_to_parse = array();

		// check sql
		foreach($articles as $article)
		{
			$sql_result = @sql_get($article['db'], $article['doi']);
			if($sql_result != false)
			{
				$article['text'] = $sql_result['text'];

				if($article['db'] == "acm")
					$article['abstract'] = $sql_result['abstract'];
				array_push($articles_parsed, $article);
			}
			else
			{
				if($article['db'] == "acm")
					$article['abstract'] = $acm->get_abstract("http://dl.acm.org/citation.cfm?id=".$article['arnumber']);
				array_push($articles_to_parse, $article);
			}
		}

		// parse
		$docparser = new DocumentParser($articles_to_parse);
		$newly_parsed = json_decode(json_encode($docparser->parseDocuments()), true);
		//var_dump($newly_parsed);

		// add newly parsed to sql and grab abstract
		foreach ($newly_parsed as $parsed_article) {
			@sql_add($parsed_article['db'], $parsed_article['doi'], $parsed_article['text'], $parsed_article['abstract']);
		}
		if(empty($newly_parsed))
			$output = $articles_parsed;
		else if(empty($articles_parsed))
			$output = $newly_parsed;
		else
			$output = array_merge_recursive($newly_parsed, $articles_parsed);

		//$output = array_merge_recursive($acm_parsed, $ieee);
	}
	else
	{
		$output = array_merge_recursive($acm_articles, $ieee);
	}
	
	echo json_encode($output);
?>