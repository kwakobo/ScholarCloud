Feature: image download
	In order to have an image of the word cloud
	As a user
	I need to download the word cloud as an image

Scenario: Image is downloadable
	Given I am on the word cloud web page and a word cloud has been generated
	When I click download button
	Then the image of the word cloud should be downloaded