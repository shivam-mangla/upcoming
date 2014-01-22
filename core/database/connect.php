<?php
	require("phar:///home/mangla/Data/upcoming/neo4jphp.phar");

	use Everyman\Neo4j\Client,
	    Everyman\Neo4j\Transport;

	$connect_error = 'Sorry, we\'re experienceing connection problems';
	$host = "localhost";
	$username = "username";
	$pwd = "****";
	$dbname = "test";
	$dbtable = "users";
	$port = 7474;
	$client = new Client(new Transport($host, $port));
?>
