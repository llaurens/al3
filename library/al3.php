<?php
/*
* Core File
*
* @package al3
* @subpackage Core
*/
?>

<?php
/* Welcome to al3 :)
This is the core al3 file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/al3/

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt
  - adding custom fields to user profiles

*/

/********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function al3_head_cleanup() {
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'al3_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'al3_remove_wp_ver_css_js', 9999 );

} /* end al3 head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'al3' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function al3_rss_version() { return ''; }

// remove WP version from scripts
function al3_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function al3_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function al3_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function al3_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function al3_scripts_and_styles() {

    global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    //Frontend Scripts/Styles
    if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'al3-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/min/modernizr.custom.min.js', array(), '2.5.3', false );

        // jQuery (from Google CDN)
        wp_deregister_script( 'jquery' );
        wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js", array(), '2.2.0', true );

        // IE only HTML5
        wp_register_script( 'al3-ie-HTML5', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://raw.githubusercontent.com/aFarkas/html5shiv/master/src/html5shiv.js", array(), '3.7.2', false );

        // Lazyload
        wp_register_script( 'al3-lazyload', get_stylesheet_directory_uri() . '/library/js/libs/min/lazyload.min.js', array(), '1.0.0', true );

        // Baguette Lightbox
        wp_register_script( 'al3-lightbox', get_stylesheet_directory_uri() . '/library/js/libs/min/baguetteBox.min.js', array(), '1.8.0', true );

		// register main stylesheet
		wp_register_style( 'al3-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		wp_register_style( 'al3-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

		//adding scripts file in the footer
		wp_register_script( 'al3-js', get_stylesheet_directory_uri() . '/library/js/scripts.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'al3-lightbox-loader', get_stylesheet_directory_uri() . '/library/js/lightbox-load.min.js', '', '', true );

		// enqueue styles and scripts
		wp_enqueue_style( 'al3-stylesheet' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'al3-ie-only' );

		$wp_styles->add_data( 'al3-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/

        // Scripts in head
		wp_enqueue_script( 'al3-modernizr' );

        // Other Scripts in Footer
        wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'al3-js' );

        // Contact Form 7 Scripts only on contact page template
        function al3_dequue_cf7_scripts() {

            $load_scripts = false;

            if( is_singular() ) {
                $post = get_post();

                if( has_shortcode($post->post_content, 'contact-form-7') ) {
                    $load_scripts = true;
                }
            }

            if( ! $load_scripts ) {
                wp_dequeue_script( 'contact-form-7' );
                wp_dequeue_style( 'contact-form-7' );
            }
        }
        add_action( 'wp_enqueue_scripts', 'al3_dequue_cf7_scripts', 99 );

        // Thickbox Scripts only in backend
        function al3_dequue_thickbox_scripts() {

            $load_scripts = false;

            if( is_admin() ) {
                    $load_scripts = true;
            }

            if( ! $load_scripts ) {
                wp_dequeue_script( 'thickbox' );
                wp_dequeue_style( 'thickbox' );
            }
        }
        add_action( 'wp_enqueue_scripts', 'al3_dequue_thickbox_scripts', 99 );

        // Gallery Scripts only on past events, but also in footer
		if( is_singular( 'events' ) && is_past_event() ) { wp_enqueue_script( 'al3-lazyload' ); }
		if( is_singular( 'events' ) && is_past_event() ) { wp_enqueue_script( 'al3-lightbox' ); }
		if( is_singular( 'events' ) && is_past_event() ) { wp_enqueue_script( 'al3-lightbox-loader' ); }

        // comment reply script for threaded comments
        if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		      wp_enqueue_script( 'comment-reply' );
        }

	}
}

/********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function al3_theme_support() {

    // Better title (since WP 4.1)
    add_theme_support( 'title-tag' );

    //HTML5
    add_theme_support( 'html5', array( 'search-form', 'comment-list', 'comment-form', 'gallery', 'caption' ) );

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'lateral-nav' => __( 'Lateral Menu', 'al3' ),   // main nav in sidebar
			'footer-nav' => __( 'Footer Links', 'al3' )     // secondary nav in footer
		)
	);
} /* end al3 theme support */

/********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function al3_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="card pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function al3_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// the same for term descriptions
remove_filter('term_description','wpautop');

// This removes the annoying […] to a Read More link
function al3_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'al3' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'al3' ) .'</a>';
}

// remove widgets div from WP Menu, since we don't need them
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
    $page = remove_submenu_page( 'themes.php', 'widgets.php' );
    // $page[0] is the menu title
    // $page[1] is the minimum level or capability required
    // $page[2] is the URL to the item's file
}


?>
