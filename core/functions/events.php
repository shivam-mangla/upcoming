<?php

function suggest_time($preferences){

	// get events list using graph api query
	var_dump($preferences);
	echo "</br></br></br>";
	$events_list = get_event_list($preferences["location"]);

	// define an array for start time to end time in which 15 minutes will define 1 element
	// divide the total time in which event is allowed in intervals of 15 minutes
	// initialize array with zero attendees
	$diff = get_time_difference($preferences["sdate"].$preferences["stime"], 
												$preferences["edate"].$preferences["etime"]);
	$array_size = $diff/15;
	$attendees = array_fill(0, $array_size, 0);
	echo "</br></br></br>array_size".$array_size."</br>";

	// parse the json array
	$json = json_decode($events_list, true);
	echo "</br></br></br>Decoded JSON";
	var_dump($json);
	echo "</br></br></br>";

	// extract time
	if (isset($json['data']) && is_array($json['data']) ) {

        $index=0;
        foreach($json['data'] as $result){
			// ignore events which are not according to preference
        	/** 
        		Issues:
        		Most of the events (39/451 for delhi events) don't have their end_time given. The algorithm rejects those events for now.
        	*/
			if(strtotime($result["start_time"]) >= strtotime($preferences["sdate"].$preferences["stime"]) 
				&& isset($result["end_time"])
				 && strtotime($result["end_time"]) <= strtotime($preferences["edate"].$preferences["etime"]))
			{
					// loop through the events and for every event increase the element value by number of attendees
					for($i=get_time_difference($result["start_time"], $preferences["sdate"].$preferences["stime"])/15;
						$i<get_time_difference($result["end_time"], $preferences["edate"].$preferences["etime"])/15;
						$i++){
						/** 
							TODO
							Has to be done more carefully.
							Get actual number of attendees of an event and don't just increase the counter by one for every event.
						**/
						$attendees[$i]++;
					}
					echo "Accepted<br/>";
        	
					echo 'Title: '.$result["name"].'<br />'.
						 'Start Time: '.$result["start_time"].'<br />'.
						 'End Time: '.$result["end_time"].'<br />'.'<br /><br />';
			}
			else
			{
        		echo "Rejected<br/>";
				unset($json['data'][$index]);
			}

			$index++;
        }

        echo "<br/>Number of filtered events: ".sizeof($json['data'])."<br/>";
	}
	else echo "\$json['results'] is not an array";


    // Look for a better algorithm later but nothing better can be thought of as of now
    for($i=0; $i<sizeof($attendees); $i++){

    	echo $attendees[$i]."  ";
    }

    echo "<br/>";
    echo str_repeat('&nbsp;', 19);

	// find the time window which has minimum number of attendees and suggest that time
    $n = sizeof($attendees);
   	$m = 8; // number_of_hours_for_which_event_will_last * 4... because 1 array element represents 15 minutes
   	$max_attendees = array_fill(0, $n-$m+1, 0);
    
   	// find maximum of 1st m elements
   	for($j=0; $j<$m; $j++)
	{
		if($max_attendees[0] < $attendees[$j]){
			$max_attendees[0] = $attendees[$j];
		}
	}

	echo $max_attendees[0]."  ";

    /**
     Look for a better algorithm later but nothing better can be thought of as of now
    */
	
	// Find maximum attendees for all windows using number of attendees per window
    // Assumption: Attendees will exclusively attend only one event
    // So, if attendees are busy in some other event even for 15 minutes then they can't attend the event being created
    // Therefore, the best time to organize an event will be the minimum of the consecutive maximums
    // i.e. the time when minimum no. of attendees are going for other events
    for($i=1; $i<sizeof($attendees)-$m+1; $i++){

    	if($max_attendees[$i-1] === $attendees[$i-1])
    	{
	    	for($j=$i; $j<$i+$m; $j++)
	    	{
	    		if($max_attendees[$i] < $attendees[$j]){
					$max_attendees[$i] = $attendees[$j];
				}
	    	}
    	}else{
    		$max_attendees[$i] = $max_attendees[$i-1];
    	}
    	echo $max_attendees[$i]."  ";
    }


	/** 
		TO-DO
		1. Generally user time preferences will be good enough to select non-working hours for the events
		but after some time it can be taken care of.
		2. Take into account the preference for events of same type
		3. In last step when finding final time window:
			Using this algorithm if say the expected duration of an event is 2 hours and there are two choices
			(i) With very few attendees for 1.5 hours (in start or in end or both.. basically they can attend most of the event but not all of it) and then many of them going in some other event before/after this event
			(ii) With minimum number of attendees if the whole duration has to be attended.
			Which one should be chosen? 
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