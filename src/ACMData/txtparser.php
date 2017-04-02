<?php

include_once 'parser.php';
include_once 'document.php';

class TxtParser implements Parser
{
	public function parse($title, $authors, $article, $bibtex)
	{
		$text = file_get_contents($article);
		
		return new Document($title, $authors, $article, $bibtex, $text);
	}
}

?>