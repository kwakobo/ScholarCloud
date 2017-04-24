<?php
require('fpdf.php');

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

function set_font()
{
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',11);

	return $pdf;
}

function yellow($pdf, $word)
{
	$pdf->SetFillColor(255,255,0);
	$pdf->Cell($pdf->GetStringWidth($word),5, $word, 0, 0, 'R', true);
}

function white($pdf, $word)
{
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell($pdf->GetStringWidth($word),5, $word, 0, 0, 'R', true);
}

function createPDFWithHighlights($text, $highlight_word) {
	$pdf = set_font();
	$words = explode(" ", $text);
	$pdfString = '';
	$pageWidth = $pdf->GetPageWidth();
	foreach($words as $word) {
		if (strcasecmp($word, $highlight_word) != 0) {
			white($pdf, $word);
			white($pdf, " ");
		}
		else if (strcasecmp($word, $highlight_word) == 0) {
			yellow($pdf, $word);
			white($pdf, " ");
		}
		$currX = $pdf->GetX();
		if ($currX > $pageWidth-20) {
			$pdf->Ln();
		}
	}
	$pdf->Output();
}

function createPDFListOfPapers($word_clicked, $titles, $authors, $conferences, $frequencies, $pdfs, $bibtexs)
{
	$pdf = set_font();

	for($i=0;$i<count($titles);$i++) {
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(100,7,"Title: ".$titles[$i],0);
		$pdf->Ln();
		$pdf->Cell(50,7,"Authors: ".$authors[$i],0);
		$pdf->Ln();
		$pdf->Cell(40,7,"Conference: ".$conferences[$i],0);
		$pdf->Ln();
		$pdf->Cell(10,7,"Frequency: ".$frequencies[$i],0);
		$pdf->Ln();
		$pdf->Cell(10,7,"PDF Link: ".$pdfs[$i],0);
		$pdf->Ln();
		$pdf->Cell(10,7,"Bibtex: ".$bibtexs[$i],0);
		$pdf->Ln();
		$pdf->Ln();
	}
	$pdf->Output();
}

/*
$text = "Web applications can be easily made available to an international audience by leveraging frameworks and tools for automatic translation and localization. However, these automated changes can distort the appearance of web applications since it is challenging for developers to design their websites to accommodate the expansion and contraction of text after it is translated to another language. Existing web testing techniques do not support developers in checking for these types of problems and manually checking every page in every language can be a labor intensive and error prone task. To address this problem, we introduce an automated technique for detecting when a web page's appearance has been distorted due to internationalization efforts and identifying the HTML elements or text responsible for the observed problem. In evaluation, our approach was able to detect internationalization problems in a set of 54 web applications with high precision and recall and was able to accurately identify the underlying elements in the web pages that led to the observed problem.";
//createPDFWithHighlights($text, "web");
$word_clicked = "web";
$titles = array("Detecting and Localizing Internationalization Presentation Failures in Web Applications", "Article3", "Article4");
$authors = array("Abdulmajeed Alameer; Sonal Mahajan; William G. J. Halfond", "Halfond", "Halfond", "Halfond");
$conferences = array("2016 IEEE International Conference on Software Testing, Verification and Validation (ICST)", "IEEE2", "ACM1", "ACM2");
$frequencies = array(4,3,2,1);
$pdfs = array("http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=7515472","www.google.com","www.google.com","www.google.com");
$bibtexs = array("www.youtube.com", "www.youtube.com", "www.youtube.com", "www.youtube.com");
createPDFListOfPapers($word_clicked, $titles, $authors, $conferences, $frequencies, $pdfs, $bibtexs);
*/

?>