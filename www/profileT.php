<?php
   include_once "cnncttoDataBaseofyachattwbsght.php";
   
   /*
function
   {echo "hi";}*/
       ?>
<!doctype html>
<html>
      <head>
      <meta charset="utf-8">
      <title>profileT</title>
      <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
      <style type="text/css">
.backBox {
	background: #FFFFFF;
	border-radius: 15px;
	-moz-border-radius: 15px;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
	box-shadow: 0px 0px 10px #000;
//xoff yoff blurry color 
 -moz-box-shadow:0px 0px 10px #000;
	-webkit-box-shadow: 0px 0px 10px #000;
	min-width: 300px;
}
#navlist li {
	vertical-align: top;
	display: inline-block;
	list-style-type: none;
	padding-right: 20px;
	padding-bottom: 20px;
}
.checkout-input {
	float: left;
	font-size: 17px;
	padding: 0 7px;
	height: 26px;
	color: #525864;
	background: white;
	border: 1px solid;
	border-color: #b3c0e2 #bcc5e2 #c0ccea;
	border-radius: 6px;
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px rgba(255, 255, 255, 0.5);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px rgba(255, 255, 255, 0.5);
}
.checkout-input:focus {
	border-color: #46aefe;
	outline: none;
	-webkit-box-shadow: 0px 1px 10px #78AB46;
	-moz-box-shadow: 0px 1px 10px #78AB46;
	box-shadow: 0px 1px 10px #78AB46;
}
.checkout-name {
	width: 200px;
}
.shadow {
	display:compact;
	-moz-box-shadow: inset 0px 0px 5px 0px #666;
	-webkit-box-shadow: inset 0px 0px 5px 0px #666;
	box-shadow: inset 0px 0px 5px 0px #666;
	-o-box-shadow: inset 0px 0px 5px #666
}
</style>
      <SCRIPT language="javascript" src="editPage.js"> </SCRIPT>
      </head>
      <body>
      <?php 
         $emailAddress='d3dd44d9d83a6ae8c0c249ce90510757';//$_COOKIE["em"];
         $password='a195bc1c245976ac857b05f641d7ac88';//$_COOKIE["sub"];
         
          $sql = mysql_query("SELECT * FROM `members` WHERE  emailAddressE='$emailAddress' AND password='$password'"); 
         $row = mysql_fetch_array($sql);
         
         $pages =$row["profileInfo"];
         $pages = explode("|s|", $pages);
         echo '<ul  id="navlist" >';
         
         
         for($x=0;$x<count($pages);$x++)
         { $pieces = explode("|xy|", $pages[$x]);
         
         
         echo '<li>';
         echo ' <table  id="profileT'.$x.'" class="backBox" style="background:#EEE;" cellspacing="0"   border="0" cellpadding="0">';
		 
		 $first=true;
         for($y=0;$y<(count($pieces));$y++) {// inside the title
         
         echo '<tr valign="top"  align="left"  ';
         
        // if($y==1) echo ' bgcolor="#EC7F62"  > <td>';
         // bgcolor="#F0D152"
         
         
          if($x==(count($pages)-1)){
		 
		 echo ' class="shadow"><td><br><p style=" padding-left:15px;"><input type="text" class="checkout-input checkout-name" placeholder="Add Title" onKeyUp="submitBtn('.$x.')"  title="Make your own Profile"  id="'.$x.$y.'" required x-moz-errormessage="Make your own Profile" ><br><tr valign="top"   align="left"> <td></p>';//for the create your own prof
		  } 
         else if($y==0)
         {	
         echo 'height="0px" ><td><br><font color="#AAAAAA" face="Arial" style=" padding-left:15px;" size="3"> <b>'. $pieces[$y].'</font><br><br><tr valign="top" align="left"> <td>';
         }

         else {
         echo  ' class="shadow"
         bgcolor="#DDDDDD"  > <td><p style=" padding-left:15px;padding-right:15px;">
         <font color="#555555" face="Arial" id="T'.$x.$y.'" size="4" b>'. $pieces[$y].'</font><br>
         <input type="text" class="checkout-input checkout-name" placeholder="Email Address"   title="Email Address"  id="'.$x.$y.'" required x-moz-errormessage="Fill in your Email Address" onKeyUp="submitBtn('.$x.')"   value='.$row[$pieces[++$y]].'>
         
         &nbsp;&nbsp;&nbsp;&nbsp;
        
         <select id="'.$x.$y.'" onChange="submitBtn('.$x.')" style=" border-radius: 6px; "> <option value="'.$pieces[++$y].'">'.$pieces[$y].'</option>';
         
         if($pieces[$y]=="Only me"){
         echo '
         <option value="Only Friends">Only Friends</option>
         <option value="Public">Public</option>';}
         else if($pieces[$y]=="Only friends"){
         echo '
         <option value="Only me">Only me</option>
         <option value="Public">Public</option>';}
         else {
         echo '
         <option value="Only me">Only me</option>
         <option value="Only friends">Only friends</option>';}
         
         
         echo '</select><tr height="5px"  valign="top" align="left"> <td> ';
         }	
                              
            echo '</td> </tr>';}
         
         echo '<tr  valign="top" align="left"> <td><br><br>
         </td> </tr></table>';
         
         echo '</li>';
         
         } 
         
         
         echo ' </ul>';
         
         
          ?>
</body>
</html>