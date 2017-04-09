//sorting enumerator
var sortEnum = {
	ASCENDING:1,
	DESCENDING:-1
}

function sort(articles, key, order){
	articles.sort(function(a,b){
		return (a[key] > b[key]) ? 1*order : -1*order;
	});
	return articles;
}