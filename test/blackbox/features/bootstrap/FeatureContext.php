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
	
	/**
	 * @Given /^I am on the list of papers web page$/
	 */
	public function iAmOnTheListOfPapersWebPage2()
	{
		iAmOnTheListOfPapersWebPage();
	}

	/**
	 * @Then /^the title of a paper should be clickable$/
	 */
	public function theTitleOfAPaperShouldBeClickable()
	{
		
	}

	/**
	 * @When /^I click on a paper\'s title$/
	 */
	public function iClickOnAPaperSTitle()
	{
		
	}

	/**
	 * @Then /^I should see an abstract for the title clicked$/
	 */
	public function iShouldSeeAnAbstractForTheTitleClicked()
	{
		
	}

	/**
	 * @Given /^I am on the abstract web page$/
	 */
	public function iAmOnTheAbstractWebPage()
	{
		
	}

	/**
	 * @Then /^the word clicked from the word cloud should be highlighted in the abstract$/
	 */
	public function theWordClickedFromTheWordCloudShouldBeHighlightedInTheAbstract()
	{
		
	}

	/**
	 * @Then /^the conference name for a paper should be clickable$/
	 */
	public function theConferenceNameForAPaperShouldBeClickable()
	{
		
	}

	/**
	 * @When /^I click on a conference name for a paper$/
	 */
	public function iClickOnAConferenceNameForAPaper()
	{
		
	}

	/**
	 * @Then /^a new word cloud should be generated based on all papers from the conference clicked$/
	 */
	public function aNewWordCloudShouldBeGeneratedBasedOnAllPapersFromTheConferenceClicked()
	{
		
	}

	/**
	 * @When /^I click on the PDF button$/
	 */
	public function iClickOnThePdfButton()
	{
		
	}

	/**
	 * @Then /^a list of papers should be downloaded as PDF$/
	 */
	public function aListOfPapersShouldBeDownloadedAsPdf()
	{
		
	}

	/**
	 * @When /^I click on the plain text button$/
	 */
	public function iClickOnThePlainTextButton()
	{
		
	}

	/**
	 * @Then /^a list of papers should be downloaded as plain text$/
	 */
	public function aListOfPapersShouldBeDownloadedAsPlainText()
	{
		
	}

	/**
	 * @Given /^I am on the list of papers page$/
	 */
	public function iAmOnTheListOfPapersPage()
	{
		
	}

	/**
	 * @Then /^I should see frequency of the word clicked for each paper$/
	 */
	public function iShouldSeeFrequencyOfTheWordClickedForEachPaper()
	{
		
	}

	/**
	 * @Given /^I am on the word cloud web page and a word cloud has been generated$/
	 */
	public function iAmOnTheWordCloudWebPageAndAWordCloudHasBeenGenerated()
	{
		
	}

	/**
	 * @When /^I click download button$/
	 */
	public function iClickDownloadButton()
	{
		
	}

	/**
	 * @Then /^the image of the word cloud should be downloaded$/
	 */
	public function theImageOfTheWordCloudShouldBeDownloaded()
	{
		
	}

	/**
	 * @Then /^an author in the author list for a paper should be clickable$/
	 */
	public function anAuthorInTheAuthorListForAPaperShouldBeClickable()
	{
		
	}

	/**
	 * @When /^I click on an author in the author list$/
	 */
	public function iClickOnAnAuthorInTheAuthorList()
	{
		
	}

	/**
	 * @Then /^a new word cloud should be generated with that author\'s papers$/
	 */
	public function aNewWordCloudShouldBeGeneratedWithThatAuthorSPapers()
	{
		
	}

	/**
	 * @Given /^I am on the initial search page$/
	 */
	public function iAmOnTheInitialSearchPage()
	{
		
	}

	/**
	 * @When /^I click on the text box$/
	 */
	public function iClickOnTheTextBox()
	{
		
	}

	/**
	 * @Then /^I should see previously entered searches as a drop down list$/
	 */
	public function iShouldSeePreviouslyEnteredSearchesAsADropDownList()
	{
		
	}

	/**
	 * @Given /^I clicked the search button on the search page$/
	 */
	public function iClickedTheSearchButtonOnTheSearchPage()
	{
		
	}

	/**
	 * @Then /^the status bar should be rectangular$/
	 */
	public function theStatusBarShouldBeRectangular()
	{
		
	}

	/**
	 * @Then /^the status bar should load$/
	 */
	public function theStatusBarShouldLoad()
	{
		
	}

	/**
	 * @Given /^that I am on the list of papers web page$/
	 */
	public function thatIAmOnTheListOfPapersWebPage()
	{
		
	}

	/**
	 * @Then /^I should be able to click on a subset of papers$/
	 */
	public function iShouldBeAbleToClickOnASubsetOfPapers()
	{
		
	}

	/**
	 * @Given /^that I am on the list of papers web page and a subset of papers are selected$/
	 */
	public function thatIAmOnTheListOfPapersWebPageAndASubsetOfPapersAreSelected()
	{
		
	}

	/**
	 * @When /^I click generate button$/
	 */
	public function iClickGenerateButton()
	{
		
	}

	/**
	 * @Then /^a new word cloud with the papers selected should be generated$/
	 */
	public function aNewWordCloudWithThePapersSelectedShouldBeGenerated()
	{
		
	}
}