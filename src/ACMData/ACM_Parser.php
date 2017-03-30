<?php

class ACMParser
{

	private function getURL($MyArtist)
	{
		$return_str = "";
		$ArtistNameArray = explode(" ",$MyArtist);
		$URLArtistNameString = "";
		for ($i = 0; $i < count($ArtistNameArray); $i++) {
			$URLArtistNameString .= "%252B".$ArtistNameArray[$i];
			if ($i !== count($ArtistNameArray)-1) {
				$URLArtistNameString .= "%20";
			}
		}
		 return 'http://dl.acm.org/results.cfm?query=persons.authors.personName:('.$URLArtistNameString.')&within=owners.owner=HOSTED&filtered=&dte=&bfr=';
	}
	private function getBibTeXURL($link_to_publication_web)
	{
		$return_str = "";
		$idpos = strpos(strtolower($link_to_publication_web), 'id=');
		$CFIDpos = strpos(strtolower($link_to_publication_web), 'cfid=');
		return "http://dl.acm.org/downformats.cfm?".substr($link_to_publication_web,$idpos,$CFIDpos-$idpos-1)."&amp;parent_id=&amp;expformat=bibtex&amp;".substr($link_to_publication_web,$CFIDpos);
	}

	public function parse($MyArtist,$limit){
	$return_arr = array();
	$index = 0;
	$html = file_get_contents($this->getURL($MyArtist)); //get the html returned from the following url
	//$html = file_get_contents('http://dl.acm.org/results.cfm?query=persons%2Eauthors%2EpersonName%3A%28'.$URLArtistNameString.'%29&start=20&filtered=&within=owners%2Eowner%3DHOSTED&dte=&bfr=&srt=%5Fscore');
	$pokemon_doc = new DOMDocument();

	libxml_use_internal_errors(TRUE); //disable libxml errors

	if(!empty($html)){ //if any html is actually returned

		$pokemon_doc->loadHTML($html);
		libxml_clear_errors(); //remove errors for yucky html

		$pokemon_xpath = new DOMXPath($pokemon_doc);

		//get all the h2's with an id
		$pokemon_row = $pokemon_xpath->query('//div[@class="details"]');
		if($pokemon_row->length > 0){
			foreach($pokemon_row as $row){

				if ($index == $limit) return $return_arr;

				$title = "";
				$author = "";
				$link_to_publication = "";
				$publication_type = "";
				$link_to_publication_web = "";

				$children = $row->childNodes;
				 foreach ($children as $child) {
					 if ($child->nodeType == 1){
					 if ( $child->getAttribute ('class') === "title") {
						 $title = $child->nodeValue;

						 $babies = $child->childNodes;
						 foreach ($babies as $baby) {
							  if ($baby->nodeType == 1){
									$link_to_publication_web = "http://dl.acm.org/".$baby->getAttribute('href');
								}
							}
					 }
					 elseif ( $child->getAttribute ('class') === "authors")
					 {
						 $author = $child->nodeValue;
					 }
					 elseif ( $child->getAttribute ('class') === "ft")
					 {
						 $babies = $child->childNodes;
						 foreach ($babies as $baby) {
							  if ($baby->nodeType == 1){

									$link_to_publication = "http://dl.acm.org/".$baby->getAttribute('href');
									$docType = $baby->getAttribute('name');
									if (strpos(strtolower($docType), 'html') !== false) {
										$publication_type = "HTML";

									}
									elseif (strpos(strtolower($docType), 'pdf') !== false) {
										$publication_type = "PDF";
									}
									elseif (strpos(strtolower($docType), 'txt') !== false) {
										$publication_type = "TEXT";
									}
					 			}
					   }
					 }
				 }
			 }
			 if($title !== "" &&
			 		$author !== "" &&
			 		$link_to_publication !== "" &&
			 		$publication_type !== "" &&
					$link_to_publication_web !== "")
			 {
				 $return_arr[$index]['title'] = trim($title);
	 			 $return_arr[$index]['authors'] = trim($author);
	 			 $return_arr[$index]['article'] = trim($link_to_publication);
	 			 $return_arr[$index]['publication_type'] = trim($publication_type);
				 $return_arr[$index]['bibtex'] = trim($this->getBibTeXURL($link_to_publication_web));
			 	 $index++;
		 	 }

			}
		}
		else {
			echo "amc_row is empty";
		}
	}
	else {
		echo "html is empty";
	}
	return $return_arr;

	}
}


//$output = GetAuthorDoc("David R. Jefferson");
/*$parser = new ACMParser();
$output = $parser->parse("David", 7);

for ($i = 0; $i < count($output); $i++) {
	echo "$"."output[".$i."]['author'] = ".$output[$i]['author'].";<br>";
	echo "$"."output[".$i."]['title'] = ".$output[$i]['title'].";<br>";
	echo "$"."output[".$i."]['link_to_publication'] = ".$output[$i]['link_to_publication'].";<br>";
	echo "$"."output[".$i."]['publication_type'] = ".$output[$i]['publication_type'].";<br>";
	echo "$"."output[".$i."]['link_to_bibtex'] = ".$output[$i]['link_to_bibtex'].";<br>";
	echo "<br>";
}*/

?>
