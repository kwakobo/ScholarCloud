<?php
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testDocumentParser()
    {
        $arr = array(array('publication_type' => 'PDF','author' => 'William G. J. Halfond', 'title' => 'Amnesia', 'link_to_publication' => 'http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#'));
        $test = new DocumentParser($arr);
        $this->assertEquals(0, $test->parseDocuments());
    }
}
?>