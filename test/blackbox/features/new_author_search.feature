Feature: new author search
	In order to generate a new author search for a paper
	As a user
	I need to see a list of authors for a paper

Scenario: Author should be clickable
	Given I am on the list of papers web page
	Then an author in the author list for a paper should be clickable
	
Scenario: Click on author generates new word cloud
	Given I am on the list of papers web page
	When I click on an author in the author list
	Then a new word cloud should be generated with that author's papers
	