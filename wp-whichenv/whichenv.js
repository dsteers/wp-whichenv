jQuery( function ( $ ) {
	$( document ).ready(function() {
  		$( '.whichenv .urls input' ).attr('readonly',true);
	});

	$( '.url_standard' ).click(function(){
		$( '.whichenv .urls input' ).attr('readonly',true);
		$( '.whichenv .urls input' ).css('color','transparent');
	});

	// Activate or deactivate custom url options
	$( '.url_custom' ).click(function(){
		if ( $('.whichenv .url_options input').is('[readonly]') ) { 
			$( '.whichenv .url_options input' ).attr('readonly',false);
			$( '.whichenv .urls input' ).css('color','#262626');
		} 

		if($('input:checked').length > 0){
			$(this).addClass('checked');
		}
	});

});
