<?php

/**
 * get_time_difference
 *
 * @param   string  start time
 * @param   string  finish time
 * @return  int     time difference in minutes, rounded up
 */
function get_time_difference($start, $finish)
{
        return ceil(abs((strtotime($finish) - strtotime($start)) / 60));
}


function protect_page(){
	if(logged_in() == false){
		header('Location: index.php');
		exit();
	}
}

function logged_in_redirect(){
	if(logged_in() == true){
		header('Location: index.php');
		exit();
	}
}

function array_sanitize(&$item){
	// $item = mysql_real_escape_string($item);
	//it'll now sanitize the string
}

function sanitize($data){
	// return mysql_real_escape_string($data);
	//it'll now sanitize the string
}

function output_errors($errors){
	/*
	$output = array();
	foreach ($errors as $error) {
		$output[] ='<li>' . $error. '</li>' ;
	}
	return '<ul>'. implode('', $output) . '</ul>';
	*/
	return '<ul><li>'. implode('</li><li>', $errors) . '</li></ul>';
}
?>