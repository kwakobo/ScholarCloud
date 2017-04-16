<?php
	function sql_get($type, $doi)
	{
		$db = new SQLite3('articles.db');
		$results = $db->query("SELECT text, abstract
								FROM article
								WHERE database = '$type'
								AND doi = '$doi';");

		if($row = $results->fetchArray(SQLITE3_ASSOC))
		{
			$article_data = array();
			$article_data['text'] = $row['text'];
			$article_data['abstract'] = $row['abstract'];
			return $article_data;
		}
		else
			return false;
	}

	function sql_add($type, $doi, $text, $abstract)
	{
		$db = new SQLite3('articles.db');
		$db->query("INSERT INTO article (database, doi, text, abstract)
					VALUES ('{$type}', '{$doi}', '{$text}', '{$abstract}');");
	}
?>