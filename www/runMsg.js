// JavaScript Document
var left = true;
var right = true;
var minimize = new Array(); // true;
var wrapT = false;
var msgC = 0;
var timeH = 0;
var creB = 10;
var sendto = "";
var deleted = 0;
currusr = 'yebe@gmail.com';
var oldId;
var msgS;
var wrapDB = false; //wrap data base
var oldIdS;
var prevMsg = "";
var dontRepeat = "";
var chatBoxNum;
var num = 0;
var topP = 200;
var date = new Date;
var c_name = "messenger";
var c_nameR = "messenger";
var msgr = [""];
var cont = 0
var talk = 0;
var talkT = 0;
var timer;
var from = []; //10;
var enabAut = [];
enabAut.push(true);
var curMsg = true;
var callServer = true;
var counterCo = 0;
var countInt = 0;
var firstT = -1;
var backNorm = false;
var storedNum = new Array(); // stores all num
var blockedMsgr = new Array();
var onceReciv = true;


// it's hidden, do something


$(window).bind('resize', function () {
    clearTimeout(timer);
    $('#fly').css('width', "100%");
    timer = setTimeout(CheckBrowserSize, 500);
});

function CheckBrowserSize() {


    var countB = 0;
    for (k = 0; k < num; k++) {
        var p = $("#tabs_wrapper" + k);
        var position = p.position();

        if (position.top > 0) {
            if (!$('#out' + k).is(':visible'))
                $('#out' + k).show();
            if ($('#out' + k).html() == null) {

                $("#outOS").html("<div id='out" + k + "' class='miniz' onClick='swapDiv(" + k + "," + storedNum[num - 1].name + ")'>" + $("#userMsg" + k).html() + "</div>" + $("#outOS").html());


            }
        } else {
            countB++;
            $("#out" + k).hide()
        }
    }

    $('#fly').width((countB - deleted) * (260 + 10))
    // how to make the box reapear back to its original place



}

function swapDiv(l, m) {
    // l and m are the num values so it increases every single instant


    div1 = $('#tabs_wrapper' + l);
    div2 = $('#tabs_wrapper' + m);

    tdiv1 = div1.clone();
    tdiv2 = div2.clone();

    if (!div2.is(':empty')) {
        div1.replaceWith(tdiv2);
        div2.replaceWith(tdiv1);

        //    tdiv1.addClass("replaced");
    }


    var swapper = minimize[l];
    minimize[l] = minimize[m];
    minimize[m] = swapper;

    var swapper = from[l];
    from[l] = from[m];
    from[m] = swapper;

    var swapper = enabAut[l];
    enabAut[l] = enabAut[m];
    enabAut[m] = swapper;

    var swapper = storedNum[l]; // proved text area needs it
    storedNum[l] = storedNum[m];
    storedNum[m] = swapper;

    var swapper = blockedMsgr[l];
    blockedMsgr[l] = blockedMsgr[m];
    blockedMsgr[m] = swapper;

    var swapper = msgr[l];
    msgr[l] = msgr[m];
    msgr[m] = swapper;


    //scrollMsgr(y, x)
    //scrollMsgr(y, x)

    //alert(l+"a"+m)
    scrollMsgr(l, l)
    scrollMsgr(m, m)
    CheckBrowserSize()
    bindText();


}

function crtCB(sendt) {
    minimize[num] = true;
    createCookie(c_name, sendt, 1);
}

readCookie();
///// same accross all tabs
function createCookie(name, value, days) {
    //backNorm = true;
    var array = new Array();

    var valueToPush1 = {};
    if (msgr.length > 1)
        for (var i in msgr) {
            if (msgr.length - 1 > i) {
                var valueToPush = {};
                valueToPush[name] = name;
                valueToPush["value"] = msgr[i];
                array.push(valueToPush);
            }
        }

    valueToPush1[name] = name;
    valueToPush1["value"] = value;
    array.push(valueToPush1);
    localStorage.setItem(name, JSON.stringify(array));
    readCookie();

}




