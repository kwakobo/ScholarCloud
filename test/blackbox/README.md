## Black Box Testing
### Introduction
```
Files
behat/bin/behat				- Behat executable
selenium-server-standalone-3.2.0.jar	- selenium server
```
### How to run black box tests
```
[blackbox] $ php -S localhost:80
[blackbox] $ java -jar selenium-server-standalone-3.2.0.jar
[blackbox] $ behat/bin/behat
```

Behat seems to run a new Firefox instance on each scenario. So it may be easier to run a particular test individually.
```
[blackbox] $ behat/bin/behat features/wordcloud.feature
```
