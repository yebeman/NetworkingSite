<?php

include_once "cnncttoDataBaseofyachattwbsght.php";

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
$html .= '<li class="hide" style="padding-bottom:10px;padding-top:1px;">';
$html .= '<a onclick="urlString">';
$html .= '<img align="left" style=" border:none; padding:2px 5px 0px 0px;" height="25px" width="25px" src="picString"  />';
$html .= '<h3 style="margin-top:5px;">nameString</h3>';
$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = $_POST['query'];
//$search_string = $tutorial_db->real_escape_string($search_string);

// Check Length More Than One Character
	// Build Query
	//$query = 'select * from `'.$search_string.'` WHERE status LIKE "%1%"';
	$query = 'select * from `friendsrlsp` INNER JOIN `members` ON friendsrlsp.friend2=members.id WHERE friend1='.$search_string.' AND status=1';
	
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
			$display_url = 'crtCB(\''.$display_function .'\')';
			
			
			
			$display_pic =  $result["profilePic"];
			// Insert Name
			$output = str_replace('nameString', $display_name, $html);

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
		$output = str_replace('nameString', 'No Freinds online', $output);
		$output = str_replace('picString', "http://localhost/yc/images/noResult.jpg", $output);

		// Output
		echo($output);
	}

?>