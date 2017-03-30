<?php
use PHPUnit\Framework\TestCase;
require './../../src/ACMData/ACM_Parser.php';

final class ACMParserTest extends TestCase
{
    public function testParse(): void
    {
      $parser = new ACMParser();
      $output = [];
      $output[0]['author'] = "Bruce Davie";
      $output[0]['title'] = "Deployment experience with differentiated services";
      $output[0]['link_to_publication'] = "http://dl.acm.org/ft_gateway.cfm?id=944598&ftid=232772&dwn=1";
      $output[0]['publication_type'] = "PDF";
      $output[0]['link_to_bibtex'] = "http://dl.acm.org/downformats.cfm?id=944598&parent_id=&expformat=bibtex&CFID=917729876&CFTOKEN=25999586";
      $this->assertEquals(
          $output,
          $parser->parse("David", 1)
      );

      $output[1]['author'] = "Bruce Davie";
      $output[1]['title'] = "SIGCOMM: a view from the chair";
      $output[1]['link_to_publication'] = "http://dl.acm.org/ft_gateway.cfm?id=1629612&ftid=608078&dwn=1";
      $output[1]['publication_type'] = "PDF";
      $output[1]['link_to_bibtex'] = "http://dl.acm.org/downformats.cfm?id=1629612&parent_id=&expformat=bibtex&CFID=917731681&CFTOKEN=37526761";

      $this->assertEquals(
          $output,
          $parser->parse("David", 2)
      );
    }
}
?>
