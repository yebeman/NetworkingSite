<?PHP
include_once "cnntomessageContent.php";
include_once "cnntomessageUsers.php";
include_once "cnncttoDataBaseofyachattwbsght.php";


$emailAddress=$_POST['emailAddress'];
$conversWt=$_POST['sendTo'];
$pages;

$val = mysql_query("select messageId FROM `messages`.`$emailAddress` WHERE  conversWith='$conversWt'");
$row =mysql_fetch_array($val); 
$val=$row["messageId"];// takes the message id
     
$sql = mysql_query("select id FROM `messages_content`.`$val` ORDER BY id DESC LIMIT 1");  
if(mysql_num_rows($sql)==0)$pages=0;
else {	
$sql = mysql_query("SELECT MAX(id) FROM `messages_content`.`$val`");
$data = mysql_fetch_array($sql);
$pages=$data[0];}echo $pages;?>