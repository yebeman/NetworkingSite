	function smtg() {
    if(Modernizr.history){
		
    var newHash      = "",
        $mainContent = $("#main-content"),
        $pageWrap    = $("#page-wrap"),
        baseHeight   = 0,
        $el;
        
    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();
    
    $("nav").delegate("a", "click", function() {
        _link = $(this).attr("href");
        history.pushState(null, null, _link);
		
        loadContent(_link);
        return false;
    });

    function loadContent(href){
		
		
		
        $mainContent
                .find("#guts")
                .fadeOut(200, function() {
                   $mainContent.hide()
				   .load(href + " #guts", function() {
                        $mainContent.fadeIn(200, function() {
                            $pageWrap.animate({
                                height: baseHeight + $mainContent.height() + "px",
								top: 55+"px"
                            });
                        });
						var content = new createjs.DOMElement("#guts");
				content.regX = 0;
				content.regY =0;
				content.x=0;
				content.y=0;
						
						
                        $("nav a").removeClass("current");
                        console.log(href);
                        $("nav a[href$="+href+"]").addClass("current");
                    });
					
                });
				//stage.addChild(getElementById("page-wrap"));
				
    }
    
    $(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
       loadContent(_link);
    });

} // otherwise, history is not supported, so nothing fancy here.

    
};