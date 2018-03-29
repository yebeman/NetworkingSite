<?PHP
include_once "cnncttoDataBaseofyachattwbsght.php";

if (isset($_COOKIE['em']) && isset($_COOKIE['sub'])) {
  
   
   $emailAddress=$_COOKIE["em"];
   $password=$_COOKIE["sub"];
         
   
    $sql = mysql_query("SELECT * FROM `members` WHERE  emailAddressE='$emailAddress' AND password='$password'"); 
	$row = mysql_fetch_array($sql);

	$pages =$row["backGI"];
	
	echo $pages;
  }

?>