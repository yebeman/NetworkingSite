<?php


$url=$_SERVER['REQUEST_URI'];
try{
$url=preg_replace('/\/yc\//','', $url);
}
catch (Exception $e) {}
echo $url;
$data_array = "No data";
if(preg_match('/\//',$url))
header("Location: http://localhost/yc/profil.php");
else {

$i = 0;
include_once "cnncttoDataBaseofyachattwbsght.php";
$sql = mysql_query("SELECT * FROM members WHERE userName LIKE '%$url%'");
while ($row=mysql_fetch_array($sql)) {
$i++;
$userNameS =$row["userName"];
$userNameSI =$row["profilePic"];
$userNameSE =$row["emailAddress"];

if($i==1)
$data_array = "$userNameS|S|$userNameSI|S|$userNameSE";
else $data_array .= "(||S||)$userNameS|S|$userNameSI|S|$userNameSE";
}

 if($data_array=="No data"){header("Location: http://localhost/yc/profile.php");}
 else echo $data_array;
}
?>