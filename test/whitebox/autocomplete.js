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


(function($) {
	$('#au').autocomplete({
        source: function(request, response){
        	response($.ui.autocomplete.filter(window.previousSearches, request.term));
        }
    });
})(jQuery);