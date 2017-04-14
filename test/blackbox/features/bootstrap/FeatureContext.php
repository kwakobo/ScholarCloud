<?php

use Behat\Behat\Context\BehatContext,
	Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class FeatureContext extends BehatContext
{
	private $driver;
	private $host = 'http://localhost:4444/wd/hub';
	public function __construct()
	{
		// start Firefox with 5 second timeout
		$capabilities = DesiredCapabilities::firefox();
		$this->driver = RemoteWebDriver::create($this->host, $capabilities, 5000);
	}
	
	/** @AfterScenario */
	public function tearDown()
	{
		$this->driver->quit();
	}

	/**
	 * @Given /^giI am on the list of papers web page$/
	 */
	public function iAmOnTheListOfPapersWebPage()
	{
		$this->driver->get("http://localhost:8000/index.html");

		$search_input = $this->driver->findElement(WebDriverBy::id("au"));
		$search_input->sendKeys("halfond");

		$hc_input = $this->driver->findElement(WebDriverBy::id("hc"));
		$hc_input->sendKeys("1");

		$submit = $this->driver->findElement(WebDriverBy::id("submit"));

		$submit->click();

		$this->driver->wait(60, 500)->until( WebDriverExpectedCondition::titleIs('Scholar Cloud - halfond') );

		$this->driver->executeScript("clicked_word('web');");

		$this->driver->wait(60, 500)->until( WebDriverExpectedCondition::titleIs('Authors') );
	}

	/**
	 * @Then /^list of papers should be visible$/
	 */
	public function listOfPapersShouldBeVisible()
	{
		$source = $this->driver->getPageSource();

		if(strpos($source, 'bibtex') == false)
		{
			throw new Exception("Table not found\n");
		}
	}

	/**
	 * @Then /^each paper should have a download link from the ACM and IEEE digital library$/
	 */
	public function eachPaperShouldHaveADownloadLinkFromTheAcmAndIeeeDigitalLibrary()
	{
		$table = $this->driver->findElement(WebDriverBy::id("table"))->getText();


		if(strpos($table, 'application') == false)
		{
			throw new Exception("ACM not used\n");
		}
	}

	/**
	 * @Then /^each paper should have a link to access its bibtex from the ACM and IEEE digital library$/
	 */
	public function eachPaperShouldHaveALinkToAccessItsBibtexFromTheAcmAndIeeeDigitalLibrary()
	{
		$source = $this->driver->getPageSource();

		if(strpos($source, 'bibtex') == false)
		{
			throw new Exception("Table not found\n");
		}
	}

	/**
	 * @Given /^I am on "([^"]*)"$/
	 */
	public function iAmOn($arg1)
	{
		$this->driver->get($arg1);
	}

	/**
	 * @Then /^search bar should be visible$/
	 */
	public function searchBarShouldBeVisible()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("au"));

		if($search_bar === null)
		{
			throw new Exception("search_bar not found");
		}
	}

	/**
	 * @Then /^search bar should be editable$/
	 */
	public function searchBarShouldBeEditable()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("au"));

		if($search_bar->getAttribute('readonly') == true)
		{
			throw new Exception("search_bar not editable\n");
		}
	}

	/**
	 * @Then /^search button should be visible$/
	 */
	public function searchButtonShouldBeVisible()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("submit"));

		if($search_bar === null)
		{
			throw new Exception("submit not found");
		}
	}

	/**
	 * @Then /^search button should be clickable$/
	 */
	public function searchButtonShouldBeClickable()
	{
		$submit = $this->driver->findElement(WebDriverBy::id("submit"));

		if($submit->getAttribute('disabled') == true)
		{
			throw new Exception("submit not clickable\n");
		}
	}

	/**
	 * @Then /^top number bar should be visible$/
	 */
	public function topNumberBarShouldBeVisible()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("hc"));

		if($search_bar === null)
		{
			throw new Exception("hc not found");
		}
	}

	/**
	 * @Then /^top number bar should be editable$/
	 */
	public function topNumberBarShouldBeEditable()
	{
		$top_x = $this->driver->findElement(WebDriverBy::id("au"));

		if($top_x->getAttribute('readonly') == true)
		{
			throw new Exception("top_x not editable\n");
		}
	}

	/**
	 * @Given /^I provided researcher\'s last name and top X number of papers$/
	 */
	public function iProvidedResearcherSLastNameAndTopXNumberOfPapers()
	{
		$this->driver->get("http://localhost:8000/index.html");

		$search_input = $this->driver->findElement(WebDriverBy::id("au"));
		$search_input->sendKeys("halfond");

		$hc_input = $this->driver->findElement(WebDriverBy::id("hc"));
		$hc_input->sendKeys("1");
	}

	/**
	 * @When /^I click the search button$/
	 */
	public function iClickTheSearchButton()
	{
		$submit = $this->driver->findElement(WebDriverBy::id("submit"));

		$submit->click();

		$this->driver->wait(60, 500)->until( WebDriverExpectedCondition::titleIs('Scholar Cloud - halfond') );
	}

	/**
	 * @Then /^word cloud should be visible$/
	 */
	public function wordCloudShouldBeVisible()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("wordcloud"));

		if($search_bar === null)
		{
			throw new Exception("search_bar not found");
		}
	}

	/**
	 * @Then /^I should see a word cloud with top X number of papers from ACM and IEEE digital library$/
	 */
	public function iShouldSeeAWordCloudWithTopXNumberOfPapersFromAcmAndIeeeDigitalLibrary()
	{
		$search_bar = $this->driver->findElement(WebDriverBy::id("wordcloud"));

		if($search_bar === null)
		{
			throw new Exception("search_bar not found");
		}
	}

	/**
	 * @Given /^that a word cloud is generated$/
	 */
	public function thatAWordCloudIsGenerated()
	{
		$this->driver->get("http://localhost:8000/index.html");

		$search_input = $this->driver->findElement(WebDriverBy::id("au"));
		$search_input->sendKeys("halfond");

		$hc_input = $this->driver->findElement(WebDriverBy::id("hc"));
		$hc_input->sendKeys("1");

		$submit = $this->driver->findElement(WebDriverBy::id("submit"));

		$submit->click();

		$this->driver->wait(60, 500)->until( WebDriverExpectedCondition::titleIs('Scholar Cloud - halfond') );
	}

	/**
	 * @When /^I click on a word in the word cloud$/
	 */
	public function iClickOnAWordInTheWordCloud()
	{
		$this->driver->executeScript("clicked_word('web');");

		$this->driver->wait(60, 500)->until( WebDriverExpectedCondition::titleIs('Authors') );
	}

	/**
	 * @Then /^I should be redirected to a web page with a list of papers associated with the word clicked$/
	 */
	public function iShouldBeRedirectedToAWebPageWithAListOfPapersAssociatedWithTheWordClicked()
	{
		if(strpos($this->driver->getCurrentURL(), "authorlist.html") == false)
		{
			throw new Exception("Not redirected\n");
		}

	}
}
