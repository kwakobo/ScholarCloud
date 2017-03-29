<?php

include_once 'parser.php';
include_once 'document.php';

class TxtParser implements Parser
{
	public function parse($author, $title, $resource)
	{
		$document = file_get_contents($resource);
		echo $document;
		return new Document($author, $title, $document);
	}
}

?>