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
		if(a[key] > b[key]){
			return 1*order
		}else if (a[key] < b[key]){
			return -1*order;
		}else{
			return 0;
		}
	});
	return articles;
}