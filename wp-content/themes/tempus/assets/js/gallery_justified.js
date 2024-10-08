( function( $ ) {

  $(document).ready(function() {
    tempus_GetJustified(justifiedGalleryID);
  });

  function tempus_GetJustified(galleryID) {
    var currentHeight = $('.portfolio-item').width()/3-12;
    $('.justified-gallery-' + galleryID).justifiedGallery({
      rowHeight : currentHeight,
      maxRowHeight : 200,
      lastRow : 'justify',
      margins : 2,
      captions : false
    });
  }

} )( jQuery );
