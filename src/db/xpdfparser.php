<?php
 
// Include Composer autoloader if not already done.
//include 'vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';
include_once 'parser.php';
include_once 'document.php';

use Html2Text\Html2Text;

class XPdfParser implements Parser
{
    function __construct()
    {
		$this->parser = XPDF\PdfToText::create();
    }

    function getPDFURL($url){
        $cookiejar = "cookie.txt";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0');
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true );
        //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar );
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar );

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function parse($title, $db, $doi, $authors, $article, $bibtex, $abstract, $conference)
    {
    	$filename = "tmp.pdf";
    	$file = file_put_contents($filename, $this->getPDFURL($article));
        if(!$file)
            return "";
    	
    	//parse PDF
        try {
            $raw_text = $this->parser->getText($filename);
        } catch (Exception $e)
        {
            $raw_text = "PDF not found";
        }

        $text = preg_replace("/[^A-Za-z ]/", '', $raw_text);
    	//$text = $this->parser->getText('tmp.pdf');
 		
 		//unlink pdf file
 		unlink($filename);

		return new Document($title, $db, $doi, $authors, $article, $bibtex, $text, $abstract, $conference);
    }
}