<?php

interface Parser
{
	public function parse($title, $doi, $authors, $article, $bibtex, $abstract, $conference);
}
?>