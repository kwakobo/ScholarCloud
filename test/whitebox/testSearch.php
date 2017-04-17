<?php
	use PHPUnit\Framework\TestCase;
	require './../../src/db/acm_api.php';
	require './../../src/db/ieee_api.php';

	class SearchPHPTest extends TestCase
	{
		public function testSearchPHPGivesBothDatabase()
		{
			$acm = new ACM_API;
			$acm_articles = $acm->get_acm("halfond", "1", "false");
			$ieee = get("halfond", "1");

			$this->assertTrue(count($acm_articles) == 1);
			$this->assertTrue(count($ieee) == 1);
		}
	}
?>