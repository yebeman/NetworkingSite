<?php
include_once "cnncttoDataBaseofyachattwbsght.php";

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($db_host, $db_username, $db_pass, $db_name);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}

/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li  style="padding-bottom:15px;"class="result">';
$html .= '<a target="_blank" href="urlString">';
$html .= '<img align="left" style=" border:none; padding:0px 5px 0px 0px;" height="40px" width="40px" src="picString" alt="yebeman" />';
$html .= '<h3>nameString</h3>';
$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = 'SELECT * FROM members WHERE userName LIKE "%'.$search_string.'%" OR emailAddress LIKE "%'.$search_string.'%"';

	// Do Search
	$result = $tutorial_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			$display_function =  $result['emailAddress'];
			$display_name =  $result['userName'];
			$display_url = 'http://localhost/yc/'.urlencode( $result['userName']).'&lang=en';
			$display_pic =  $result['profilePic'];
			
			// Insert Function
			$output = str_replace('functionString', $display_function,$html );

			// Insert Name
			$output = str_replace('nameString', $display_name, $output);

			// Insert URL
			$output = str_replace('urlString', $display_url, $output);
			
			// Insert pic
			$output = str_replace('picString', $display_pic, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', 'No Results Found', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);
		$output = str_replace('picString', "http://localhost/yc/images/noResult.jpg", $output);

		// Output
		echo($output);
	}
}
?>