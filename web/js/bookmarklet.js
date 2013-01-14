// getScript()
// more or less stolen form jquery core and adapted by paul irish

function getScript(url,success){

    var head = document.getElementsByTagName("head")[0], done = false;
    var script = document.createElement("script");
    script.src = url;



    // Attach handlers for all browsers
    script.onload = script.onreadystatechange = function(){
        if ( !done && (!this.readyState ||
            this.readyState == "loaded" || this.readyState == "complete") ) {
            done = true;
            success();
        }
    };


    head.appendChild(script);

}

// usage:
getScript('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js',function(){

    var url = encodeURIComponent(location.href);

    $("body").append("\
					<div id='hrfliframe'>\
						<div id='hrfliframe_veil' style=''>\
							<p>HREF is generating your URL...</p>\
						</div>\
						<iframe src='http://hrf.li/bookmarklet?url="+url+"&type=html' onload=\"$('#hrfliframe iframe').fadeIn(500);\">Enable iFrames.</iframe>\
						<style type='text/css'>\
							#hrfliframe_veil { display: none; position: fixed; width: 100%; height: 100%; top: 0; left: 0; background-color: rgba(0,0,0,.4); cursor: pointer; z-index: 900; }\
							#hrfliframe_veil p { color: #f5f5f5; font: normal normal bold 20px/20px Helvetica, sans-serif; position: absolute; top: 25%; left: 50%; width: 10em; margin: -10px auto 0 -5em; text-align: center; background: rgba(0,0,0,.8); display: block; padding: 20px; border-radius: 15px; }\
					        #hrfliframe iframe { display: none; position: fixed; top: 10%; left: 20%; width: 60%; height: 35%; z-index: 900; border: 10px solid rgba(0,0,0,.5); margin: -5px 0 0 -5px; }\
					        #hrfliframe .close { display: none; position: fixed; top: 12%; left: 74%; z-index: 999; opacity: 1; font-size: 18px; } \
					        #hrfliframe .close a { color: #41b7d8; }\
						</style>\
						<div class='close'><a href='#'>CLOSE</a></div>\
					</div>");
    $("#hrfliframe_veil").fadeIn(750);
    $("#hrfliframe  iframe").on('load', function(){
        $('#hrfliframe .close').fadeIn(750);
    });

    $("#hrfliframe_veil").click(function(event){
        animatePopup();
    });

    $("#hrfliframe .close a").click(function(event){
        animatePopup();
    });



});

function animatePopup() {
    $('#hrfliframe a').hide();
    $("#hrfliframe_veil").hide();

    $("#hrfliframe iframe").slideUp(500);

    setTimeout("$('#hrfliframe').remove()", 750);
}