<?php
include_once "cnncttoDataBaseofyachattwbsght.php";


$emailAddress=$_POST['emailAddress'];
$conversWt=$_POST['sendTo'];
$messageT1=$_POST['messageT'];
//$wrapDB=$_POST['wrapDB'];
$type  = $_POST['type'];

if(strcasecmp($emailAddress,$conversWt)<1)
$messageId = md5 (md5 ($emailAddress) . $conversWt);
else
$messageId = md5 (md5 ($conversWt) . $emailAddress);

$val = mysql_query("select * from `messages` WHERE uid='$messageId'");
if(mysql_num_rows($val)!=0){
$row = mysql_fetch_array($val);
$last =$row["nomsgs"];
$last++;}

if(mysql_num_rows($val)==0){
$val = mysql_query("INSERT INTO `messages` ( `type`,`uid` , `nomsgs`) VALUES ('$type','$messageId','0')");
}
else
{try{
mysql_query("UPDATE `messages` SET nomsgs='$last' WHERE  uid='$messageId'");
}
	catch (Exception $e){}
	}
$val = mysql_query("select * from `messages` WHERE uid='$messageId'");	
$row = mysql_fetch_array($val);
$id =$row["id"];	
	// updating the privatemsg
if($type=="privatemsg"){
	
$sql = mysql_query("INSERT INTO `privatemsg` ( `uidm`,`uid`,`sender`, `msg`,`access`, `Status`) VALUES ('$last','$id','$emailAddress','$messageT1','all','sent')");;
}


echo "success";

?>