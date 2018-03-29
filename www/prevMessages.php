
<?php
include_once "cnncttoDataBaseofyachattwbsght.php";


$emailAddress = $_POST['emailAddress'];
$conversWt    = $_POST['sendTo'];
$From    = $_POST['From'];
$x=$_POST['x'];
$y=$_POST['y'];

$cont=1;
  $response = array();

if(strcasecmp($emailAddress,$conversWt)<1)
$messageId = md5 (md5 ($emailAddress) . $conversWt);
else
$messageId = md5 (md5 ($conversWt) . $emailAddress);
//take take imp infos from messages
$sql = mysql_query("SELECT * FROM `messages` WHERE uid='$messageId'"); 
$row = mysql_fetch_array($sql);
$last =$row["nomsgs"];
$type =$row["type"];
$id =$row["id"];
$response[0]['maxlng']=$row["nomsgs"];
$response[0]['x']=$x;
$response[0]['y']=$y;
$start=$last-$From;
$finish=$start+10;


If($type=="privatemsg"){
 $result = mysql_query("SELECT * FROM `privateMsg` WHERE uid='$id' AND uidm > '$start' AND uidm <= '$finish' ORDER BY id DESC");

  
while ($row=mysql_fetch_array($result)) {
	$response[$cont]['message']=$row["msg"];
	$response[$cont]['sender']=$row["sender"];
	$response[$cont]['time']="<font style='float:right; color:#b6bbb1;'>".date("h:i D/M",strtotime($row["time"]))."</font>";
	$response[$cont]['status']= "<font style='color:#b6bbb1;'>".$row["Status"]."</font>";

if($cont>=$last)
break;
else
	$cont++;
	}	}
else If($type=="groupMsg"){}



echo json_encode($response);
?>