function readCookie() {
    //alert("shitd"+talkT)
    var make = false;

    var items = localStorage.getItem(c_name);
    items1 = JSON.parse(items)
    if (talkT == items1.length + 1) {

        var deleteA = false;
        var tempName = 0;
        var tempArr = 0;
        var tempArray = new Array();
        //alert(items1.length)


        if (items1.length == 0) {
            deleteA = true;
            tempName = storedNum[0].name;
            tempArr = 0;
        } else {
            for (var msgN in items1) {
                tempArray[msgN] = items1[msgN].value

                for (var msgN in storedNum)
                    if ($.inArray(storedNum[msgN].value, tempArray) < 0) { //alert("yebe")
                        deleteA = true;
                        tempName = storedNum[msgN].name;
                        tempArr = msgN;
                        break
                    }
            }
        }


        if (deleteA) {
            deleteBox(tempName);
            removeA(msgr[tempArr])

        }
    } else if (items && items1.length > talkT) {
        for (var msgN in items1) {

            make = false;
            var jk = "";
            for (var i = talk; i < msgr.length; i++) {
                msgr[i] = items1[talk].value;
                from[i] = 10;
                talk += 1;
                make = true;

            }



            if (make) {
                sendto = items1[talk - 1].value;
                //alert("shit1")
                $.ajax({
                    type: "POST",
                    url: "mssgOrgan.php",

                    data: {
                        emailAddress: currusr, // remove since php cookies
                        sendTo: sendto,
                        chatBoxNum: num
                    },
                    success: function (html) {
                        var leftP = getPos(num);
                        $("#fly").prepend(html);


                        enabAut.push(true);
                        blockedMsgr.push(true);

                        //	timerRMsg.push('');
                        sendMsg()
                        $('#fly').css('width', "100%");
                        CheckBrowserSize()
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {}
                });


                //storedNum.push(num);
                var valueToPush = {};
                valueToPush["name"] = num;
                valueToPush["value"] = sendto;
                storedNum.push(valueToPush);



                num++;
                msgr.push("") //create a new variable
                from.push(10);
            }
            if (items1.length == talk) {

                break;

            }
        }

        talkT = msgr.length - 1;
    }

}

function sendMsg() {



    $(function () {

        $('li').click(function (e) {

            var selected_tab = $(this).find("a").attr("href");
            if (selected_tab == dontRepeat) return false;
            dontRepeat = selected_tab;
            var boxN = selected_tab.substring(5);
            if (!minimize) minim();
            $('#tabs_container' + boxN + ' li').addClass("selected");
            $(this).removeClass("selected");
            var p = $(this);
            var position = p.position();

            $('#tabs' + boxN + ' .tab_content').hide();

            $(selected_tab).fadeIn();

            var tabN = selected_tab.substring(4, 5)
            if (tabN == 1) {
                $('#tabb' + 1 + boxN).css('left', "20px");
                $('#tabb' + 1 + boxN).css('height', "31px");
                $('#tabb' + 1 + boxN).css('font-size', "20px");
                $('#tabb' + 2 + boxN).css('font-size', "18px");
                $('#tabb' + 2 + boxN).css('height', "28px");
                $('#tabb' + 2 + boxN).css('left', "-20px");
                $('#tabb' + 3 + boxN).css('left', "0px");
                $('#tabb' + 3 + boxN).css('height', "28px");
                $('#tabb' + 3 + boxN).css('font-size', "18px");
            } else if (tabN == 2) {
                $('#tabb' + 1 + boxN).css('left', "0px");
                $('#tabb' + 1 + boxN).css('height', "28px");
                $('#tabb' + 1 + boxN).css('font-size', "18px");
                $('#tabb' + 2 + boxN).css('font-size', "20px");
                $('#tabb' + 2 + boxN).css('left', "0px");
                $('#tabb' + 2 + boxN).css('height', "31px");
                $('#tabb' + 3 + boxN).css('left', "0px");
                $('#tabb' + 3 + boxN).css('height', "28px");
                $('#tabb' + 3 + boxN).css('font-size', "18px");
            } else {
                $('#tabb' + 1 + boxN).css('left', "0px");
                $('#tabb' + 1 + boxN).css('height', "28px");
                $('#tabb' + 1 + boxN).css('font-size', "18px");
                $('#tabb' + 3 + boxN).css('left', "-20px");
                $('#tabb' + 3 + boxN).css('height', "31px");
                $('#tabb' + 3 + boxN).css('font-size', "20px");
                $('#tabb' + 2 + boxN).css('left', "+20px");
                $('#tabb' + 2 + boxN).css('height', "28px");
                $('#tabb' + 2 + boxN).css('font-size', "18px");
            }

        });
    });

    bindText();
    // if (!backNorm)


}

function bindText() {
    $('textarea').bind('keypress', function (e) {
        curMsg = false;
        var code = e.keyCode ? e.keyCode : e.which;
        if (code == 13) {
            var id = $(this).attr('id').substring(7);
            var msg = $("#txtArea" + id).val();
            // sometimes after a long space entering a value wont show it.
            if ($.trim(msg) == "") return false;

            var tempN;
            for (var msgN in storedNum)
                if (storedNum[msgN].name == id)
                    tempN = storedNum[msgN].value

            $.ajax({
                type: "POST",
                url: "sendMessage.php",
                data: {
                    emailAddress: currusr, //remove
                    messageT: $("#txtArea" + id).val(),
                    sendTo: tempN,
                    type: "privatemsg"
                },
                cache: false,
                success: function (html) {


                    $("span").html("sent");
                }
            });

            $("#txtArea" + id).val('');
            $("#tab2" + id).scrollTop(0)
            return false;
        }
    });


    onceReciv = true;
    getMsg(counterCo++, countInt++)

}

function getMsg(y, x) {
    //alert(msgr[y]+" "+x+" ")

    $.ajax({
        type: "POST",
        url: "prevMessages.php",
        data: {
            emailAddress: currusr, // remove
            sendTo: msgr[y],
            From: from[y],
            x: x,
            y: y,
        },
        cache: false,

        success: function (data) {
            var json = JSON.parse(data);

            oldIdS = json[0]['maxlng'];

            for (var msgN in json) {
                if (typeof json[msgN]['message'] !== 'undefined') {
                    if (json[msgN]['sender'] == msgr[json[0]['y']]) {
                        $("#tab2" + json[0]['x']).html($("#tab2" + json[0]['x']).html() + "<div id='P' class='formatR'>" + json[msgN]['message'] + '</br>' + json[msgN]['time'] + json[msgN]['status'] + "</div>");
                    } else $("#tab2" + json[0]['x']).html($("#tab2" + json[0]['x']).html() + "<div id='P' class='formatL'>" + json[msgN]['message'] + '</br>' + json[msgN]['time'] + json[msgN]['status'] + "</div>");
                    enabAut[y] = true // set for scrolling
                } else if (json.length <= 1) enabAut[y] = false;
            }
            //  if (callServer) {
            //alert(onceReciv)
            if (onceReciv)
                reciveMsg(json[0]['y'], json[0]['x'], json[0]['maxlng']);

            //callServer = false
            //}
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function () {
                reciveMsg(y, x);
            }, 15000)
        }

    })

    if (y > firstT) {
        firstT++;
        scrollMsgr(y, x)
        //alert("hey")
    }
}

