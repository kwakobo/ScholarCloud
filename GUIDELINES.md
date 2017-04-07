# Guidelines For Pair Programming

## Steps
1) Commit pair programming picture evidence
2) Commit developed test cases in PHPUnit for the parts that you are going to implement
3) Commit implementation
4) For every bug found during implementation, create a new test case
5) Look for problems in the code or something to improve upon (refactor) and state the problem or the improvement you will be making in a .md file. This **MUST** be done atleast once per pair programming session.
6) Commit the fix/improvement for #5
7) If done with specific functionality, implement tests
7) Run both black box and white box tests and commit the screenshot of the results for ALL tests

## Naming schemes for certain files and file locations

#### Pair Programming Picture
- mmddyy-name1-name2.jpg
- Example: 032717-jason-mihyun.jpg
- commit it under docs/sprint2/PairProgrammingPictures
#### Refactoring Statement
- mmddyy-refactoring.md
- commit it under docs/sprint2/Refactor
#### Running Tests
- Each pair should create a directory under the pair's names: docs/sprint2/TestEvidence/name1-name2
- mmddyy-testtype-testname.jpg
- Example: 032717-whitebox-search.jpg
- commit it under the pair's folder in docs/sprint2/TestEvidence/

## Examples of what you could fix/improve upon while refactoring (from the slides)
- God Class: one massive class that does tons of different things
- Lava flow: class with a lot of code considered dead
- Poltergeist: class with short life and very few methods in it
- Golden Hammer: class that doesn't necessarily fit the problem; class not appropriate for the solution
- Stove pipe: bunch of identical solutions at different place; different methods that do very similar tasks
- Swiss army knife: code that has tons of different functionalities; complex interface
