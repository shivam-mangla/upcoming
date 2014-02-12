<?php

use Everyman\Neo4j\Client,
    Everyman\Neo4j\Transport,
    Everyman\Neo4j\Node,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Index;


function suggest_time($preferences){
	var_dump($preferences);

	// get events list using graph api query
	// parse the json array
	// extract time
	// ignore events which are not according to preference
	// find events which satisfy host's datetime preference
	// define an array for start time to end time in which 15 minutes will define 1 element
	// initialize array with zero
	// loop through the events and for every event increase the element value by number of attendees
	// find the time window which has minimum number of attendees and suggest that time
	// generally user time preferences will be good enough to select non-working hours for the events
	// but after some time it can be taken care of

	/** TO-DO
	 take into account the preference for events of same type
	**/
}

function get_event_list($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$result = curl_exec($ch);
	echo "<br><br><br>Result is<br>".$result;
	curl_close($ch);
	return $result;
}

?>