//yebeman
 	function postCmt(){

$('ul#results li:last-child img').attr('src',function(i,e){
$uimgSrc=e
})
$userName=$('ul#results li:last-child #userName').html();
$html = "";
$html += '<li style="padding-bottom:5px;" class="result" >';
$html += '<a target="_blank"  href="http://localhost/yc/'+$userName+'&lang=en">';
$html += '<img align="left" style=" border:none; padding:0px 5px 0px 0px;" height="40px" width="40px" src="'+$uimgSrc+'" alt="yebeman" />';
$html += '<h4>'+$userName+' <a style="float:right;">a moment ago</a></h4>';
$html += '<h3>'+$("#comment").val()+'</h3>';
$html += '<h4  style="color:#06C;" class="commentB"><br><span style="padding:0px 7px"></span></a></h4>';
$html += '</a>';
$html += '</li>';
		$("#comment").val(null);
		$("ul#results li:last-child").before($html);
		$("ul#results").scrollTop($("ul#results").height());
		
		
		}

	function showComment() {
		var query_value = "gmail";
		$('b#search-string').html(query_value);
	
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "readPhoto.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results").html(html);
					$("ul#results").scrollTop($("ul#results").height());
				}
			});
		}return false;    
	}
	

