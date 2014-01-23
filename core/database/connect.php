<?php
	require("phar:///home/mangla/Data/upcoming/neo4jphp.phar");

	use Everyman\Neo4j\Client,
	    Everyman\Neo4j\Transport,
	    Everyman\Neo4j\Node,
	    Everyman\Neo4j\Relationship;

	$connect_error = 'Sorry, we\'re experienceing connection problems';
	$host = "localhost";
	$port = 7474;
	$client = new Client(new Transport($host, $port));

	echo "Connection has been setup";
?>
