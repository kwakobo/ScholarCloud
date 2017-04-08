Feature: subset search
	In order to generate a new word cloud with a subset of papers
	As a user
	I need to select a subset of papers to generate a new word cloud

Scenario: Select subset of papers
	Given that I am on the list of papers web page
	Then I should be able to click on a subset of papers

Scenario: Generate new word cloud with subset of papers
	Given that I am on the list of papers web page and a subset of papers are selected
	When I click generate button
	Then a new word cloud with the papers selected should be generated