File: `src/db/search.php`

Searchs to API calls would break if the search term had a parenthesis in it. Created a remove_parenthesis() function to account for this. Test created in the `test/whitebox`testSearch.php` titled `testRemoveParenthesis`.
