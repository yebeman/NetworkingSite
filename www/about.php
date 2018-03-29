<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>YaChatt | About</title>
<link href="assets/demoStyles.css?1.0" rel=stylesheet type="text/css"/>
<style>
#content {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	height: 30%;
	margin: auto;
	width: 800px;
	font: normal 14px Arial, Helvetica, sans-serif;
	color: #555555;
	text-align: justify;
	padding:20px;
}
.alignright {
	float: right;
	padding-left: 10px;
}
</style>
</head>
<body>
<div id="target" class="backg loader">
  <div id="content" class="checkout">
    <h4 ><img class="alignright" src="images/profPic.jpg" />I'm in love with my old computer, might be four years old, the one I bought with my earnings. Might be its just that when you love things, material or immaterial, it loves you back, same as my computer. I'm in love with colors, designs and types. The way I'm passionate about them, they come to me naturally. Well even though you don't like to read much about my personal life, you must be interested to know how the colors got into me... <br />
      <br />
      I've done my schooling in a colorful small town near cochin with river, sea and hills around of course awfully beautiful. Might be the most memorable moments I had in 
      my life are the four years I spent at the Fine Arts College near Tripunithura Hill Palace, where drawings &amp; colors got into me with creative friends and naughty pictures. <br />
      <br />
    </h4>
  </div>
</div>
<header id=topdiv class=EaselJS> <a id=bottomBtn href="http://localhost/yc" class=button>Yachatt</a> </header>
<footer id=bottomdiv class=EaselJS>
  <nav>
    <?php
		 ob_start();
		include 'data.php';
		ob_end_clean();
		 
		  for($x=0;$x<count($pages);$x++)
		 { $pieces = explode(",", $pages[$x]);
		 if($pieces[1]=="About"){$currPage=' btnclick"';}else $currPage='"';
		 echo '<a id=bottomBtn_'.$x.' class="clicked'.$currPage.' href='.$pieces[0].'>'.$pieces[1].'</a>';}
		  ?>
    &nbsp; &nbsp; &nbsp; &copy;2013 Yachatt </nav>
</footer>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
</body>
</html>