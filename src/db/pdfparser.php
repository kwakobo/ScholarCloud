<?php
 
// Include Composer autoloader if not already done.
//include 'vendor/autoload.php';
include('class.pdf2text.php');
include_once 'parser.php';
include_once 'document.php';

class PdfParser implements Parser
{
    function __construct()
    {
		$this->parser = new PDF2Text();
    }

    public function parse($title, $db, $authors, $article, $bibtex)
    {	
    	$filename = "tmp.pdf";
    	file_put_contents($filename, fopen($article, 'r'));
    	
    	//parse PDF
    	$this->parser->setFilename(dirname(__FILE__).'/tmp.pdf');
		$this->parser->decodePDF(); 
 		$text = $this->parser->output();
 		
 		//unlink pdf file
 		unlink($filename);

 		echo $text;

		return new Document($title, $db, $authors, $article, $bibtex, $text);
    }
}

?>