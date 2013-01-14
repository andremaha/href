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

getScript('http://stevenlevithan.com/demo/parseuri/js/assets/parseuri.js', function() {

});

getScript('http://hrf.li/js/libs/ZeroClipboard/ZeroClipboard.js', function() {

});

getScript('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', function(){




    var url = encodeURIComponent(location.href);
    var host = parseUri(url);
    var shortURL = 'http://hrf.li';

    ZeroClipboard.setDefaults( { moviePath: 'http://hrf.li/js/libs/ZeroClipboard/ZeroClipboard.swf', trustedDomains: [host.host] } );


    $("body").append("\
					<div id='hrfliframe'>\
						<div id='hrfliframe_veil' style=''>\
							<p>HREF is generating your URL...</p>\
						</div>\
						<div id='HrefGeneratedURL'>\
						</div>\
						<style type='text/css'>\
							#hrfliframe_veil { display: none; position: fixed; width: 100%; height: 100%; top: 0; left: 0; background-color: rgba(0,0,0,.4); cursor: pointer; z-index: 900; }\
							#hrfliframe_veil p { color: #f5f5f5; font: normal normal bold 20px/20px Helvetica, sans-serif; position: absolute; top: 23%; left: 53%; width: 10em; margin: -10px auto 0 -5em; text-align: center; background: rgba(0,0,0,.8); display: block; padding: 20px; border-radius: 15px; }\
					        #hrfliframe #HrefGeneratedURL { text-align: center; display: none; position: fixed; top: 10%; left: 30%; width: 40%; height: 20%; z-index: 900; border: 10px solid rgba(0,0,0,.5); margin: -5px 0 0 -5px; background: white; padding: 40px; border-radius: 15px; }\
					        #hrfliframe .link { color: #41b7d8; }\
						    #hrfliframe h1, h2 {display: block;\
                                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;\
                                font-size: 39px;\
                                font-weight: bold;\
                                height: 40px;\
                                left: auto;\
                                line-height: 40px;\
                                margin-bottom: 10px;\
                                margin-left: 0px;\
                                margin-right: 0px;\
                                margin-top: 10px;\
                                padding-bottom: 0px;\
                                padding-left: 0px;\
                                padding-right: 0px;\
                                padding-top: 0px;\
                                color: #333;\
                            }\
                            #hrfliframe h2 { font-size: 32px; }\
						</style>\
					</div>");
    $("#hrfliframe_veil").fadeIn(750);


    $("#hrfliframe_veil").click(function(event){
        animatePopup();
    });


    $.ajax({
        type: 'GET',
        url: 'http://hrf.li/jsonp?url='+url,
        dataType: 'jsonp',
        success: function (data) {
            shortURL += data.shortURL;
            receiveShortURL(shortURL);
            $("#HrefGeneratedURL").html("<h1 class='link'>" + shortURL + "</h1><h2>Click to copy to clipboard</h2>")
            $("#HrefGeneratedURL").fadeIn(750);
        },
        jsonp: 'callback'
    });


});

function receiveShortURL(url) {
    var clip = new ZeroClipboard();
    clip.setText(url);
    clip.glue($("#HrefGeneratedURL"));

    clip.on('complete', function(){
       $("#HrefGeneratedURL").html("<h1>URL was copied!</h1>");
       setTimeout(animatePopup, 800);
    });


}


function animatePopup() {
    $("#hrfliframe_veil").hide();
    $("#HrefGeneratedURL").slideUp(500);
    setTimeout("$('#hrfliframe').remove()", 750);
}