<?php
include_once 'parser.php';
include_once 'document.php';
include_once 'htmlparser.php';
include_once 'documentparser.php';
include_once 'pdfparser.php';
include_once 'txtparser.php';


class DocumentParser
{
	private $data;
	private $parsers;

	function __construct($data)
	{
		$this->data = $data;
		$this->parsers = array(
		'PDF' => new PdfParser(),
		'HTML' => new HtmlParser(),
		'TEXT' => new TxtParser()
	);
		$this->parseData();
	}

	private function parseData()
	{
		$documents = array();
		foreach($this->data as $elem)
		{
			$document = $this->parsers[$elem['publication_type']]->parse($elem['author'],
				$elem['title'], $elem['link_to_publication']);
			array_push($documents, $document);
		}

		$this->writeToJSON($documents);
	}

	private function writeToJSON($documents)
	{
		$fp = fopen('documents.json', 'w');
		fwrite($fp, json_encode($documents));
		fclose($fp);
	}

}

$arr = array(array('publication_type' => 'PDF','author' => 'William G. J. Halfond', 'title' => 'An Article', 'link_to_publication' => 'http://dl.acm.org/ft_gateway.cfm?id=1101935&ftid=338180&dwn=1&#URLTOKEN#'));
$test = new DocumentParser($arr);
?>