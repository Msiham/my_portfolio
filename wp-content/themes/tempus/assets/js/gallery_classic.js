( function( $ ) {

  $(document).ready(function() {
    tempus_classic_getCurrentItemHeight(classicGalleryID);
  });

  $(window).resize(function(){
    tempus_classic_getCurrentItemHeight(classicGalleryID);
  });

  function tempus_classic_getCurrentItemHeight( galleryID ) {
    if ($("div").is("#portfolio-gallery-wrapper-" + galleryID ) ) {
      $('.portfolio-gallery-item').each(function() {
        var $this = $(this);
        $(this).css({"height": $(this).width()});
      });
      $('.portfolio-gallery-item').each(function(fadeInDiv){
          $(this).delay(fadeInDiv * 50).fadeTo(250, 1);
      });
    }
  }
} )( jQuery );
