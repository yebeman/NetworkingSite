<?PHP
include_once "cnncttoDataBaseofyachattwbsght.php";

$Info=$_POST['Info'];
$tableNo=$_POST['tableNo'];


 
$emailAddress='d3dd44d9d83a6ae8c0c249ce90510757';//$_COOKIE["em"];
$password='a195bc1c245976ac857b05f641d7ac88';//$_COOKIE["sub"];
         
$sql = mysql_query("SELECT * FROM `members` WHERE  emailAddressE='$emailAddress' AND password='$password'"); 
$row = mysql_fetch_array($sql);
 $pages =$row["profileInfo"];
   $pagesT = explode("|s|", $pages);
   $pagesT1 = explode("|xy|", $pagesT[$tableNo]);
   
   $profile="";
 for($x=0;$x<count($pagesT);$x++)
{ 
if($x!=$tableNo)
 {$profile.=$pagesT[$x];
 
 }
 else{
	 $profile.=$pagesT1[0]."|xy|";
	   $profile.=$Info;
	   }
if($x!=count($pagesT)-1)
 $profile.="|s|";
 }
 
echo $profile;
?>
