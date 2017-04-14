<?php
	require("pdf_plain_text_converter/export_converter.php");

	$word_clicked = $_POST['word_clicked'];
	$titles_array = explode(",",$_POST['titles']);
	$authors = explode(",",$_POST['authors']);
	$conferences = explode(",",$_POST['conferences']);
	$frequencies = explode(",",$_POST['frequencies']);
	$pdfs = explode(",",$_POST['pdfs']);
	$bibtexs = explode(",",$_POST['bibtexs']);

	if($_GET['form'] === "pdf")
	{
		createPDFListOfPapers($word_clicked, $titles_array, $authors, $conferences, $frequencies, $pdfs, $bibtexs);
	}
	else if($_GET['form'] === "txt")
	{
		download_plain_text($word_clicked, $titles_array, $authors, $conferences, $frequencies, $pdfs, $bibtexs);
	}
?>