/*
 * al3 Lightbox Scripts
 * Author: Laurens Lamberty
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 */

// LAZYLOAD IMAGES
var myLazyLoad = new LazyLoad({
    elements_selector: "img.lazy"
});

// Image Lightbox
function loadLightbox() {

baguetteBox.run('.gallery', {
    async: true,
    preload: 5,
    overlayBackgroundColor: 'rgba(255,255,255,0.9)'
});

} // End Lightbox


// All Regular jQuery
jQuery(document).ready(function($){

    // Load Lightbox on pages with lightbox (declared above)
    if( $('a.lightbox').length ){
        loadLightbox();
    }


}); //END JQUERY DOCUMENT READY
