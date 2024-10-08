( function( $ ) {
  $(document).ready(function() {
    tempus_getMasonryHeight(masonryGalleryID);
    tempus_getMasonryGallery(masonryGalleryID);
  });

  $(window).resize(function(masonryGalleryID){
    tempus_getMasonryHeight(masonryGalleryID);
  });

  function tempus_getMasonryHeight(galleryID) {
    $('.item-' + galleryID).each( function() {
      var ratio = $( this ).attr( 'data-ratio' );
      var img_width = $( this ).width();

      if ( ratio > 1 ) {
        var div_height = img_width / ratio;
      } else {
        var div_height = img_width / ratio;
      }

      $( this ).css( { 'height': Math.floor( div_height ) } );
    });
  }

  function tempus_getMasonryGallery(galleryID) {
    // $('.portfolio-gallery-item').each(function(){
    //     $(this).css({"opacity":0});
    // });
    // $('#portfolio-gallery-wrapper-' + galleryID).imagesLoaded().always(function() {
      $('#portfolio-gallery-wrapper-' + galleryID).masonry( {
        itemSelector: '.portfolio-gallery-item, .item-' + galleryID,
      });
    // });
    $('.portfolio-gallery-item').each(function(fadeInDiv){
        $(this).delay(fadeInDiv * 50).fadeTo(250, 1);
    });
  }

} )( jQuery );
