<?php
// connect to your MySQL database here
include_once "cnncttoDataBaseofyachattwbsght.php";

//////////////////////////////////////////////// Log User In ///////////////////////////////////////////////////////////////////
if ($_POST['sendRequest'] == "log_user_in") {
	 // puts the username and the password in the username and password variable
     
     $emailAddress= $_POST['emailAddress'];
     $password = $_POST['password'];
	 // cheks in the mysql directory
     $sql = mysql_query("SELECT * FROM members WHERE password='$password' AND emailAddress='$emailAddress'"); 
     
     $login_check = mysql_num_rows($sql);
	 // if the program founds by that name and password then sends a "all good" data to the falsh
	 // if not then "no good"
     if($login_check > 0){ 
           print "return_msg=in_good";
     } else {
	       print "return_msg=in_notgood";
	 }
	 // I need to use mysql_query( 
	mysql_query("UPDATE members  SET lastLoginf = now() WHERE  emailAddress='$emailAddress'"); //updating users lastlogin time
	 
}

///////////////////////////////////////////// activates an account//////////////////////////////////////////////////////////////

if ($_POST['sendRequest'] == "Sign up") {

if (empty($_POST["name"])) 
        $nameErr = "Missing";
else	$username = $_POST['userName'];

	$password = $_POST['password'];
	$repassword = $_POST['rePassword'];
	$emailAddress = $_POST['emailAddress'];
	if($password==$repassword){
	
	
	
	$sql = mysql_query("INSERT INTO members ( userName, password, emailAddress,lastLogin, 
	signUpDate, profilePic) VALUES ('$username','$password','$emailAddress',now(),now(),'http://localhost/yt/profPictures/basicUser.gif')");
	 
	 
           print "return_msg=up_good";
	}else
	{//
//	print "return_msg=hahaha";
	 $errorMessage="retype your password";
	}
	
	
	 }
	
	
	

?>
