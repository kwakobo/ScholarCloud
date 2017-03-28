<?php 

class Document
{
	public $author;
	public $title;
	public $document;
	
	function __construct($author, $title, $document)
	{
		$this->author = $author;
		$this->title = $title;
		$this->document = $document;
	}
}

?>