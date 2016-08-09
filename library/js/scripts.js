/*
 * al3 Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 */

/*
 * Loading the webfonts early using the webfont loader. Read more at
 * https://github.com/typekit/webfontloader
 *
 */

// Load Webfonts
WebFontConfig = {
    google: {
        families: ['Lato:400', 'Signika:700']
    }
};

(function(d) {
   var wf = d.createElement('script'), s = d.scripts[0];
   wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
   s.parentNode.insertBefore(wf, s);
})(document);

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */
function updateViewportDimensions() {
    var w = window,
        d = document,
        e = d.documentElement,
        g = d.getElementsByTagName('body')[0],
        x = w.innerWidth || e.clientWidth || g.clientWidth,
        y = w.innerHeight || e.clientHeight || g.clientHeight;
    return {
        width: x,
        height: y
    }
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
 */
function loadGravatars() {
    // set the viewport using the function above
    viewport = updateViewportDimensions();
    // if the viewport is tablet or larger, we load in the gravatars
    if (viewport.width >= 768) {
        jQuery('.comment img[data-gravatar]').each(function () {
            jQuery(this).attr('src', $(this).attr('data-gravatar'));
        });
    }
} // end function

function loadMenu () {

    // Variables
    var $lateral_menu_trigger = $('#menu-trigger'),
		$content_wrapper = $('.main-content'),
		$navigation = $('#inner-header');

    // open-close lateral menu clicking on the menu icon
	$lateral_menu_trigger.on('click', function(event){
        event.preventDefault();

		$lateral_menu_trigger.toggleClass('is-clicked');
		$('#lateral-nav').toggleClass('lateral-menu-is-open');

		//check if transitions are not supported - i.e. in IE9
		if($('html').hasClass('no-csstransitions')) {
			$('body').toggleClass('overflow-hidden');
		}
	});

	// close lateral menu clicking outside the menu itself
	$content_wrapper.on('click', function(event){
		if( !$(event.target).is('#menu-trigger, #menu-trigger span') ) {
			$lateral_menu_trigger.removeClass('is-clicked');
			$('#lateral-nav').removeClass('lateral-menu-is-open');
			//check if transitions are not supported
			if($('html').hasClass('no-csstransitions')) {
				$('body').removeClass('overflow-hidden');
			}

		}
	});


	//open (or close) submenu items in the lateral menu. Close all the other open submenu items.
	$('#lateral-nav .menu-item-has-children').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('#lateral-nav .menu-item-has-children').siblings('#lateral-nav .menu-item-has-children').children('a, button').removeClass('submenu-open').next('.sub-menu').slideUp(200);
	});


    // CHRONICLE MENU

    // wrap similar elements to submenu
    var collection = [];

    $('.chronicle-entry').each(function() {
        var nextBox = $(this).next().hasClass('chronicle-entry');

        collection.push($(this));

        if(!nextBox)
        {
            var container = $('<div class="sub-menu chronicle-wrap"></div>');
            container.insertBefore(collection[0]);
            for(i=0;i<collection.length;i++)
            {
                collection[i].appendTo(container);
            }
            collection = [];
        }
    })

    //open (or close) submenu items in the lateral menu. Close all the other open submenu items.
	$('.chronicle a.has-children').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200);
	});

    // Leave the first submenu open
    $('.chronicle a.has-children:first-of-type').addClass('submenu-open');


} // End Menu

function loadSearch () {
    var submitIcon = $('.sb-icon-search');
    var inputBox = $('.sb-search-input');
    var searchBox = $('.sb-search');

    var isOpen = false;

    submitIcon.click(function(){
        if(isOpen == false){
            searchBox.addClass('sb-search-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('sb-search-open');
            inputBox.focusout();
            isOpen = false;
        }
    });

    submitIcon.mouseup(function(){
        return false;
    });
    searchBox.mouseup(function(){
        return false;
    });

    $(document).mouseup(function(){
        if(isOpen == true){
            $(submitIcon).show();
            submitIcon.click();
        }
    });

} // End Search

function SearchButton(){
    var inputVal = $('.sb-search-input').val();

    inputVal = $.trim(inputVal).length;
    if( inputVal !== 0){
        inputVal.hide();
    } else {
        $(inputVal).val('');
        $(inputVal).show();
    }
} // End Search Button


// All Regular jQuery
jQuery(document).ready(function($){

    // Load Menu
	loadMenu();

    // Load Gravatar
    loadGravatars();

    // Load Menu
	loadSearch();
    SearchButton();

}); //END JQUERY DOCUMENT READY
