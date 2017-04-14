Feature: frequency
	In order to have a frequency of the word clicked on the list of papers web page
	As a user
	I need to see a frequency of the word clicked associated with each paper

Scenario: Frequency of words for a paper
	Given I am on the list of papers page
	Then I should see frequency of the word clicked for each paper
