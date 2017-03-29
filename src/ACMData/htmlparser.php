<?php

include_once 'parser.php';
include 'Html2Text.php';
include_once 'document.php';

class HtmlParser implements Parser
{
	public function parse($author, $title, $resource)
	{
		$html = new \Html2Text\Html2Text(file_get_contents($resource));
		$document = $html->getText();
		return new Document($author, $title, $document);
	}
}
?>