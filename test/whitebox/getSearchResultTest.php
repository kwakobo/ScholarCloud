<?php
	use PHPUnit\Framework\TestCase;
	require './../../src/db/ieee_api.php';

	class IEEESearchResultsTest extends TestCase
	{
		public function testJSONGivesXResults()
		{
			$ieee_resp = get("halfond", 1);
			$this->assertTrue(count($ieee_resp) == 1);

			$ieee_resp = get("halfond", 10);
			$this->assertTrue(count($ieee_resp) == 10);
		}

		public function testJSONGivesCorrectAuthor()
		{
			$ieee_resp = get("halfond", 2);
			$this->assertTrue(strcmp($ieee_resp[0]["authors"], "Abdulmajeed Alameer;  Sonal Mahajan;  William G. J. Halfond") == 0);
			$this->assertTrue(strcmp($ieee_resp[1]["authors"], "Abdulmajeed Alameer;  William G. J. Halfond") == 0);
		}

		public function testJSONGivesCorrectDocument()
		{
			$ieee_resp = get("halfond", 2);
			$this->assertTrue(trim($ieee_resp[0]["article"]) == trim("http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472"));
			$this->assertTrue(trim($ieee_resp[1]["article"]) == trim("http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7816457"));
		}

		public function testJSONGivesCorrectbibtext()
		{
			$ieee_resp = get("halfond", 2);
			/*$this->expectOutputString('http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7515472\n' +
									'http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7816457');
			print $ieee_resp[0]["bibtex"];
			print $ieee_resp[1]["bibtex"];*/
			$this->assertTrue(trim($ieee_resp[0]["bibtex"]) == trim("http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7515472"));
			$this->assertTrue(trim($ieee_resp[1]["bibtex"]) == trim("http://ieeexplore.ieee.org/xpl/downloadCitations?citations-format=citation-only&download-format=download-bibtex&x=0&y=0&recordIds=7816457"));
		}

		/*public function testReturnedResultIsSmallerThanSpecifiedTopNumSearch()
		{
			$ieee_resp = get("halfond", 100);
			$this->assertEquals(count($ieee_resp), 18);
		}*/
	}
?>
