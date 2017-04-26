<?php

include_once 'parser.php';
include_once 'document.php';

class TxtParser implements Parser
{
	public function parse($title, $db, $doi, $authors, $article, $bibtex, $abstract, $conference)
	{
		$text = file_get_contents($article);
		
		return new Document($title, $db, $authors, $article, $bibtex, $text, $abstract, $conference);
	}
}

?>