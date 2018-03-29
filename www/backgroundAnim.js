/*
 * Backgroud Animation 1.1
 * objective : minimize the code length from 278
             : remove canvas use
			 : efficiency
 * Copyright (c) 2013 yachatt.com, inc.
 * yebeltal Asseged
 */
var canvas, stage, pageCount = 2,
    tweens, x_pos_array = [],
    y_pos_array = [],
    scale_array = [],
    side_item_count = 1,
    setFP = 1, // seting the first page 
    sideAdj = 0,
    side_item_scale = 0.85,
    decrement = 0.9,
    scale_diff = 0.08, //.15
    total_items,
    duration = 300,
    pageRect, current_item_no = -1,
    previou_item_no = -1,
    pageheight = 410,
    pageW = window.innerWidth,
    pageWidth = 920,
    yPos = 4,
    move_y = yPos,
    activeCount,
    item_scale = 1,
    item_index, item_depth, item_alpha, depth, currPage,
    piecesW;
    pagePref = setFP,
    pageAddHold = [],
    item_x_spacing = Math.round(((0.95 * pageW - pageWidth) - 20) / 2),
    xPos = (10 + item_x_spacing), //Math.round((pageW -     (pageWidth+(item_x_spacing*2))) / 3+515),
    move_x = xPos,
    maskPage, reloadLt = false,
    img;
    $piecesW = array();

function CheckBrowserSize() {
    side_item_scale = 0.85;
    decrement = 0.9;
    scale_diff = 0.08;
    sideAdj = 0;
    mov_y = yPos
    yPos = 4;
    activeCount;
    item_scale = 1;
    pageheight = 410;
    var pw = window.innerWidth;
    pageWidth = 920;
    canvas.height = 420;
    canvas.width = 0.95 * pw;
    item_x_spacing = Math.round(((0.95 * pw - pageWidth) - 20) / 2),
    xPos = (10 + item_x_spacing);
    for (i = 0; i < total_items; i++)
        add_content(i, false);
    fill_arrays();
    stack_flow(setFP)

}

function init() {
       $.post('imageAna.php', {}, function (output) {
        $piecesW = output.split(",");
        total_items = $piecesW.length;
        activeCount = total_items;
        get()
    });
}


function get() {
    var timer;
    $(window).bind('resize', function () {
        timer && clearTimeout(timer);
        timer = setTimeout(CheckBrowserSize, 500);
    });



    canvas = document.getElementById("testCanvas");
    stage = new createjs.Stage(canvas);


    canvas.height = 420;
    canvas.width = 0.95 * pageW; //item_x_spacing*3+pageWidth+5 ;

    stage.enableDOMEvents(true);
    stage.enableMouseOver(10);
    tweens = [];
    createjs.Touch.enable(stage);
    createjs.Ticker.addEventListener("tick", tick);


    img = new Image();
    img.src = "images/loader.gif";

    for (i = 0; i < total_items; i++)
		add_content(i, true);
    fill_arrays();
    reloadLt = true;
    stack_flow(setFP)
}

function add_content(item_no, repeated) {
    pageRect = new createjs.Shape();
    pageRect.graphics.beginStroke("#78AB46").setStrokeStyle(1).beginFill("#FFF").    drawRoundRect(xPos, yPos, pageWidth, pageheight, 20);
    pageRect.snapToPixel = true;
    pageRect.shadow = new createjs.Shadow("#AAAAAA", 0, 0, 10);

    pageRect.name = "rect";
    pageRect.snapToPixel = true;

    var loadd = new createjs.Bitmap(img);
    loadd.name = "loader"
    loadd.x = xPos + (pageWidth - 50) / 2;
    loadd.y = yPos + (pageheight - 50) / 2;
    if (repeated) {
        var container = new createjs.Container();

        //if (setFP == item_no) {	

        document.getElementById("target1").style.display = "none";


        var ph = new Image();
        ph.src = "images/" + $piecesW[item_no] //+piecesW[item_no];
        var content = new createjs.Bitmap(ph);
        content.x = xPos + (pageWidth - 900) / 2;
        content.y = yPos + (pageheight - 400) / 2;
        content.name = "1";
        content.snapToPixel = true;
        container.addChild(pageRect, loadd, content);
        //} else container.addChild(pageRect,loadd);

        container.name = item_no;
        container.snapToPixel = true;
        // container.cache(0,0,canvas.width,canvas.height)
        tweens.push({
            ref: container,
            name: content
        });
        stage.addChild(container);
    } else {
        try {
            tweens[item_no].ref.removeChild(tweens[item_no].ref.getChildByName("rect"))
            tweens[item_no].ref.addChild(pageRect);
            tweens[item_no].ref.getChildByName("1").x = xPos + (pageWidth - 900) / 2;
            tweens[item_no].ref.getChildByName("loader").x = xPos + (pageWidth - 900) / 2;
            tweens[item_no].ref.setChildIndex(tweens[item_no].ref.getChildByName("rect"), 0)

        } catch (err) {}
    }
}

