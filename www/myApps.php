
<!DOCTYPE html>
<html>
<head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <title>Photo</title>
  <link href="assets/demoStyles.css?1.0" rel=stylesheet type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/logoutMenu.css" />
 
<link href="styleMsg.css" rel=stylesheet type="text/css"/>
  <link rel="stylesheet" type="text/css" href="css/preview.css" />


     
   </head>
   <body class="cbp-spmenu-push">
 
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
			header("Location: http://localhost/yc/index.php");
			}
		else{
			$prof = mysql_fetch_array($sql);
			$display_name=$prof["userName"];
			$display_pic =  $prof["profilePic"];}
  }
  else header("Location: http://localhost/yc");
  
   $html="<div id=target class='backg'>";
   
  
  
    //chat
	$email="\"yebe@gmail.com\"";
	
	// bar for the online box
   $html.="<div  id='onlineF' style='position: fixed; float: right; right: 2%;'>

<table cellpadding='0'  width='203px;'  bgcolor='#eee' ><tr align='center'><td >
<input type='radio' name='status' onClick='offLine(0)'  value='offline' checked='checked'><br>Offline</td><td>
<input type='radio' name='status' onClick='offLine(1)' value='online'  ><br>Online</td><td>
<input type='radio' name='status' onClick='offLine(1)' value='invisible'><br>Invisible</td></tr>
<tr><th colspan='3' align='left'>

  <ul id='onlineFrds' class='searched'   style=' display:none; position:absolute;width:200px; margin-top:0px;' >
  <li class='menu'  style='padding-left:25px;' onClick='online(12)' ><h3> &#8597  Who's online</h3></li>
  </ul>

</th>
</tr>
</table>
</div>


<div style='position:fixed; max-height:350px;bottom:20px;display:inline;float:right; right:40px; padding-left:70px;'>

<div id='outOS' style='max-height:350px; width:70px;position: absolute;margin-left:-70px;   bottom:0px;'></div>

<div id='fly'  style=' position: relative; height:350px; '>
</div>

</div>

";
$html.="<div align='center' style='display: block; margin-top:15px; background-color:#ccc;'>";
  $html.="   <div style='width:900px; display: inline-block; vertical-align: top; background-color:#999999;  height:320px;'>
	<img style='margin-left:-900px;  margin-top:50px;  border-radius:100px; width:200px; display: inline-block; vertical-align: top; background-color:#F1F1F1;  height:200px;' src='".$display_pic."'>
	 <div style='margin-top:70px;margin-left:-100px; ' id='sticky_navigation_wrapper'>
        <div id='sticky_navigation'>
            <div class='demo_container'>
                <ul>
                    <li><a  href='http://localhost/yc/profile' >About Me</a>
                    </li>
                    <li><a  href='http://localhost/yc/photo'>Photo</a>
                    </li>
                    <li><a href='http://localhost/yc/friend'>Friends</a>
                    </li>
                    <li><a class='selected href='#'>Apps</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<div  style=' display: block; width:900px; margin-left:auto; margin-right:auto;  margin-top:75px;'>";
  
    	$randColor=array("#FAA101","#08B01F","#2F6BFA","#00ACEE","#C0D6AB");

$emailAddress = "yebe@gmail.com";// no need but for the moment

// type in here

	
 //header
   $html.="<header id='topdiv'> <table width='99%' style='position:fixed;margin-top:-2px; min-width:560px; ' cellspacing='0' border='0' cellpadding='0'><tr valign='top'>";
  
  $html.="<td width='33%'><a id=bottomBtn href='http://localhost/yc/' class=button>Yachatt </a></td>";
  $html.="<td  width='33%'><div align='center'><input type='text' placeholder='Search for people, apps...' id='search' autocomplete='off'> <ul  align='center' id='results' class='searched searchC' style='display:none'> </ul> </div>'</td>";
  if(strlen($display_name)>=18)
  {$newDN=substr($display_name,0,18)."...";}
  else $newDN=$display_name;
  $html.="<td  width='33%' style='float:right;' >  
  <nav >
    <div  id='dd' class='wrapper-dropdown' tabindex='1'>".$newDN."
      <ul class='dropdown'>
        <li class='contact'><a  href='contact.php'>Contact</a></li>
        <li class='about'><a href='about.php'>About</a></li>
        <li class='logout'><a href='signout.php'>Log out</a></li>
      </ul>
    </div>
  </nav></td></tr></table> 
</header>";
  echo $html;

		 ob_start();
		include 'data.php';
		ob_end_clean();
		 $pagesI="";
		   for($x=0;$x<count($pages);$x++)
		 { $pieces = explode(",", $pages[$x]);
		
		 
		  if($pieces[1]=="Profile"){continue;}
		  else {
		 $pagesI.= '<a href='.$pieces[0].'>'.$pieces[1].'</a>';}
		 ;}
		 
		 
     $html1="<footer id=bottomdiv >
	 <ul id='marquee6' class='marquee shadow'  >
	<li ><span class='author'>News</span>Lorem ip.</li>
	<li ><span class='author'>Entertainment</span>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tinciduntClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt</li>
</ul>
<ul>                
 <li id='marquee-author' class='marquee-author'> </li></ul>";
 
 //
		$html1.="</footer><nav class='cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left' id='cbp-spmenu-s1'>
  <h3>Your pages</h3>
  ".$pagesI."
   <button class='multBtn' style='position:absolute;margin-left:210px; bottom:0px;' id='showLeftPush'> Profile</button> </nav>	
   <nav class='cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right' id='cbp-spmenu-s2'>
			<h3>Menu</h3>
			<a href='#'>Celery seakale</a>
            <button class='multBtn' style='position:absolute;margin-left:-130px; float:right; bottom: 0px; '  id='showRightPush'>Entertainment</button>
		</nav>";
		 echo $html1;
	 
		  
		  
		  ?>
       
         
