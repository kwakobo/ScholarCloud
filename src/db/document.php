<?php 

class Document
{
	public $title;
	public $authors;
	public $article;
	public $bibtex;
	public $text;
	public $abstract;
	public $conference;
	
	function __construct($title, $authors, $article, $bibtex, $text, $abstract, $conference)
	{
		$this->title = $title;
		$this->authors = $authors;
		$this->article = $article;
		$this->bibtex = $bibtex;
		$this->text = utf8_encode($text);
		$this->abstract = $abstract;
		$this->conference = $conference;
	}
}

?>