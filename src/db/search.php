<?php
	include_once 'documentparser.php';
	include_once 'ACM_Parser.php';
	include_once 'ieee_api.php';

	$parser = new ACMParser();
	$acm = $parser->parse($_GET["au"], $_GET["hc"]);
	$ieee = get($_GET["au"], $_GET["hc"]);

	$docparser = new DocumentParser($acm);

	$output = array_merge_recursive($docparser->parseDocuments(), $ieee);

	echo json_encode($output);
?>