<?php
function GetAuthorDoc($MyArtist){

$return_arr = array();
$index = 0;

$ArtistNameArray = explode(" ",$MyArtist);
$URLArtistNameString = "";
for ($i = 0; $i < count($ArtistNameArray); $i++) {
	$URLArtistNameString .= "%252B".$ArtistNameArray[$i];
	if ($i !== count($ArtistNameArray)-1) {
		$URLArtistNameString .= "%20";
	}
}
$html = file_get_contents('http://dl.acm.org/results.cfm?query=('.$URLArtistNameString.')&within=owners.owner=HOSTED&filtered=&dte=&bfr='); //get the html returned from the following url

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

			$title = "";
			$author = "";
			$link_to_publication = "";
			$publication_type = "";

			$children = $row->childNodes;
			 foreach ($children as $child) {
				 if ($child->nodeType == 1){
				 if ( $child->getAttribute ('class') === "title") {
					 //echo "[title]{".$child->nodeValue. "}<br/>";
					 //$return_arr[$index]['title'] = $child->nodeValue;
					 $title = $child->nodeValue;
				 }
				 elseif ( $child->getAttribute ('class') === "authors")
				 {
					 //echo "[authors]{".$child->nodeValue. "}<br/>";
					 //$return_arr[$index]['author'] = $child->nodeValue;
					 //if(strpos(strtolower($docType), strtolower($MyArtist)) !== false){
					 $author = $child->nodeValue;
				 	//}
				 }
				 elseif ( $child->getAttribute ('class') === "ft")
				 {
					 $babies = $child->childNodes;
					 foreach ($babies as $baby) {
						  if ($baby->nodeType == 1){
					 			//echo "[link_to_publication]{".$baby->getAttribute('href'). "}<br/>";
								//$return_arr[$index]['link_to_publication'] = $baby->getAttribute('href');
								$link_to_publication = $baby->getAttribute('href');
								$docType = $baby->getAttribute('name');
								if (strpos(strtolower($docType), 'html') !== false) {
									//echo "[publication_type]{HTML}<br/>";
									//$return_arr[$index]['publication_type'] = "HTML";
									$publication_type = "HTML";

								}
								elseif (strpos(strtolower($docType), 'pdf') !== false) {
									//echo "[publication_type]{PDF}<br/>";
									//$return_arr[$index]['publication_type'] = "PDF";
									$publication_type = "PDF";
								}
								elseif (strpos(strtolower($docType), 'txt') !== false) {
									//echo "[publication_type]{PDF}<br/>";
									//$return_arr[$index]['publication_type'] = "PDF";
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
		 		$publication_type !== "")
		 {
			 $return_arr[$index]['title'] = $title;
 			 $return_arr[$index]['author'] = $author;
 			 $return_arr[$index]['link_to_publication'] = $link_to_publication;
 			 $return_arr[$index]['publication_type'] = $publication_type;
		 	 $index++;
	 	 }

		}
	}
	else {
		echo "pokemon_row is empty";
	}
}
else {
	echo "html is empty";
}
return $return_arr;

}

$output = GetAuthorDoc("David R. Jefferson");

for ($i = 0; $i < count($output); $i++) {
    echo "{".$output[$i]['author']."<br>";
		echo " ".$output[$i]['title']."<br>";
		echo " ".$output[$i]['link_to_publication']."<br>";
		echo " ".$output[$i]['publication_type']."}<br>";
}

?>
