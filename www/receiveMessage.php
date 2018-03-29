<?php
include_once "cnncttoDataBaseofyachattwbsght.php";


$emailAddress = $_POST['emailAddress'];
$conversWt    =$_POST['sendTo'];
$oldId=$_POST['oldIdS'];
$x=$_POST['x'];
$y=$_POST['y'];
$ok=false;
$cont=0;
$response = array();

if(strcasecmp($emailAddress,$conversWt)<1)
$messageId = md5 (md5 ($emailAddress) . $conversWt);
else
$messageId = md5 (md5 ($conversWt) . $emailAddress);

$sql = mysql_fetch_array(mysql_query("SELECT * FROM `messages` WHERE uid='$messageId'")); 

$Id=$sql['id'];
$last_msg_id=$oldId;


$time_start = microtime(true);
$breaK=false;
ini_set("max_execution_time",300);
while (true) {
  usleep(10000);
  clearstatcache();
  
    $data = mysql_fetch_array(mysql_query("SELECT * FROM `messages`  WHERE uid='$messageId'"));
    $last_msg_id=$data['nomsgs'];
	$time_end = microtime(true);
	$time=$time_end-$time_start;
if($time>=15)
{
$ok=false;
break; }
else if($last_msg_id!=$oldId)
{$ok=true;
break; 

}}


$response[0]['maxlng']=$last_msg_id;
$response[0]['x']=$x;
$response[0]['y']=$y;
if($ok){

$result = mysql_query("select * from `privatemsg` WHERE uid='$Id' AND uidm > $oldId ORDER BY id");
while ($row=mysql_fetch_array($result)) {
$response[$cont]['message']  = $row['msg'];
$response[$cont]['sender']  = $row['sender']; 
$response[$cont]['status']= "<font style='color:#b6bbb1;'>".$row["Status"]."</font>";
$response[$cont]['time']= "<font style='float:right; color:#b6bbb1;'>".date("h:i D/M",strtotime($row["time"]))."</font>";
$oldId++;
$cont++;
//make sure
}}
echo json_encode($response);
?>