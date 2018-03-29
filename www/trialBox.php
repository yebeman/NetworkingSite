<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trial</title>
<style>
.rect{
	background:#dddddd;
	width:400px;
	height:100px;
	border-top-right-radius:10px;
	border-top-left-radius:10px;
	}
	.wrapper {
    padding: 1em;
}
</style>

</head>

<body>
<div class="wrapper rect">
    <span class="text-content">Double Click On Me!</span>
</div>
<script>
//plugin to make any element text editable
$.fn.extend({
	editable: function () {
		$(this).each(function () {
			var $el = $(this),
			$edittextbox = $('<input type="text"></input>').css('min-width', $el.width()),
			submitChanges = function () {
				if ($edittextbox.val() !== '') {
					$el.html($edittextbox.val());
					$el.show();
					$el.trigger('editsubmit', [$el.html()]);
					$(document).unbind('click', submitChanges);
					$edittextbox.detach();
				}
			},
			tempVal;
			$edittextbox.click(function (event) {
				event.stopPropagation();
			});

			$el.dblclick(function (e) {
				tempVal = $el.html();
				$edittextbox.val(tempVal).insertBefore(this)
                .bind('keypress', function (e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if (code == 13) {
						submitChanges();
					}
				}).select();
				$el.hide();
				$(document).click(submitChanges);
			});
		});
		return this;
	}
});

//implement plugin
$('.text-content').editable().on('editsubmit', function (event, val) {
    console.log('text changed to ' + val);
});
</script>
</body>




<?php
		for($x=0;$x<count($pages);$x++)
         { $pieces = explode("|xy|", $pages[$x]);
         
 
 			 if($x%2==0)
		  $html.= '<ul>';
			
         $html.= '<li>';
		
         $html.= ' <table  align="left" id="profileT'.$x.'" class="backBox" style="background:#EEEEEE;" cellspacing="0"   border="0" cellpadding="0">';
		 
		 $first=true;
         for($y=0;$y<(count($pieces));$y++) {// inside the title
         
         $html.= '<tr valign="top"  align="left" ';
         
         
          if($x==(count($pages)-1)){
		 
		 $html.= '><td><br><p style=" padding-left:15px;"><input type="text" class="checkout-input checkout-name" placeholder="Add Title" onKeyUp="submitBtn('.$x.')"  title="Make your own Profile"  id="'.$x.$y.'" required x-moz-errormessage="Make your own Profile" ><br><tr valign="top"   align="left"> <td></p>';//for the create your own prof
		  } 
         else if($y==0)
         {	
         $html.= 'height="0px"><td><br><font color="#AAAAAA" face="Arial" style=" padding-left:15px;" size="3"> <b>'. $pieces[$y].'</font><br><br><tr valign="top" align="left"> <td>';
         }

         else {
         $html.=  '
         bgcolor="#DDDDDD"  > <td><p style=" padding-left:15px;padding-right:15px;">
         <font color="#555555" face="Arial" id="T'.$x.$y.'" size="4" b>'. $pieces[$y].'</font><br>
         
		 <span class="text-content" id="'.$x.$y.'">'.$prof[$pieces[++$y]].'</span>
		 
		 
         
         &nbsp;&nbsp;&nbsp;&nbsp;
        
         <select id="'.$x.$y.'" onChange="submitBtn('.$x.')" style=" border-radius: 6px; "> <option value="'.$pieces[++$y].'">'.$pieces[$y].'</option>';
         
         if($pieces[$y]=="Only me"){
         $html.= '
         <option value="Only Friends">Only Friends</option>
         <option value="Public">Public</option>';}
         else if($pieces[$y]=="Only friends"){
         $html.= '
         <option value="Only me">Only me</option>
         <option value="Public">Public</option>';}
         else {
         $html.= '
         <option value="Only me">Only me</option>
         <option value="Only friends">Only friends</option>';}
         
         
         $html.= '</select> <td> ';
         }	
                              
            $html.= '</td> </tr>';}
         
         $html.= '<tr  valign="top" align="left"> <td><br><br>
         </td> </tr></table>';
         
         $html.="</li>";
         } 
          
         $html.="</ul></div>";
?>








</html>

















