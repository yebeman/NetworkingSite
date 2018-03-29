/*
* Backgroud Animation 1.0
* Copyright (c) 2013 yachatt.com, inc.
* yebeltal Asseged
*/


	var canvas;
	var stage;
	var BG;
	var tween;
	var pageCount=2;
	var tweens;
	var x_pos_array=[];
	var y_pos_array=[];
	var scale_array=[];
	var side_item_count=3;
	var setFP=1; // seting the first page
	var item_x_spacing=25;
	var sideAdj=0
	var side_item_scale = 0.85;
	var decrement = 0.9;
	var scale_diff = 0.08;//.15
	var total_items=3;
	var duration = 300;
	var pageRect;
	var current_item_no = -1;
	var previous_item_no = -1;
	var pageheight=window.innerHeight-55;
	var pageWidth=window.innerWidth-90;
	var xPos=35;
	var move_x=xPos;
	var yPos=2;//50
	var move_y=yPos;
	var activeCount=total_items;
	var item_scale=1;
	var item_index;
	var item_depth;
	var item_alpha;
	var depth;
	var currPage;
	var firstTimeLoad=false;
	
	
function CheckBrowserSize() 
{
    
	pageheight=window.innerHeight-55;
	pageWidth=window.innerWidth-90;
	duration = 300;
	scale_diff = 0.08;//.15
	side_item_scale = 0.85;
	decrement = 0.9;
	item_scale=1;
	sideAdj=0
	
	stage.removeChild(BG)
	var i=0;
	while(stage.getChildByName(i))
	{stage.removeChild(stage.getChildByName(i))
	i++}
	init()
	
}


	function init(pageprf) {
		 setFP=pageprf;
		if (window.top != window) {
			document.getElementById("header").style.display = "none";
		}
	
		
		
		if(Modernizr.history){ // if history storage is allowed
		
		var newHash      = "",
        $mainContent = $("#main-content"),
        $pageWrap    = $("#page-wrap"),
        baseHeight   = 0,
        $el;
        
    
    $("nav").delegate("a", "click", function() {
        _link = $(this).attr("href");
        history.pushState(null, null, _link);
		setFP=2;
		changePage(_link)
        return false;
    });
	
	
	if(!firstTimeLoad){
		
		
		var filename = window.location.pathname.substr(window.location.pathname.lastIndexOf("/") + 1);
		startAnim(filename);
		
		}
		}
		
		
		
		
		
		function startAnim(href){
		firstTimeLoad=true;
			canvas = document.getElementById("testCanvas");
		stage = new createjs.Stage(canvas);
		window.addEventListener('resize',CheckBrowserSize,false); 
		xPos=Math.round((window.innerWidth-pageWidth)/2);
		item_x_spacing=Math.round((window.innerWidth-pageWidth)/2.2);
		
		canvas.height=window.innerHeight-53;
		canvas.width=window.innerWidth;
		//canvas.cellPadding;
		
		stage.enableDOMEvents(true);
		stage.enableMouseOver(10);
        tweens = [];
		createjs.Touch.enable(stage);
		
		createjs.Ticker.addEventListener("tick", tick);
			
			
			
	for( i = 0; i < total_items; i++ )
	{
		
		add_content(i);
	}
	
	fill_arrays();
	
	flashmo_stack_flow( setFP )
	
	
		 }
}



$(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
       startAnim(_link);
    });

			
		
		function add_content( item_no )
{
			 pageRect = new createjs.Shape(); 
			 pageRect.graphics.beginLinearGradientFill(["#FFF","#CFECEC","#CCC"], [.05,0.8,1], 0, 0, 0, pageheight).drawRoundRect(xPos,yPos,pageWidth,pageheight,20);
pageRect.graphics.beginStroke("#8BB381");
pageRect.graphics.setStrokeStyle(1);
pageRect.snapToPixel = true;
pageRect.shadow = new createjs.Shadow("#000", 0,2,10); 
				
				var container = new createjs.Container();
				
				
			
				if(setFP==item_no)
				
				{
					
				var content = new createjs.DOMElement(parent.document.getElementById('foo'));
				content.regX = -200;
				content.regY = -100;
				
				container.addChild(pageRect, content);
				
				
				}
				else container.addChild(pageRect);
				
				container.name=item_no;
				tweens.push({ ref:container,name:item_no});
				stage.addChild(container); 
	}


function changePage(href){
	activeCount=total_items;
	
	/*text = new createjs.Text(href+"asdflkajsdfhlkjadsh", "20px Arial", "#777");
	        text.x = 10;
	        text.y = 110;/*
	$('#hey').load(href +"#fo", function(){
    // code to execute once the HTML is loaded into your div*/
	var content = new createjs.DOMElement(parent.document.getElementById("fo"));
	content.regX = -200;
	content.regY = -100;
	
	tweens[setFP].ref.addChild(content);
//});
		
	
	
	
	if(currPage!=setFP)
			flashmo_stack_flow(setFP)
}

