modification:

a lava flow refactor was performed on index.html. index.html contained dead code,
which merely displayed search.html by proxy in an iframe. index.html was refactored
to contain the former contents of search.html, which is now obsolete. 

purpose:

This refactor
eliminates dead code and helps consolidate files due to unneccessary separation