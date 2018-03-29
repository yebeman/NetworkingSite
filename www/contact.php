<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>YaChatt | Contact</title>
<link href="assets/demoStyles.css?1.0" rel=stylesheet type="text/css"/>
</head>
<body>
<div id="target" class="backg loader">
<iframe height=517 allowtransparency=true frameborder=0 scrolling=no style=border:none src="https://chriscoyier.wufoo.com/embed/s7p1p9/"><a href="https://chriscoyier.wufoo.com/forms/s7p1p9/" <title="Example Form" rel="nofollow">Fill out my Wufoo form!</a></iframe>
</div>
<canvas id=testCanvas class=loader width=0 height=0></canvas>
<header id=topdiv class=EaselJS>
<a id=bottomBtn href="http://localhost/yc" class=button>Yachatt</a>
</header>
<footer id=bottomdiv class=EaselJS>
<nav>
     <?php
		 ob_start();
		include 'data.php';
		ob_end_clean();
		 
		  for($x=0;$x<count($pages);$x++)
		 { $pieces = explode(",", $pages[$x]);
		 if($pieces[1]=="Contact"){$currPage=' btnclick"';}else $currPage='"';
		 echo '<a id=bottomBtn_'.$x.' class="clicked'.$currPage.' href='.$pieces[0].'>'.$pieces[1].'</a>';}
		  ?>
          
            &nbsp; &nbsp; &nbsp; &copy;2013 Yachatt
</nav>
</footer>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
<script src="./assets/easeljs-0.6.0.min.js?1.0"></script>
<script src="./assets/tweenjs/Tween.js?1.0"></script>
<script src="./assets/tweenjs/Ease.js?1.0"></script>
<script src="./js/jquery.tinyscrollbar.min.js?1"></script>
<script src="./js/modernizr.js?1.0"></script>
</body>
</html>