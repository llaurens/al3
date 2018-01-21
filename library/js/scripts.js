/*
 * al3 Scripts File
 * Author: Laurens Lamberty
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * In addition to that, you will notice that most of the functions are wrapped
 * and called in the end when the page has loaded. This prevents render blocking
 * scripts from firing to early.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 */



/*
 * 01: LOADING THE WEBFONTS
 * Loading the webfonts early using the webfont loader. Read more at
 * https://github.com/typekit/webfontloader
 */

// Configure WebFontLoader to load Lato and Signika
WebFontConfig = {
    google: {
        families: ['Lato:400', 'Signika:700']
    }
};

// Fetch the script via Google CDN
(function(d) {
   var wf = d.createElement('script'), s = d.scripts[0];
   wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
   s.parentNode.insertBefore(wf, s);
})(document);


/*
 * 02: LOADING THE MENU
 * The Menu has multiple parts:
 * 2.1.1:   Opens or closes the menu when the menu icon is clicked
 * 2.1.2:   Closes the menu on click outside the menu icon
 * 2.2.1:   Takes control off the submenu items
 * 2.2.2:   Does the same for chronicle entries
 */


function loadMenu () {

    /*
    * 02.1.1: MENU ICON
    * Opens or closes the menu when clicking the menu icon
    */

    // Variables
    var $lateral_menu_trigger = $('#menu-trigger');
	var	$content_wrapper = $('.main-content');
    var $navigation = $('#inner-header');

	$lateral_menu_trigger.on('click', function(event){

        event.preventDefault();

		$lateral_menu_trigger.toggleClass('is-clicked');
		$('#lateral-nav').toggleClass('lateral-menu-is-open');

		//check if transitions are not supported - i.e. in IE9
		if($('html').hasClass('no-csstransitions')) {
			$('body').toggleClass('overflow-hidden');
        }

	});


    /*
    * 02.1.2: OUTSIDE MENU ICON
    * Closes the menu when clicking outside the menu or the menu icon.
    */

	$content_wrapper.on('click', function(event){

        // Check whether the menu icon is NOT clicked
		if( !$(event.target).is('#menu-trigger, #menu-trigger span') ) {

			$lateral_menu_trigger.removeClass('is-clicked');
			$('#lateral-nav').removeClass('lateral-menu-is-open');

			//check if transitions are not supported
			if($('html').hasClass('no-csstransitions')) {
				$('body').removeClass('overflow-hidden');
			}

		}
	});

    /*
    * 02.2.1: SUBMENU ITEMS
    * Slides out the submenu items when clicking on them
    */

    // Main Target
    $('#lateral-nav .menu-item-has-children').children('a').on('click', function(event){

        event.preventDefault();

        // Variables
        var container = $(this).toggleClass('submenu-open').next('.sub-menu');
        var active = $(this).hasClass('submenu-open');      // Checks whether the Submenu is open or not
        var direction = active ? 'slideDown' : 'slideUp';   // Changes direction depending on submenu status
        var duration = active ? 300 : 300;                  // Different animation durations for in/out animation
        var easing = 'easeInOutQuart';                      // The easing

        // Makes use of velocity.js for smooth transition without jQuery
        Velocity(
            container,
            direction, {
                duration: duration,     // duration set in function call params
                easing: easing,         // easing set in function call params
        });

    });


    /*
    * 02.2.1: CHRONICLE MENU
    * Another part of the website, but similar function
    */

    // Main Target
	$('.chronicle a.has-children').on('click', function(event){

        event.preventDefault();

        var container = $(this).toggleClass('submenu-open').next('.sub-menu');
        var active = $(this).hasClass('submenu-open');      // Checks whether the Submenu is open or not
        var direction = active ? 'slideDown' : 'slideUp';   // Changes direction depending on submenu status
        var duration = active ? 400 : 400;                  // Different animation durations for in/out animation
        var easing = 'easeInOutQuart';                      // The easing


        Velocity(
            container,
            direction, {
                duration: duration,     // duration set in function call params
                easing: easing,         // easing set in function call params
        })

	});

    // Leave the first chronicle entry open
    $('.chronicle a.has-children:first-of-type').addClass('submenu-open');


}


$(".target_group-toggle").on('click', function(event){

        event.preventDefault();

        $('.type-events').removeClass('active');

        var id = $(this).attr('id');

        if ($('.type-events').hasClass(id)) {
            $('.type-events.'+id).addClass('active');
        }


        Velocity(
            $('.type-events.active'),
            'slideDown', {
                duration: 600,     // duration set in function call params
                easing: 'linear',         // easing set in function call params
                delay:  10,
            }
        );


            Velocity(
           $('.type-events:not(.active)'),
            'slideUp', {
                duration: 600,     // duration set in function call params
                easing: 'linear',         // easing set in function call params
                delay: 10,
            }
        );









    });

$("#event_target_group-all").on('click', function(event){

    event.preventDefault();


    Velocity(
            $('.type-events'),
            'slideDown', {
                duration: 600,     // duration set in function call params
                easing: 'linear',         // easing set in function call params
                delay: 10,
            }
        );

});






/*
 * 03: LOADING THE SEARCH FORM
 * The Search form has multiple parts aswell:
 * 3.1:     Little helper function for browser and touch support
 * 3.2.1:   Fetching data
 * 3.2.2:   Main Function
 * 3.3:     Launch
 */

