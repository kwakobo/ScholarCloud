Feature: Search UI
	In order to search for a researcher
	As a user
	I need to be able to input search criteria comprised of a researcher's last name

Scenario: Search bar should be visible
	Given I am on "http://localhost:8000/"
	Then search bar should be visible

Scenario: Search bar should be editable
	Given I am on "http://localhost:8000/"
	Then search bar should be editable

Scenario: Search button should be visible
	Given I am on "http://localhost:8000/"
	Then search button should be visible

Scenario: Search button should be clickable
	Given I am on "http://localhost:8000/"
	Then search button should be clickable

Scenario: Top X number of results search criteria bar should be visible
	Given I am on "http://localhost:8000/"
	Then top number bar should be visible

Scenario: Top X number of results search criteria bar should be editable
	Given I am on "http://localhost:8000/"
	Then top number bar should be editable
