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
							<p>Loading...</p>\
						</div>\
						<iframe src='http://hrf.li/bookmarklet?url="+url+"&type=html' onload=\"$('#hrfliframe iframe').slideDown(500);\">Enable iFrames.</iframe>\
						<style type='text/css'>\
							#hrfliframe_veil { display: none; position: fixed; width: 100%; height: 100%; top: 0; left: 0; background-color: rgba(255,255,255,.25); cursor: pointer; z-index: 900; }\
							#hrfliframe_veil p { color: black; font: normal normal bold 20px/20px Helvetica, sans-serif; position: absolute; top: 25%; left: 50%; width: 10em; margin: -10px auto 0 -5em; text-align: center; }\
							#hrfliframe iframe { display: none; position: fixed; top: 10%; left: 10%; width: 960px; height: 35%; z-index: 900; border: 10px solid rgba(0,0,0,.5); margin: -5px 0 0 -5px; }\
						    #hrfliframe .close { display: none; position: fixed; top: 12%; left: 83%; z-index: 999; opacity: 1; } \
						    #hrfliframe .close a { color: #41b7d8; }\
						</style>\
						<div class='close'><a href='#'>CLOSE</a></div>\
					</div>");
    $("#hrfliframe_veil").fadeIn(750);
    $("#hrfliframe  iframe").on('load', function(){
        $('#hrfliframe .close').fadeIn(750);
    });

    $("#hrfliframe .close a").click(function(event){

        $(this).hide();
        $("#hrfliframe iframe").slideUp(500);

        setTimeout("$('#hrfliframe').remove()", 750);

    });

});