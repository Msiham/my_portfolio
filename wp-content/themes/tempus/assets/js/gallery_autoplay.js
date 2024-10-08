( function( $ ) {
	$(document).ready(function() {

		var owl = $(".owl-autoplay");
		owl.owlCarousel({
			autoplay:true,
    	autoplayTimeout:5000,
			animateOut: 'fadeOut',
			items:1,
			lazyLoad:true,
			nav:true,
			pagination:true,
			loop:true,
			rewind:true,
			dots:true,
			autoHeight:true,
			autoWidth:false
		});

	});
} )( jQuery );
