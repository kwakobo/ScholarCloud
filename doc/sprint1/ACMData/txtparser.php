<?php

include 'parser.php';
include 'document.php';

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