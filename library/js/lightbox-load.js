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
$(function() {
    $("img.lazy").lazyload({
        effect : "fadeIn"
    });
});


// Gallery Effect
function loadGallery() {

    // get all images and iframes
    var $elems = $('.al-gallery').find('img');

    // count them
    var elemsCount = $elems.length;

    // the loaded elements flag
    var loadedCount = 0;

    // attach the load event to elements
    $elems.on('load', function () {

        // increase the loaded count
        loadedCount++;

        // if loaded count flag is equal to elements count
        if (loadedCount == elemsCount) {

            // slide gallery in
            $( ".al-gallery" ).slideDown( "slow" );

        }
    });
}

// Image Lightbox
function loadLightbox() {

    // ACTIVITY INDICATOR
    var activityIndicatorOn = function() {
        $( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
    },
        activityIndicatorOff = function() {
            $( '#imagelightbox-loading' ).remove();
        },


    // OVERLAY
    overlayOn = function() {
        $( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
    },
        overlayOff = function()	{
            $( '#imagelightbox-overlay' ).remove();
        },


    // CAPTION
    captionOn = function()	{
        var description = $( 'a[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
        if( description.length > 0 ) $( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
    },
        captionOff = function()	{
            $( '#imagelightbox-caption' ).remove();
        },


    // ARROWS
    arrowsOn = function( instance, selector ) {
        var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>' );
        $arrows.appendTo( 'body' );
        $arrows.on( 'click touchend', function( e ) {

            e.preventDefault();

            var $this	= $( this ),
                $target	= $( selector + '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ),
                index	= $target.index( selector );

                if( $this.hasClass( 'imagelightbox-arrow-left' ) ) {
                    index = index - 1;
                    if( !$( selector ).eq( index ).length )
                        index = $( selector ).length;
                } else {
                    index = index + 1;
                    if( !$( selector ).eq( index ).length )
                        index = 0;
                }

            instance.switchImageLightbox( index );
            return false;

        });

    },
        arrowsOff = function() {
            $( '.imagelightbox-arrow' ).remove();
        };


     //	SETUP
    var ilb_selector = 'a.lightbox';
	var ilb_instance = $( ilb_selector ).imageLightbox({
		onStart:		function(){ overlayOn(); arrowsOn( ilb_instance, ilb_selector ); },
		onEnd:			function(){ overlayOff(); arrowsOff(); activityIndicatorOff(); },
		onLoadStart: 	function(){ activityIndicatorOn(); },
		onLoadEnd:	 	function(){ $( '.imagelightbox-arrow' ).css( 'display', 'block' ); activityIndicatorOff(); }
	});

} // End Lightbox


// All Regular jQuery
jQuery(document).ready(function($){

    // Load Gallery (declared above)
    loadGallery();

    // Load Lightbox on pages with lightbox (declared above)
    if( $('a.lightbox').length ){
        loadLightbox();
    }


}); //END JQUERY DOCUMENT READY