<link href="css/search.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="./css/jquery.marquee.css" rel="stylesheet" title="default" media="all" />
<link rel="stylesheet" type="text/css" href="css/component.css" />  
    
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script type="text/javascript" src="js/search.js"></script>

<script type="text/javascript"  src="runMsg.js"></script>




<script type="text/javascript">
	var use_debug = false;

function debug() {
    if (use_debug && window.console && window.console.log) console.log(arguments);
}
// on DOM ready
$(document).ready(function () {
	
	
	
	// if clicked else where, hide open slides	
var searchN = $('div.icon'); // cache the searchN element for speed
var logoutM=$('dd');
$(document).click(function(e) { // when any click is received
    if (
        (searchN[0] != e.target) && // the target element is not the searchN
        (!searchN.has(e.target).length) // and the searchN does not contain the target element
		&&(logoutM[0] != e.target) && // the target element is not the searchN
        (!logoutM.has(e.target).length) // and the searchN does not contain the
    ) {
         $("ul#results").hide();
		 //$(".dropdown").hide();
		 $("#dd").removeClass('active');
    }
	else $('input#search').focus();
});
	
	
	
	var dd = new DropDown($('#dd'));
    $(".trigger").click(function () {
        $(".panel").slideToggle("fast");
        $("#icon").slideToggle("fast");
        $(this).toggleClass("active");

    });
    $(".marquee").marquee({
        loop: -1
        // this callback runs when the marquee is initialized
        ,
        init: function ($marquee, options) {
            debug("init", arguments);
        }
        // this callback runs before a marquee is shown
        ,
        beforeshow: function ($marquee, $li) {
            debug("beforeshow", arguments);

            // check to see if we have an author in the message (used in #marquee6)
            var $author = $li.find(".author");
            // move author from the item marquee-author layer and then fade it in
            if ($author.length) {
                $("#showRightPush").html("<span style='display:none;'>" + $author.html() + "</span>").find("> span").fadeIn(850);
                if ($author.html().length <= 5)
                    $("#showRightPush").css('margin-left', '-70px')
                else if ($author.html().length <= 10)
                    $("#showRightPush").css('margin-left', '-100px')
                else if ($author.html().length <= 15)
                    $("#showRightPush").css('margin-left', '-140px')
                else if ($author.html().length <= 20)
                    $("#showRightPush").css('margin-left', '-180px')
            }
        }
        // this callback runs when a has fully scrolled into view (from either top or bottom)
        ,
        show: function () {
            debug("show", arguments);
        }
        // this callback runs when a after message has being shown
        ,
        aftershow: function ($marquee, $li) {
            debug("aftershow", arguments);

            // find the author
            var $author = $li.find(".author");
            // hide the author
            if ($author.length) $("#showRightPush").find("> span").fadeOut(250);
        }
    });
});

var iNewMessageCount = 0;

function addMessage(selector) {
    // increase counter
    iNewMessageCount++;

    // append a new message to the marquee scrolling list
    var $ul = $(selector).append("<li>New message #" + iNewMessageCount + "</li>");
    // update the marquee
    $ul.marquee("update");
}

function pause(selector) {
    $(selector).marquee('pause');
}

function resume(selector) {
    $(selector).marquee('resume');
}
//-->


////////////////////////////////
var menuLeft = document.getElementById('cbp-spmenu-s1'),
    menuRight = document.getElementById('cbp-spmenu-s2'),
    showRightPush = document.getElementById('showRightPush'),
    showLeftPush = document.getElementById('showLeftPush'),
    body = document.body;

showLeftPush.onclick = function () {
    classie.toggle(this, 'active');
    classie.toggle(body, 'cbp-spmenu-push-toright');
    classie.toggle(menuLeft, 'cbp-spmenu-open');

};
showRightPush.onclick = function () {
    classie.toggle(this, 'active');
    classie.toggle(body, 'cbp-spmenu-push-toleft');
    classie.toggle(menuRight, 'cbp-spmenu-open');
};


function DropDown(el) {
    this.dd = el;

    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.dd.on('click', function (event) {
            $(this).toggleClass('active');
            event.stopPropagation();
        });
    }
}
	
	//text
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
// message

		
		var onlin=true;
	var sts=0;
	function online(me) {
		if(me !== ''&&onlin){
			$.ajax({
				type: "POST",
				url: "friends.php",
				data: { query: me },
				cache: false,
				success: function(html){
					$("ul#onlineFrds").html(html+$("ul#onlineFrds").html());
				}
			});onlin=false;
		}else  { maxim()
		};   
	}
	
		function maxim(){
		$("ul li.hide").slideToggle("fast");
		
		}
		function offLine(show){
			
			if(sts!=show)
			{sts=show;
		$("ul#onlineFrds").slideToggle("fast");}
	
		}
		
if (window.attachEvent) { // ::sigh:: IE8 support
   window.attachEvent('onstorage', readCookie);
} else {
    window.addEventListener('storage', readCookie, false);
}
	
</script> 
<script type="text/javascript" src="./js/jquery.marquee.js"></script>
<script src="js/classie.js"></script> 

</body>

</html>
