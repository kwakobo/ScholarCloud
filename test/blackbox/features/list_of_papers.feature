Feature: List of papers
	In order to have a list of papers
	As a user
	I need to see a list of papers
	
Scenario: List of papers should be visible
	Given I am on the list of papers web page
	Then list of papers should be visible

Scenario: Each paper should have a download link
	Given I am on the list of papers web page
	Then each paper should have a download link from the ACM and IEEE digital library

Scenario: Each paper should have a link to access its bibtex
	Given I am on the list of papers web page
	Then each paper should have a link to access its bibtex from the ACM and IEEE digital library