function handleMouseUp(event) {
    if (currPage != event.target.name) {
        setFP = event.target.name
        stack_flow(setFP)
    }
}

function fill_arrays() {
    var column, power = 1,
        sum_x = item_x_spacing;
    var sideAdj = [20, 25, 25, 30, 50, 50, 60, 60, 60, 60, 60, 60, 60]

    x_pos_array = [total_items];
    x_pos_array[0] = sum_x;
    scale_array = [total_items];
    scale_array[0] = side_item_scale;

    for (column = 1; column < total_items; column++) {
        power *= decrement;
        sum_x += Math.round(item_x_spacing * power);
        side_item_scale -= scale_diff;
        x_pos_array[column] = sum_x;
        scale_array[column] = side_item_scale;
        y_pos_array[column - 1] = sideAdj[Math.floor(pageheight / 100)]
    }
}

function stack_flow(curr) {
    item_alpha = 1;
    depth = total_items - 1
    current_item_no = curr;
    item_scale = 1;

    for (i = current_item_no - 1; i >= 0; i--) {
        if (total_items == 1)
            continue;
        item_alpha = 1
        item_index = current_item_no - i - 1; //0	
        var ref = tweens[i].ref
        move_x = -x_pos_array[item_index];
        move_y = y_pos_array[item_index];
        item_scale = scale_array[item_index];

        if (item_index >= side_item_count)
            item_alpha = 0;
        else {
            ref.addEventListener("click", handleMouseUp);
            ref.cursor = 'pointer';
        }

        ref.alpha = item_alpha;
        stage.setChildIndex(ref, depth);
        var tween = createjs.Tween.get(ref, {
            override: true
        })
            .to({
                scaleX: 1,
                scaleY: item_scale,
                x: move_x,
                y: move_y
            }, duration, createjs.Ease.quartOut).call(tweenComplete);
        depth--
    }
    activeCount = total_items + 1;
    depth = total_items - 1;
    for (i = current_item_no; i < total_items; i++) {
        item_alpha = 1;
        item_index = i - current_item_no - 1; //1
        var ref = tweens[i].ref;

        if (item_index == -1) {
            move_x = 0;
            move_y = yPos;
            item_scale = 1;
            currPage = i;
            ref.removeEventListener("click", handleMouseUp);

            ref.cursor = 'cursor';
        } else if (item_index < side_item_count) {
            move_x = x_pos_array[item_index];
            move_y = y_pos_array[item_index];
            item_scale = scale_array[item_index];
            ref.addEventListener("click", handleMouseUp);
            ref.cursor = 'pointer';
        } else {
            move_x = x_pos_array[item_index];
            move_y = y_pos_array[item_index];
            item_scale = scale_array[item_index];
            item_alpha = 0;
        }

        ref.alpha = item_alpha;
        stage.setChildIndex(ref, depth);

        var tween = createjs.Tween.get(ref, {
            override: true
        })
            .to({
                scaleX: 1,
                scaleY: item_scale,
                x: move_x,
                y: move_y
            }, duration).call(tweenComplete);
        depth--;
    }
}

function tweenComplete() {
    activeCount--;
}

function tick() {
    if (activeCount) {
        stage.update();
        if (activeCount == 1)
            activeCount--;
    }
}