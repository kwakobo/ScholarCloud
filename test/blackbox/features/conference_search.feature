Feature: conference search
	In order to generate a new word cloud based on a conference
	As a user
	I need to see the conference name for a paper

Scenario: Conference name should be clickable
	Given I am on the list of papers web page
	Then the conference name for a paper should be clickable
	
Scenario: Click on conference name generates word cloud
	Given I am on the list of papers web page
	When I click on a conference name for a paper
	Then a new word cloud should be generated based on all papers from the conference clicked