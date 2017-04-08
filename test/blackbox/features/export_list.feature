Feature: export list
	In order to have a list of papers as PDFS and plain text
	As a user
	I need to export a list of papers as PDFs and plain text

Scenario: Export list as PDF
	Given I am on the list of papers web page
	When I click on the PDF button
	Then a list of papers should be downloaded as PDF

Scenario: Export list as plain text
	Given I am on the list of papers web page
	When I click on the plain text button
	Then a list of papers should be downloaded as plain text