function parse_authors(authors)
{
	return authors.split(';  ');
}
function word_freq(sentence, word)
{
	word = word.toLowerCase();
	var counter = 0;
	var text = sentence;
	var array = [];
	var index = -1;

	// replace is from wordfreq.worker.js
	text = text
		.replace(/\.+/g, '.') // replace multiple full stops
		.replace(/(.{3,})\.$/g, '$1') // replace single trailing stop
		.replace(/n[\'’]t\b/ig, '') // get rid of ~n't
		.replace(/[\'’](s|ll|d|ve)?\b/ig, '') // get rid of ’ and '
		.toLowerCase();

	do {
		index = text.indexOf(word, index + 1);
		if (index != -1) {
			array[counter++] = index;
			//i = index;
		}
	} while (index != -1);
	return counter;
}
function open_url(url) {
	var win = window.open(url, '_blank');
	win.focus();
}
function open_urlTest(url) {
	return "www."+url+".com";
}