<?php 

class Document
{
	public $title;
	public $authors;
	public $article;
	public $bibtex;
	public $text;
	
	function __construct($title, $authors, $article, $bibtex, $text)
	{
		$this->title = $title;
		$this->authors = $authors;
		$this->article = $article;
		$this->bibtex = $bibtex;
		$this->text = utf8_encode($text);
	}
}

?>