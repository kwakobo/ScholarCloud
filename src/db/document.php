<?php 

class Document
{
	public $title;
	public $db;
	public $doi;
	public $authors;
	public $article;
	public $bibtex;
	public $text;
	public $abstract;
	public $conference;
	
	function __construct($title, $db, $doi, $authors, $article, $bibtex, $text, $abstract, $conference)
	{
		$this->title = $title;
		$this->db = $db;
		$this->doi = $doi;
		$this->authors = $authors;
		$this->article = $article;
		$this->bibtex = $bibtex;
		$this->text = utf8_encode($text);
		$this->abstract = $abstract;
		$this->conference = $conference;
	}
}

?>