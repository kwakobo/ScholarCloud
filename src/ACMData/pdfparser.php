<?php
 
// Include Composer autoloader if not already done.
include 'vendor/autoload.php';
include_once 'parser.php';
include_once 'document.php';

class PdfParser implements Parser
{
    function __construct()
    {
		$this->parser = new \Smalot\PdfParser\Parser();
    }

    public function parse($author, $title, $resource)
    {	
    	$filename = $author."_".$title.".pdf";
    	file_put_contents($filename, fopen($resource, 'r'));
    	
    	//parse PDF and delete tmp file
    	$pdf = $this->parser->parseFile($filename);
 		$text = $pdf->getText();
 		unlink($filename);

 		echo $text;
		return new Document($author, $title, $document);
    }
}

?>