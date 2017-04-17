<?php
	require("pdf_plain_text_converter/export_converter.php");

	if($_GET['form'] == "fulltext")
	{
		$word_clicked = $_POST['word_clicked_full_text'];
		$fulltext = $_POST['fulltext_input'];
	}
	else
	{
		$word_clicked = $_POST['word_clicked'];
		$titles_array = explode(",",$_POST['titles']);
		$authors = explode(",",$_POST['authors']);
		$conferences = explode(",",$_POST['conferences']);
		$frequencies = explode(",",$_POST['frequencies']);
		$pdfs = explode(",",$_POST['pdfs']);
		$bibtexs = explode(",",$_POST['bibtexs']);
	}

	if($_GET['form'] === "pdf")
	{
		createPDFListOfPapers($word_clicked, $titles_array, $authors, $conferences, $frequencies, $pdfs, $bibtexs);
	}
	else if($_GET['form'] === "txt")
	{
		download_plain_text($word_clicked, $titles_array, $authors, $conferences, $frequencies, $pdfs, $bibtexs);
	}
	else if($_GET['form'] === "fulltext")
	{
		createPDFWithHighlights($fulltext, $word_clicked);
	}
?>