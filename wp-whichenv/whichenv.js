jQuery( function ( $ ) {
	$( document ).ready(function() {
  		$( '.whichenv .urls input' ).attr('readonly',true);
	});
	/*TODO:
		1. On page load, test to see if is standard rp3 or not, and allocate checked and readonly accordingly
		2.
	*/

	/*on checkbox click
		1. set option for checkbox, 
		2. add class to lower section to hide or make all inputs readonly,
		3. 
	*/
	$( '.url_standard' ).click(function(){
		$( '.whichenv .urls input' ).attr('readonly',true);
	});

	// Activate or deactivate custom url options
	$( '.url_custom' ).click(function(){
		if ( $('.whichenv .url_options input').is('[readonly]') ) { 
			$( '.whichenv .url_options input' ).attr('readonly',false);
		} 

		if($('input:checked').length > 0){
			$(this).addClass('checked');
		}
	});

});


// Maybe remove me later but first understand whats happening here
// URL encode plugin
jQuery.extend({URLEncode:function(c){var o='';var x=0;c=c.toString();var r=/(^[a-zA-Z0-9_.]*)/;
  while(x<c.length){var m=r.exec(c.substr(x));
    if(m!=null && m.length>1 && m[1]!=''){o+=m[1];x+=m[1].length;
    }else{if(c[x]==' ')o+='+';else{var d=c.charCodeAt(x);var h=d.toString(16);
    o+='%'+(h.length<2?'0':'')+h.toUpperCase();}x++;}}return o;}
});
