<?PHP
include_once "cnncttoDataBaseofyachattwbsght.php";

if (isset($_COOKIE['em']) && isset($_COOKIE['sub'])) {
  
   
   $emailAddress=$_COOKIE["em"];
   $password=$_COOKIE["sub"];
   
    $sql = mysql_query("SELECT * FROM `members` WHERE  emailAddressE='$emailAddress' AND password='$password'"); 
	$row = mysql_fetch_array($sql);

	$pages =$row["contents"];
	$pages = explode("|s|", $pages);
  }
else
 { $pages=array("about.php,About","index.php,Home","contact.php,Contact");}
   for($x=0;$x<count($pages);$x++)
   echo $pages[$x]."|S|";
?>