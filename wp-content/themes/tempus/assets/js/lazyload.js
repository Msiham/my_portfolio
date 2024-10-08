( function( $ ) {

	"use strict";

	$( window ).load( function() {
		$( '#loader' ).delay( 150 ).fadeOut( 500 );
		$( '.loader-spinner' ).fadeOut();

		/*$( 'a:not([target="_blank"]):not([href*=#]):not([href^=mailto]):not(a[href$="jpg"]):not([href$="jpeg"]):not(a[href$="gif"]):not(a[href$="png"])' ).click( function() {
			var href = $( this ).attr( 'href' );
			$( '#loader, .loader-spinner' ).fadeIn( 200 );
			setTimeout( function() {
				window.location = href;
			}, 250 );
			return false;
		} );*/

		window.onpageshow = function( event ) {
			if ( event.persisted ) {
				$( '#loader' ).delay( 150 ).fadeOut( 500 );
				$( '.loader-spinner' ).fadeOut();
			}
		};
	} );

} )( jQuery );
