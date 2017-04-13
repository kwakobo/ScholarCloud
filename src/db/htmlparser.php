<?php

include_once 'parser.php';
include 'Html2Text.php';
include_once 'document.php';

class HtmlParser implements Parser
{
	public function parse($title, $authors, $article, $bibtex, $abstract, $conference)
	{
		$html = new \Html2Text\Html2Text(file_get_contents($article));
		$text = $html->getText();
		
		return new Document($title, $authors, $article, $bibtex, $text, $abstract, $conference);
	}
}

?>