<?php

/*
	$word_clicked = "web";
	$titles = array("Detecting and Localizing Internationalization Presentation Failures in Web Applications", "Article3", "Article4");
	$authors = array("Abdulmajeed Alameer; Sonal Mahajan; William G. J. Halfond", "Halfond", "Halfond", "Halfond");
	$conferences = array("2016 IEEE International Conference on Software Testing, Verification and Validation (ICST)", "IEEE2", "ACM1");
	$frequencies = array(4,3,2,1);
	$pdfs = array("http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472","www.google.com","www.google.com","www.google.com");
	$bibtexs = array("www.youtube.com", "www.youtube.com", "www.youtube.com", "www.youtube.com");
*/
	function download_plain_text($word_clicked, $titles, $authors, $conferences, $frequencies, $pdfs, $bibtexs)
	{
		$content =$word_clicked."\n\n";
		for($i=0;$i<count($titles);$i++) {
			$content .="Title: ".$titles[$i]."\n";
			$content .="Authors: ".$authors[$i]."\n";
			$content .="Conference: ".$conferences[$i]."\n";
			$content .="Frequency: ".$frequencies[$i]."\n";
			$content .="PDF Link: ".$pdfs[$i]."\n";
			$content .="Bibtex: ".$bibtexs[$i]."\n\n";
		}

		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=temp.txt");

		echo $content;
	}
?>