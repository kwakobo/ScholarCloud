<?php
include_once 'documentparser.php';
include_once 'ACM_Parser.php';

$parser = new ACMParser();
$output = $parser->parse("David", 7);

$docparser = new DocumentParser($output);

echo $docparser->parseDocuments();



?>
