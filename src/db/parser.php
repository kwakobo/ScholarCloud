<?php

interface Parser
{
	public function parse($title, $db, $doi, $authors, $article, $bibtex, $abstract, $conference);
}
?>