<?php
include 'parser.php';
include 'document.php';
include 'htmlparser.php';
include 'documentparser.php';
include 'pdfparser.php';
include 'htmlparser.php';


class DocumentParser
{
	private $data;	
	function __construct($data)
	{
		$this->data = $data;
		$this->parseData();
	}

	function parseData()
	{
		for($this->data as $elem)
		{
			
		}
	}

}
?>