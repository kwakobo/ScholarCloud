function readJSON(file) {
	var request = new XMLHttpRequest();
	request.open('GET', file, false);
	request.send(null);
	if (request.status == 200)
		return request.responseText;
}


function getParameterByName(name, url) {
	if (!url) {
		url = window.location.href;
	}
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}
function clicked_word(word)
{
	localStorage.word_chosen = word;
	window.location = "authorlist.html";
}

function search(data){
	//TO DO
	// data is the returned response from search.php
	console.log(data);
	var json_data = JSON.parse(data);
	localStorage.articles = data;
	if(json_data.length == 0)
	{
		alert("Author not found");
		return;
	}
	var elem = document.getElementById("myBar");
	var width = 40;
	elem.style.width = width + '%';
	elem.innerHTML = width * 1  + '%';
	//40 = 4 seconds 
	var id = setInterval(frame, 40);
	function frame() {
		if (width >= 100) {
			clearInterval(id);
		} else {
			width++; 
			elem.style.width = width + '%';
			elem.innerHTML = width * 1  + '%';
		}
	}
	//console.log(json_data[0]['authors'] + " " + json_data.length)
	var raw_words_from_doc = "";
	for(var i = 0; i < json_data.length; i++)
	{
		raw_words_from_doc += json_data[i]['text'];
	}
	var wordfreq = WordFreq({
		workerUrl: "include/wordfreq.worker.js",
		stopWords: true
	});
	wordfreq.process(raw_words_from_doc, function(list) {
		//console.log(list);
		var cloud = WordCloud(document.getElementById('my_canvas'), {
			list: list,
			gridSize: 0,
			weightFactor: 1/list.length*1000*540/960,
			backgroundColor: "white",
			maxRotation: 0,
			minRotation: 0,
			drawOutOfBound: false,
			click: function(item, dimension, event) {
				clicked_word(item[0]);
				//console.log(item);
			}
		});
		//console.log(list.length + " " + JSON.stringify(list));
	});

	document.title = "Scholar Cloud - " + document.getElementById('au').value;
}

function submit (event){
	addToPreviousSearches(document.getElementById('au').value);
	event.preventDefault();
	$.ajax({
		url:'db/search.php',
		type: 'get',
		data: $('#search_form').serialize(),
		success: function(data) {
			// yeah idk
			search(data);
		}
	});
}

function addToPreviousSearches(query){
	if(localStorage.getItem('previousSearches') == undefined){
		window.previousSearches.push(query.trim());
		localStorage.setItem('previousSearches',JSON.stringify(window.previousSearches))
	} else {
		window.previousSearches = JSON.parse(localStorage.getItem('previousSearches'));
		if(jQuery.inArray(query.trim(), window.previousSearches) === -1){
			window.previousSearches.push(query.trim());
			localStorage.setItem('previousSearches',JSON.stringify(window.previousSearches));
		}
	}
}