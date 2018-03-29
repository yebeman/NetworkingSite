<?PHP
include_once "cnncttoDataBaseofyachattwbsght.php";


$emailAddress = $_POST['emailAddress'];
$conversWt    = $_POST['sendTo'];
$chatBoxNum   = $_POST['chatBoxNum'];
$msg= '<div id="tabs_wrapper'.$chatBoxNum.'" class="wrapper">';
$msg.= '<div class="trigger" style="position:absolute; margin-top:-15px;; float: right; right: 0px;"><a style="text-decoration:none; cursor:pointer;background: #D1D1D1; display: inline-block;"  onClick="minim('.$chatBoxNum.')">&nbsp;&#8597;&nbsp;</a> &nbsp;<a style="text-decoration:none; cursor:pointer;background: #D1D1D1; display: inline-block;" onClick="closeM('.$chatBoxNum.','.'\''.$conversWt.'\''.')">&nbsp;X&nbsp</a> </div>';
$msg.= '<div  id="txtA'.$chatBoxNum.'" style=" position:relative;top:4px;"><textarea id="txtArea'.$chatBoxNum.'"  style=" font:Tahoma; resize: none; max-height:40px; border: none;box-shadow: 0 0 2px #719ECE; width:255px; max-width:255px; height:40px;"placeholder="type your message" ></textarea></div>';
$msg.=' <div  id="tabs'.$chatBoxNum.'"><div id="tab1'.$chatBoxNum.'" class="tab_content"> Video </div><div id="tab2'.$chatBoxNum.'" class="tab_content" style="display: block;"></div><div id="tab3'.$chatBoxNum.'" class="tab_content"> Audio </div></div>';
$msg.='<div  style=" position:absolute;  right:17px; padding-top:1px; z-index:1; "><div id="userMsg'.$chatBoxNum.'" style=" float:left; color:#FFF; font:Georgia; font-size:18px; margin-top:7px;">&nbsp;userName&nbsp;</div><img style="float: left;  padding: 2px; background: #888888" src="userImage" id="icon'.$chatBoxNum.'" height="28px" width="28px" /> </div>';

$msg.=' <div id="tabs_container'.$chatBoxNum.'" style="z-index:2;" ><ul class="tabrow"><li  id="tabb1'.$chatBoxNum.'" style=" background-color:#EC7F62"><a href="#tab1'.$chatBoxNum.'">V</a></li><li  id="tabb2'.$chatBoxNum.'" style=" font-size:20px; height:31px;  background-color:#EFD250 "><a  href="#tab2'.$chatBoxNum.'">T</a></li><li  id="tabb3'.$chatBoxNum.'" class="selected" style="background-color:#A7B526" ><a href="#tab3'.$chatBoxNum.'">A</a></li></ul></div></div>';

  $sql = mysql_query("SELECT * FROM `members` WHERE  emailAddress='$conversWt'"); 
	$row = mysql_fetch_array($sql);

	$image =$row['profilePic'];
	$name =$row['userName'];
	
	$output = str_replace('userImage', $image,$msg );
	$output = str_replace('userName', $name,$output );
	echo($output);
?>