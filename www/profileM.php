 <?php 
include_once "cnncttoDataBaseofyachattwbsght.php";
if (isset($_COOKIE['em']) && isset($_COOKIE['sub'])) {
  
   
   $emailAddress=$_COOKIE["em"];
   $password=$_COOKIE["sub"];
	
	   $sql = mysql_query("SELECT * FROM members WHERE password='$password' AND emailAddressE='$emailAddress'"); 
        
        $login_check = mysql_num_rows($sql);
   	 // if the program founds by that name and password then sends a "all good" data to the falsh
   	 // if not then "no good"
        if($login_check <= 0){
			header("Location: http://localhost/yc/index.php");}

  }
  else header("Location: http://localhost/yc");
  ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>YaChatt | Profile</title>
      <link href="assets/demoStyles.css?1.0" rel=stylesheet type="text/css"/>
      <style type="text/css" >
	   #navlist li {
	vertical-align: top;
	display: inline-block;
	list-style-type: none;
	padding-right: 20px;
	padding-bottom: 20px;
}
.top{
	background: #EC7F62;
	background-clip: padding-box;
	border-bottom-left-radius:15px;
	border-bottom-right-radius:15px;
	-moz-border-bottom-left-radius:15px;
	-moz-border-bottom-right-radius:15px;
	-o-border-bottom-left-radius:15px;
	-o-border-bottom-right-radius:15px;
	-webkit-border-bottom-left-radius:15px;
	-webkit-border-bottom-right-radius:15px;}
</style>

     
   </head>
     <body onload="init();">
      <div id=target  align="center" class="backg loader">
      <img border="0"  id="target1"  src="images/imgg1.jpg" alt="your image"> <!--900x400-->
<canvas id="testCanvas" align="center"     width="0" height="0"></canvas>
    <?php 
         $emailAddress=$_COOKIE["em"];
         $password=$_COOKIE["sub"];
         
          $sql = mysql_query("SELECT * FROM `members` WHERE  emailAddressE='$emailAddress' AND password='$password'"); 
         $row = mysql_fetch_array($sql);
         
         $pages =$row["profileInfo"];
         $pages = explode("|s|", $pages);
		 
		$colors= array("#3FB1D6","#EFD250","#EC7F62","#BC5679","#A7B526");
		 shuffle($colors);// brown and blue light blue
         echo '<ul  id="navlist" >';
         
         
         for($x=0;$x<count($pages)-1;$x++)
         { $pieces = explode("|xy|", $pages[$x]);
		 
		
		 
         echo '<li>';
         echo ' <table  id="profileT'.$x.'" class="backBox" style="background:#EEE;" cellspacing="0"   border="0" cellpadding="0">';
		 
		 
		 $first=true;
         for($y=0;$y<(count($pieces));$y++) {// inside the title
         
         echo '<tr valign="top"  style=" display: block; padding-left:15px;padding-right:15px;" ';
         
        // if($y==1) echo ' bgcolor="#EC7F62"  > <td>';
         // bgcolor="#F0D152"
         
     if($y==0)
         {	
        echo ' height="0px"><td><br><tr valign="top" align="left"> <td>';
         }

         else {
         echo  '
           > <td align="left" style="padding-top:15px;padding-bottom:15px;" >
         <font color="#777777" face="Arial" id="T'.$x.$y.'" size="3" >'. $pieces[$y].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font> </td>
         
		 <td  align="justify" style="word-break:break-all; min-width:200px;max-width:250px; padding-top:15px;padding-bottom:5px;" >
		  <br><font color="#555555"  face="Verdana" id="A'.$x.$y.'"   size="2" >'. $row[$pieces[++$y]].'</font></td>'
		 
		 ;
		 $y++;
         }	
                              
            echo '</td> </tr>';}
         // 
         echo '<tr> <td>
		<br> <table class="top shadow"   height="50px"style=" background:'.$colors[$x].';" cellspacing="0"  cellpadding="0">
  <td style="padding-top:15px;"><font color="#FFFFFF" face="Arial" style=" padding-left:20px;" size="3"> <b>'. $pieces[0].'</font></td></tr> </table>
         </td> </tr></table>';
         
         echo '</li>';
         
         } 
      if((count($pages)-1)% 2 != 0)   {echo '<li> <table  id="profileT'.$x.'" class="backBox" style="background:#EEE; " cellspacing="0"   border="0" cellpadding="0"><tr><td></td> </tr></table></li>';}
         
         echo ' </ul>';
         
         
          ?>
      </div>
    
      <header id=topdiv class=EaselJS> <a id=bottomBtn href="#" class=button>Yachatt </a>
 <nav style="padding-right: 100px; float:right;">
        <ul    >
       <li><a id=bottomBtn1 href="#" style=" font-size:22px;"   class=clicked>&#9776 </a>    
           <ul style=" alignment-adjust:middle; text-align:center; width:70px">
                <li ><a style="font-size:14px;"  href="contact.php">Contact US</a></li>
                <li><a style="font-size:14px" href="about.php">About Us</a></li>
                <li><a style="font-size:14px" href="signout.php">Sign Out</a></li>
         </ul>
            
            </li>
          </ul>
 </nav>
      <footer id=bottomdiv>
       <nav>
            <?php
		 ob_start();
		include 'data.php';
		ob_end_clean();
		 //40,70,100
		 
		 
         echo' <ul >
       <li><a class="bbutton" href="#">Profile &#9650</a>';
		 if(count($pages)==2)
		 echo '<ul style=" top:-40px;" >';
		 else {
			 $topv=40+30*(count($pages)-2);
		echo '<ul style=" top:-'.$topv.'px;" >';
			 }
		 
		  for($x=0;$x<count($pages);$x++)
		 { $pieces = explode(",", $pages[$x]);
		
		 
		  if($pieces[1]=="Profile"){continue;}
		  else {
		 echo '<li><a href='.$pieces[0].'>'.$pieces[1].'</a>';}
		 ;}
		 echo ' </ul>
            
            </li>
          </ul>';  
		  
		  
		  ?>
          
            &nbsp; &nbsp; &nbsp; &copy;2013 Yachatt
         </nav>
      </footer>
      <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
      <script src="./backgroundAnim.js"> </script>
      <script src="./assets/easeljs-0.6.0.min.js?1.0"></script>
      <script src="./assets/tweenjs/Tween.js?1.0"></script>
      <script src="./assets/tweenjs/Ease.js?1.0"></script>
      <script src="./js/jquery.tinyscrollbar.min.js?1"></script>
      <script src="./js/modernizr.js?1.0"></script>
   </body>
</html>