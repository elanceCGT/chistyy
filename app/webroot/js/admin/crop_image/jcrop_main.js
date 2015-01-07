var i, ac;
var cropImgApi = null ;
// A handler to kill the action
function nothing(e) {
		e.stopPropagation();
		e.preventDefault();
		return false;
}

// Returns event handler for animation callback
function anim_handler(ac) {
		return function(e) {
				api.animateTo(ac);
				return nothing(e);
		};
}

function initializingCrop(){
	if( cropImgApi != null){
		cropImgApi.destroy();
	}
	cropImgApi = $.Jcrop('#cropbox1',{ 
			// we linking Jcrop to our image with id=cropbox1
			aspectRatio: 0,
			onChange: updateCoords,
			onSelect: updateCoords,
			aspectRatio: 1,
			setSelect: [0,0,100, 100],
			minSize   :[ 100, 100]	
	});
		
}
function updateCoords(c) {
	  $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);

    $('#x2').val(c.x2);
    $('#y2').val(c.y2);

		/*console.log("w->"+c.w);
		console.log("h->"+c.h);*/
    var rx = 100 / c.w; // 200 - preview box size
    var ry = 100 / c.h;
		/*
		gWIDTH = sizeArr[1];
		gHEIGHT = sizeArr[0];
		
		*/
		//alert(gWIDTH+" ffff "+gHEIGHT)
		/*alert(gWIDTH);
	alert(gHEIGHT);*/
		var actualW = gWIDTH; // 800 Actual
		var actualH = gHEIGHT; // 600 Actual
		
		 
		$('#preview').css({
        width: Math.round(rx * actualW) + 'px',
        height: Math.round(ry * actualH) + 'px',
        marginLeft: '-' + Math.round(rx * c.x) + 'px',
        marginTop: '-' + Math.round(ry * c.y) + 'px',
		/*webkitBorderRadius:'200px'*/
    });
		
		
		
    
};

function checkCoords() {
	if (parseInt($('#w').val())) return true;
	alert('Please select a crop region then press submit.');
	return false;
};