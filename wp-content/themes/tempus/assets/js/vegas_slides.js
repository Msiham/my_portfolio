( function( $ ) {
	$(function() {
		$('body').vegas({
				slides: getSlides,
				delay: 7000,
				transition: 'fade',
				transitionDuration: 5000,
				overlay: getOverlay,
				animation: 'kenburns',
				walk: function (index, slideSettings) {
					$('#page-title h1').text(slidesAttr[index][0]);
					$('#page-title .subtitle p').text(slidesAttr[index][1]);
        	// console.log("Slide index " + index + " title " + slidesAttr[index][0] + " sub " + slidesAttr[index][1]);
    		}
		});
	});
} )( jQuery );
