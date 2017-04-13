<?php
 
// Include Composer autoloader if not already done.
//include 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
include_once 'parser.php';
include_once 'document.php';

class XPdfParser implements Parser
{
    function __construct()
    {
		$this->parser = XPDF\PdfToText::create();
    }

    public function parse($title, $authors, $article, $bibtex, $abstract, $conference)
    {
    	$filename = "tmp.pdf";
    	file_put_contents($filename, fopen($article, 'r'));
    	
    	//parse PDF
        $raw_text = $this->parser->getText($filename);
        $text = preg_replace("/[^A-Za-z ]/", '', $raw_text);
    	//$text = $this->parser->getText('tmp.pdf');
 		
 		//unlink pdf file
 		unlink($filename);

		return new Document($title, $authors, $article, $bibtex, $text, $abstract, $conference);
    }
}