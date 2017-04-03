<?php
include_once 'parser.php';
include_once 'document.php';
include_once 'htmlparser.php';
include_once 'documentparser.php';
include_once 'xpdfparser.php';
include_once 'txtparser.php';


class DocumentParser
{
	private $data;
	private $parsers;

	function __construct($data)
	{
		$this->data = $data;
		$this->parsers = array(
			'PDF' => new XPdfParser(),
			'HTML' => new HtmlParser(),
			'TEXT' => new TxtParser()
		);
	}

	public function parseDocuments()
	{
		if (is_null($this->data)) return null;

		$documents = array();
		foreach($this->data as $elem)
		{
			$document = $this->parsers[$elem['publication_type']]->parse($elem['title'], $elem['authors'], $elem['article'], $elem['bibtex']);
			array_push($documents, $document);
		}

		$this->writeToJSON($documents);
		return $documents;
	}

	private function writeToJSON($documents)
	{
		$fp = fopen('documents.json', 'w');
		fwrite($fp, json_encode($documents));
		fclose($fp);
	}

}
?>