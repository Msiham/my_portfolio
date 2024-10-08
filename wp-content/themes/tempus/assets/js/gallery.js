( function( $ ) {

	$('.owl-theme').owlCarousel({
		items:1,
		lazyLoad:true,
		navigation:!0,
		pagination:!0,
		slideSpeed:800,
		dots:0,
		autoHeight:!0,
		singleItem:!0,
		autoWidth:true,
		loop:true,
		rewind:false
	})

	$('.justified-gallery').justifiedGallery({
		rowHeight : 200,
		maxRowHeight : 300,
		lastRow : 'justify',
		margins : 0,
		captions : false
	});

} )( jQuery );
