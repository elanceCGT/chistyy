$(function(){

  $('.nano').nanoScroller({
    preventPageScrolling: true
  });
  $("#main").find('.description').load("readme.html", function(){
    $(".nano").nanoScroller();
    $("#main").find("img").load(function() {
        $(".nano").nanoScroller();
    });
  });


});


/* 
Check for number input only
@parameters 
	: e => event
	: intOnly (true/false) => integer num only OR can have decimal
	: onlyPositive (true/false) => can have +sign (- not allowed)
*/
function check_numsOnly(e, intOnly, onlyPositive){
	var evt=e || window.event;
	var keypressed=evt.which || evt.keyCode;
	if ( evt.key && evt.key=='Del' ) return true;
	if ( intOnly && keypressed==46 ) return false;
	if ( !intOnly && keypressed==46 && e.target.value.indexOf('.')!=-1) return false; // already have a decimal
	if ( onlyPositive && keypressed==45) return false;
	
	var keys = [48,49,50,51,52,53,54,55,56,57,46,45,43,8,9,39,37];
	if ( (indexOf.call(keys,keypressed)!=-1 && !e.shiftKey) || (e.shiftKey && keypressed==9) ) {
		return true;
	} else {
		return false;
	}
}


/* 
For value check in array without using jQuery;
*/
var indexOf = function(needle) {
    if(typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;
            for(i = 0; i < this.length; i++) {
                if(this[i] === needle) {
                    index = i;
                    break;
                }
            }
            return index;
        };
    }
    return indexOf.call(this, needle);
};