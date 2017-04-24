Feature: abstract
	In order to have an abstract for a paper
	As a user
	I need to see an abstract

Scenario: Title of paper should be clickable
	Given I am on the list of papers web page
	Then the title of a paper should be clickable
	
Scenario: Click on title should show abstract
	Given I am on the list of papers web page
	When I click on a paper's title
	Then I should see an abstract for the title clicked

Scenario: Abstract is highlighted
	Given I am on the abstract web page
	Then the word clicked from the word cloud should be highlighted in the abstract

Scenario: Abstract PDF is highlighted
	Given I on the abstract webpage
	When I click download abstract PDF
	Then I should get a download back with words highlighted