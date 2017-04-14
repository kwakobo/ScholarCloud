Feature: status bar
	In order to have a status bar
	As a user
	I need to see a status bar

Scenario: Status bar should be rectangular
	Given I clicked the search button on the search page
	Then the status bar should be rectangular

Scenario: Status bar should load 
	Given I clicked the search button on the search page
	Then the status bar should load
