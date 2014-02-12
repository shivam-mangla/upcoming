<?php

function suggest_time($preferences){

	// get events list using graph api query
	var_dump($preferences);
	echo "</br></br></br>";
	$events_list = get_event_list($preferences["location"]);

	// divide the total time in which event is allowed in intervals of 15 minutes
	$diff = get_time_difference($preferences["sdate"].$preferences["stime"], 
												$preferences["edate"].$preferences["etime"]);
	echo $diff; // 100
	echo "</br></br></br>";

	// parse the json array
	$json = json_decode($events_list, true );
	echo "\n\n\n\nDecoded JSON";
	var_dump($json);
	echo "\n\n\n\n";

	// extract time
	if (isset($json['data']) && is_array($json['data']) ) {
	        foreach($json['data'] as $result) {
	              echo 'Title: ' . $result['name'] . '<br />';
	        }
	}
	else echo "\$json['results'] is not an array";

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

function get_event_list($name){

	$url = 'https://graph.facebook.com/search?q='.$name.'&type=event&distance=100&access_token='.$GLOBALS['access_token'].'';
	$url = preg_replace("/ /", "%20", $url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

?>