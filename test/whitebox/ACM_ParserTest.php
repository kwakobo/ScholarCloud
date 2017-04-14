<?php
	use PHPUnit\Framework\TestCase;
	require './../../src/db/acm_api.php';

	final class ACMParserTest extends TestCase
	{
		public function testParse()
		{
			$parser = new ACM_API();
			$output = [];
			$output[0]['authors'] = "William G. J. Halfond";
			$output[0]['title'] = "Web application modeling for testing and analysis";
			$output[0]['article'] = "http://dl.acm.org/ft_gateway.cfm?id=1496657";
			$output[0]['publication_type'] = "PDF";
			$output[0]['bibtex'] = "http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=1496657";

			$parse = $parser->get_acm("halfond", 1);

			$this->assertTrue(trim($parse[0]['authors']) == trim($output[0]['authors']));
			$this->assertTrue(trim($parse[0]['title']) == trim($output[0]['title']));
			$this->assertTrue(trim($parse[0]['article']) == trim($output[0]['article']));
			$this->assertTrue(trim($parse[0]['publication_type']) == trim($output[0]['publication_type']));
			$this->assertTrue(trim(substr($parse[0]['bibtex'],0,strpos(strtolower($parse[0]['bibtex']), '?id='))) == trim(substr($output[0]['bibtex'],0,strpos(strtolower($output[0]['bibtex']), '?id='))));
		}

		public function testACMDatabaseGetsAbsctract()
		{

		}

		public function testACMDatabaseGetsConferenceName()
		{

		}

		public function testACMDatabaseGetsPDF()
		{
			$parser = new ACM_API();
		 $output = [];
		 $output[0]['authors'] = "William G. J. Halfond";
		 $output[0]['title'] = "Web application modeling for testing and analysis";
		 $output[0]['article'] = "http://dl.acm.org/ft_gateway.cfm?id=1496657";
		 $output[0]['publication_type'] = "PDF";
		 $output[0]['bibtex'] = "http://dl.acm.org/exportformats.cfm?expformat=bibtex&id=1496657";

		 $parse = $parser->get_acm("halfond", 1);

		 $this->assertTrue(trim($parse[0]['authors']) == trim($output[0]['authors']));
		 $this->assertTrue(trim($parse[0]['title']) == trim($output[0]['title']));
		 $this->assertTrue(trim($parse[0]['article']) == trim($output[0]['article']));
		 $this->assertTrue(trim($parse[0]['publication_type']) == trim($output[0]['publication_type']));
		 $this->assertTrue(trim(substr($parse[0]['bibtex'],0,strpos(strtolower($parse[0]['bibtex']), '?id='))) == trim(substr($output[0]['bibtex'],0,strpos(strtolower($output[0]['bibtex']), '?id='))));	
		}
	}
?>
