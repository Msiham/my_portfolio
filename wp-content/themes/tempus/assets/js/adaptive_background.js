( function( $ ) {
	$(document).ready(function(){
		$.adaptiveBackground.run();
		$('.pointy-half-block.image:not(.custom-background)').on('ab-color-found', function(ev,payload){
			$(this).closest('li').find('.added-background').css({ 'background' : payload.color });
		});
	});
} )( jQuery );
