/*
*FILE | sortfunctions.js
*IMPLEMENTED BY | Bryce Roski & Jeffrey Nagel
*/

/*
*DESCRIPTION | sortEnum enumerator returns a sort order enumerator
*USAGE | 'sortEnum.ASCENDING' or 'sortEnum.DESCENDING'
*/
var sortEnum = {
	ASCENDING:1,
	DESCENDING:-1
}


/*
*DESCRIPTION | sort returns a sorted array of objects
*USAGE | sort(array of objects to sort -- at least one attribute, name of attribute to sort by, sortEnum enumerator)
*/
function sort(articles, key, order){
	articles.sort(function(a,b){
		return (a[key] > b[key]) ? 1*order : -1*order;
	});
	return articles;
}