function loadSearch () {

    /*
    * 03.1: HELPER FUNCTIONS
    * A few helper function, which add an EventListener, a mobilecheck and a non-jQuery-Trimmer
    */

    // EventListener | @jon_neal | //github.com/jonathantneal/EventListener
	!window.addEventListener && window.Element && (function () {
        function addToPrototype(name, method) {
		  Window.prototype[name] = HTMLDocument.prototype[name] = Element.prototype[name] = method;
	   }

	   var registry = [];

	   addToPrototype("addEventListener", function (type, listener) {
		  var target = this;

		  registry.unshift({
			 __listener: function (event) {
				event.currentTarget = target;
				event.pageX = event.clientX + document.documentElement.scrollLeft;
				event.pageY = event.clientY + document.documentElement.scrollTop;
				event.preventDefault = function () { event.returnValue = false };
				event.relatedTarget = event.fromElement || null;
				event.stopPropagation = function () { event.cancelBubble = true };
				event.relatedTarget = event.fromElement || null;
				event.target = event.srcElement || target;
				event.timeStamp = +new Date;

				listener.call(target, event);
			 },
			 listener: listener,
			 target: target,
			 type: type
		  });

		  this.attachEvent("on" + type, registry[0].__listener);

	   });

	   addToPrototype("removeEventListener", function (type, listener) {
		  for (var index = 0, length = registry.length; index < length; ++index) {
			 if (registry[index].target == this && registry[index].type == type && registry[index].listener == listener) {
				return this.detachEvent("on" + type, registry.splice(index, 1)[0].__listener);
			 }
		  }
	   });

	   addToPrototype("dispatchEvent", function (eventObject) {
		  try {
			 return this.fireEvent("on" + eventObject.type, eventObject);
		  } catch (error) {
			 for (var index = 0, length = registry.length; index < length; ++index) {
				if (registry[index].target == this && registry[index].type == eventObject.type) {
				   registry[index].call(this, eventObject);
				}
			 }
		  }
	   });

	})();

	// Mobile check for focus events (http://stackoverflow.com/a/11381730/989439)
	function mobilecheck() {
		var check = false;
		(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}

	// Trimming without jQuery (http://www.jonathantneal.com/blog/polyfills-and-prototypes/)
	!String.prototype.trim && (String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g, '');
	});

     /*
    * 03.2.1: SET DATA
    * Getting all options ready
    */

	function UISearch( el, options ) {
		this.el = document.getElementById( 'expanding-search' );
		this.inputEl = el.querySelector( 'form > input.expanding-search-input' );
		this._initEvents();
	}

    // Variables
    var $search_container = $('#expanding-search');
    var $search_input = $( '#expanding-search form > input.expanding-search-input' );

    /*
    * 03.2.2: MAIN FUNCTION
    * the main search form
    */

	UISearch.prototype = {
		_initEvents : function() {
			var self = this,
				initSearchFn = function( ev ) {
					ev.stopPropagation();
					// trim its value
					self.inputEl.value = self.inputEl.value.trim();

                    if( !$search_container.hasClass('expanding-search-open')) {// open it
						ev.preventDefault();
						self.open();
					}
					else if( this.hasClass('expanding-search-open' ) && /^\s*$/.test( self.inputEl.value ) ) { // close it
						ev.preventDefault();
						self.close();
					}
				}

			this.el.addEventListener( 'click', initSearchFn );
			this.el.addEventListener( 'touchstart', initSearchFn );
			this.inputEl.addEventListener( 'click', function( ev ) { ev.stopPropagation(); });
			this.inputEl.addEventListener( 'touchstart', function( ev ) { ev.stopPropagation(); } );
		},

		open : function() {

            var self = this;
			$search_container.addClass( 'expanding-search-open' );
			// focus the input
			if( !mobilecheck() ) {
				this.inputEl.focus();
			}

			// close the search input if body is clicked
			var bodyFn = function( ev ) {
				self.close();
				this.removeEventListener( 'click', bodyFn );
				this.removeEventListener( 'touchstart', bodyFn );
			};

			document.addEventListener( 'click', bodyFn );
			document.addEventListener( 'touchstart', bodyFn );

		},

		close : function() {

			this.inputEl.blur();
			$search_container.removeClass(  'expanding-search-open' );

		}
	}


    /*
    * 03.3: LAUNCH SEARCH
    * Launching this shit
    */

	new UISearch( document.getElementById( 'expanding-search' ) );


}

/*
 * 04: WINDOW SCROLL ANIMATION
 * Blurs the Background image when scrolled
 * to a certain point.
 */


/*window.onscroll = function changeNav(){

    var scrollPosY = window.pageYOffset | document.body.scrollTop;

    if(scrollPosY > 100) {
          $(".body-background-image").addClass("blur");
    } else if(scrollPosY <= 100) {
         $(".body-background-image").removeClass("blur");
    }

}*/


/*
 * 05: LOADING THINGS AFTER PAGE HAS LOADED
 * Via cash we find out when the page has entirely loaded and
 * then we throw in the functions, which are not needed right in
 * the beginning of the page load to avoid blocking.
 */

$(document).ready(function($){

    // Load Menu
    loadMenu();

    // Load Search
    loadSearch();

});
