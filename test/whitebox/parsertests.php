<?php
include(dirname(__FILE__)."/../../src/db/documentparser.php");
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testDocumentParserWithTEXT()
    {
        $arr = array(array('publication_type' => 'TEXT','authors' => 'authors', 'title' => 'title', 'article' => 'testdocument.txt', 'bibtex' => 'bibtex'));
        $dp = new DocumentParser($arr);
        $text = file_get_contents(dirname(__FILE__)."/testdocument.txt"); //expected text result
        $this->assertEquals(
        	new Document("title","authors","testdocument.txt","bibtex",$text), 
        	$dp->parseDocuments()[0]);
    }

    public function testDocumentParserWithPDF()
    {
        $arr = array(array('publication_type' => 'PDF','authors' => 'authors', 'title' => 'title', 'article' => 'http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#', 'bibtex' => 'bibtex'));
        $dp = new DocumentParser($arr);
        $text = file_get_contents(dirname(__FILE__)."/testdocument.txt"); //expected text result
        $this->assertEquals(
        	new Document("title","authors","http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#","bibtex",$text), //only works on USC wifi!!!
        	$dp->parseDocuments()[0]);
    }

    public function testDocumentParserWithHTML()
    {
        $arr = array(array('publication_type' => 'HTML','authors' => 'authors', 'title' => 'title', 'article' => 'http://xrds.acm.org/article.cfm?aid=270972', 'bibtex' => 'bibtex'));
        $dp = new DocumentParser($arr);
        $text = file_get_contents("testHTMldocument.txt"); //expected text result
        $this->assertEquals(
        	new Document("title","authors","http://xrds.acm.org/article.cfm?aid=270972","bibtex",$text), 
        	$dp->parseDocuments()[0]);
    }

}
?>