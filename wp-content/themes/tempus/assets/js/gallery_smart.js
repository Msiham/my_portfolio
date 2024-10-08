( function( $ ) {
  $(document).ready(function() {
    tempus_getSmartItemHeight(smartGalleryID);
  });

  $(window).resize(function(){
    tempus_getSmartItemHeight(smartGalleryID);
  });

  function tempus_getSmartItemHeight(galleryID) {
    if ($("#portfolio-gallery-wrapper-" + galleryID).length > 0 ) {
      $('.gallery-itemid-' + galleryID).each(function() {
        var $this = $(this);
        $(this).css({"height" : $(this).parent().width()/3})
      })
    }
  }
} )( jQuery );
