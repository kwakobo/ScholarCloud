<?php
include(dirname(__FILE__)."/../documentparser.php");
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testDocumentParser()
    {
        $arr = array(array('publication_type' => 'PDF','authors' => '2', 'title' => '1', 'article' => 'http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#', 'bibtex' => '4'));
        $dp = new DocumentParser($arr);
        $text = file_get_contents("testdocument.txt");
        $this->assertEquals(
        	new Document("1","2","http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#","4",$text), 
        	$dp->parseDocuments()[0]);
    }

}
?>