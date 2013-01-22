jQuery(document).ready(function($){

    $('#why_register').addimagezoom({ // single image zoom
        zoomrange: [3, 10],
        magnifiersize: [519,213],
        magnifierpos: 'left',
        cursorshade: true,
        largeimage: largePromoImage //<-- No comma after last option!
    })
});