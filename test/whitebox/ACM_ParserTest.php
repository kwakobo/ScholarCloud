<?php
use PHPUnit\Framework\TestCase;
require './../../src/db/ACM_Parser.php';

final class ACMParserTest extends TestCase
{
    public function testParse()
    {
      $parser = new ACMParser();
      $output = [];
      $output[0]['authors'] = "Bruce Davie";
      $output[0]['title'] = "Deployment experience with differentiated services";
      $output[0]['article'] = "http://dl.acm.org/ft_gateway.cfm?id=944598&ftid=232772&dwn=1";
      $output[0]['publication_type'] = "PDF";
      $output[0]['bibtex'] = "http://dl.acm.org/downformats.cfm?id=944598&parent_id=&expformat=bibtex&CFID=746525198&CFTOKEN=27921863";

      $parse = $parser->parse("David", 1);

      $this->assertTrue(trim($parse[0]['authors']) == trim($output[0]['authors']));
      $this->assertTrue(trim($parse[0]['title']) == trim($output[0]['title']));
      $this->assertTrue(trim($parse[0]['article']) == trim($output[0]['article']));
      $this->assertTrue(trim($parse[0]['publication_type']) == trim($output[0]['publication_type']));
      $this->assertTrue(trim(substr($parse[0]['bibtex'],0,strpos(strtolower($parse[0]['bibtex']), '?id='))) == trim(substr($output[0]['bibtex'],0,strpos(strtolower($output[0]['bibtex']), '?id='))));


      $output = [];
      $output[0]['authors'] = "Bruce Davie";
      $output[0]['title'] = "Deployment experience with differentiated services";
      $output[0]['article'] = "http://dl.acm.org/ft_gateway.cfm?id=944598&ftid=232772&dwn=1";
      $output[0]['publication_type'] = "PDF";
      $output[0]['bibtex'] = "http://dl.acm.org/downformats.cfm?id=944598&parent_id=&expformat=bibtex&CFID=746524322&CFTOKEN=64073858";

      $output[1]['authors'] = "Bruce Davie";
      $output[1]['title'] = "SIGCOMM: a view from the chair";
      $output[1]['article'] = "http://dl.acm.org/ft_gateway.cfm?id=1629612&ftid=608078&dwn=1";
      $output[1]['publication_type'] = "PDF";
      $output[1]['bibtex'] = "http://dl.acm.org/downformats.cfm?id=1629612&parent_id=&expformat=bibtex&CFID=746524322&CFTOKEN=64073858";


      $parse = $parser->parse("David", 2);
      $this->assertTrue(trim($parse[1]['authors']) == trim($output[1]['authors']));
      $this->assertTrue(trim($parse[1]['title']) == trim($output[1]['title']));
      $this->assertTrue(trim($parse[1]['article']) == trim($output[1]['article']));
      $this->assertTrue(trim($parse[1]['publication_type']) == trim($output[1]['publication_type']));
      $this->assertTrue(trim(substr($parse[1]['bibtex'],0,strpos(strtolower($parse[1]['bibtex']), '?id='))) == trim(substr($output[1]['bibtex'],0,strpos(strtolower($output[1]['bibtex']), '?id='))));
    }
}
?>