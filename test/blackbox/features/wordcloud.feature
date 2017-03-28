Feature: word cloud
	In order to have a word cloud
	As a user
	I need to see a word cloud that matches the search criteria

Scenario: Word cloud should be visible
	Given I provided researcher's last name and top X number of papers
	When I click the search button
	Then word cloud should be visible

Scenario: Word cloud should have top X number of papers from ACM and IEEE digital library
	Given I provided researcher's last name and top X number of papers
	When I click the search button
	Then I should see a word cloud with top X number of papers from ACM and IEEE digital library

Scenario: Words on the word cloud should be clickable
	Given that a word cloud is generated
	When I click on a word in the word cloud
	Then I should be redirected to a web page with a list of papers associated with the word clicked