function handleMouseUp(event) {
			activeCount=total_items;
			
			if(event.target.name==0){
			text = new createjs.Text("asdflkajsdfhlkjadsh", "20px Arial", "#777");
	        text.x = 10;
	        text.y = 110;	
			tweens[event.target.name].ref.addChild(text);
			
			}
			
			
			if(currPage!=event.target.name)
			flashmo_stack_flow( event.target.name)
        }	
	


	function fill_arrays()
{
	var column;
	var power = 1;
	var sum_x = item_x_spacing;

	if(sideAdj==0)
	{if(pageheight<100)
	sideAdj=25
		else if(200>pageheight&&pageheight>=100)
	sideAdj=50
	else if(300>pageheight&&pageheight>=200)
	sideAdj=75
	else if(400>pageheight&&pageheight>=300)
	sideAdj=100
	else if(500>pageheight&&pageheight>=400)
	sideAdj=125
	else if(600>pageheight&&pageheight>=500)
	sideAdj=150
	else if(700>pageheight&&pageheight>=600)
	sideAdj=175
	else if(pageheight>=700)
	sideAdj=200
	}
	
	x_pos_array = [total_items];
	x_pos_array[0] = sum_x;
	scale_array = [ total_items ];
	
	scale_array[0] = side_item_scale;
	
	for( column = 1; column < total_items; column++ )
	{
		power *= decrement; 
		
		sum_x += Math.round( item_x_spacing * power );
		
		side_item_scale -= scale_diff;	
		
		x_pos_array[column] = sum_x;
		scale_array[column] = side_item_scale;
		y_pos_array[column-1]=Math.round(yPos*(-side_item_scale+.9)+sideAdj*(-side_item_scale+1))
	}
	
}


function flashmo_stack_flow( curr )
{	

	
	item_alpha=1;
	depth=total_items-1
	current_item_no = curr;
	item_scale=1;
	
	for( i = current_item_no - 1; i >= 0; i-- )
	{	
	
	if(total_items==1)
		continue;
		item_alpha=1
		item_index = current_item_no - i - 1;	//0	
		var ref= tweens[i].ref
		move_x = -x_pos_array[ item_index ];
		move_y =  y_pos_array[ item_index ];
		item_scale = scale_array[ item_index ];	
		if( item_index >= side_item_count )
		{item_alpha = 0;
		}
		else {
			ref.addEventListener("click", handleMouseUp);
			ref.cursor = 'pointer';	}
		
		
		ref.alpha = item_alpha;
		stage.setChildIndex( ref, depth);
		
		
		
		
		var tween = createjs.Tween.get(ref, {override:true})
		 				.to({scaleX:1, scaleY:item_scale, x:move_x,y:move_y },duration, createjs.Ease.quartOut).call(tweenComplete);
						
					
						
						
		depth--
	}
	
	
	
	depth=total_items-1;
	for( i = current_item_no; i < total_items; i++ )
	{	
		item_alpha = 1;
		item_index = i - current_item_no - 1;//1
		var ref=tweens[i].ref
		
			
		if( item_index == -1 )
		{
			move_x = 0;
			move_y=yPos;
			item_scale = 1;
			ref.height=window.innerHeight-55;
			
			currPage=i;
			ref.removeEventListener("click", handleMouseUp);
			ref.cursor = 'cursor';
		}
		else if( item_index < side_item_count )
		{
			move_x = x_pos_array[ item_index  ];
			move_y =  y_pos_array[ item_index ];
			item_scale = scale_array[ item_index ];	
			ref.addEventListener("click", handleMouseUp);
			ref.cursor = 'pointer';	
		}
		else
		{
			move_x = x_pos_array[ item_index ];
			move_y =  y_pos_array[ item_index ];
			item_scale = scale_array[ item_index ];	
			item_alpha = 0;
		}
		ref.alpha = item_alpha;
		stage.setChildIndex( ref, depth);
		
		
		
		var tween = createjs.Tween.get(ref, {override:true})
		 				.to({scaleX:1, scaleY:item_scale, x:move_x,y:move_y},duration).call(tweenComplete);
		depth--;
		
		
	}
			
}
/*text = new createjs.Text("asdflkajsdfhlkjadsh", "20px Arial", "#777");
	        text.x = 0;
	        text.y = 110;
	        stage.addChild(text)
			stage.update()*/

function tweenComplete() {
            activeCount--;	
        }
function tick() {
            if (activeCount) { stage.update(); }
			
        }