function scrollMsgr(y, x) {

    $("#tab2" + x).scroll(function () {
        if ($("#tab2" + x).scrollTop() + $("#tab2" + x).height() >= $("#tab2" + x).prop('scrollHeight') && enabAut[y]) { //alert(y +"a"+firstT)
            from[y] += 10;
            //
            onceReciv = false;
            enabAut[y] = false;
            getMsg(y, x)
        }
    })

}

function reciveMsg(y, x, old) {

    $.ajax({
        type: "POST",
        url: "receiveMessage.php",
        data: {
            emailAddress: currusr, //remove
            sendTo: msgr[y],
            oldIdS: old,
            x: x,
            y: y,
        },
        async: true,
        cache: false,

        success: function (data) {

            var json1 = JSON.parse(data);
            if (json1[0]['maxlng'] > oldIdS) {
                for (var msgN in json1) {
                    if (typeof json1[msgN]['message'] !== 'undefined') {
                        var msg = json1[msgN]['message'];
                        var time = json1[msgN]['time'] + "" + json1[msgN]['status'];
                        var msgS = json1[msgN]['sender'];
                        if (msg !== "undefined" && msgS != currusr) {
                            $("#tab2" + json1[0]['x']).html("<div id='P' class='formatR'>" + msg + '</br>' + time + "</div>" + $("#tab2" + json1[0]['x']).html());
                            wrapT = false; //break the msg

                        } else if (msg !== "undefined" && msgS == currusr) {
                            $("#tab2" + json1[0]['x']).html("<div id='P' class='formatL'>" + msg + '</br>' + time + "</div>" + $("#tab2" + json1[0]['x']).html());

                        }
                    }
                }
            }
            oldIdS = json1[0]['maxlng'];

            if (blockedMsgr[x]) {
                setTimeout(function () {
                    reciveMsg(json1[0]['y'], json1[0]['x'], json1[0]['maxlng']);
                }, 4000)
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function () {
                reciveMsg(y, x);
            }, 15000)
        }
    })
}


function minim(id) {
    if (minimize[id]) {
        $("#tabs" + id).hide();
        $("#txtA" + id).hide();
        $('#tabs_wrapper' + id).css('margin-top', '+=310px');
        minimize[id] = false;

    } else {
        $("#tabs" + id).show();
        $("#txtA" + id).show();
        $('#tabs_wrapper' + id).css('margin-top', '0');
        minimize[id] = true;
    }
}

function removeA(val) {
    for (var i = 0; i < msgr.length; i++) {
        if (msgr[i] == val) {
            from.splice(i, 1);
            msgr.splice(i, 1);
            break;
        }
    }
    for (var i = 0; i < storedNum.length; i++) {
        if (storedNum[i].value == val) {
            storedNum.splice(i, 1);
            break;
        }
    }

}

function closeM(id, uName) {

    var array = new Array();
    if (msgr.length > 1)
        for (var i in msgr) {
            if (uName != msgr[i] && msgr.length - 1 > i) {
                var valueToPush = {};
                valueToPush[name] = c_name;
                valueToPush["value"] = msgr[i];
                array.push(valueToPush);
            }
        }
    localStorage.setItem(c_name, JSON.stringify(array));


    deleteBox(id);
    removeA(uName)
}


function deleteBox(id) {

    talk--;
    firstT--;
    counterCo--;
    talkT--;
    blockedMsgr[id] = false;
    $("#tabs_wrapper" + id).html(null)
    $("#tabs_wrapper" + id).hide();
    $("#out" + id).html(null)
    $("#out" + id).hide();
    deleted++;
    for (var x = (id + 1); x <= num; x++) {
        $("#tabs_wrapper" + x).css('left', '+=260');
    }
    CheckBrowserSize()
}

function getPos(num) {
    return window.innerWidth - (260 * (num - deleted))
}