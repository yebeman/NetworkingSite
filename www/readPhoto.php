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
$currUser=12;//
// Define Output HTML Formating
$html = '';
$html .= '<li  style="padding-bottom:5px;"class="result" >';
$html .= '<a target="_blank" href="urlString">';
$html .= '<img align="left" style=" border:none; padding:0px 5px 0px 0px;" height="40px" width="40px" src="picString" alt="yebeman" />';
$html .= '<h4 id="userName">nameString time</h4>';
$html .= '<h3>functionString</h3>';
$html .= '<h4  style="color:#06C;" class="commentB" onclick="javascript:postCmt();">Post</h4>';
$html .= '</a>';
$html .= '</li>';

$likeI="<br><span style='padding:0px 7px'></span>";
$timeA="<a style='float:right;'>2h ago</a>";
//
//
// Get Search <a href="../lightbox/img/close.png" style="color:green;">like</a>
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
			$display_function =  "the the the the the the the";//$result['emailAddress'];
			$display_name =  $result['userName'];
			//
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
			// add time
			$output = str_replace('time', $timeA, $output);
			// change to like
			$output = str_replace('Post', $likeI, $output);
			// Output 
			echo($output);
		}
	}
			$sql = mysql_query("SELECT * FROM `members` WHERE  id='$currUser'"); 
         $row = mysql_fetch_array($sql);
         
         $display_name =$row["userName"];
		 $display_pic=$row["profilePic"];
		 $output = str_replace('functionString', "<textarea id='comment' rows='2' cols='40' autofocus='autofocus' placeholder='what do you think of this picture?'></textarea>",$html );
			
			// Insert Name
			$output = str_replace('nameString', $display_name, $output);
			// Insert URL
			$output = str_replace('urlString', 'javascript:void(0);', $output);
			// add time
			$output = str_replace('time', '', $output);
			// Insert pic
			$output = str_replace('picString', $display_pic, $output);
			// Output
			echo($output);
	
}
?>