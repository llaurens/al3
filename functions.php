<?php
/*
* Functions
*
* @package al3
* @subpackage Core
*/
?>

<?php
/*
This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/


// let's get language support going, if you need it
load_theme_textdomain( 'al3', get_template_directory() . '/library/translation' );

// LOAD al3 CORE (if you remove this, the theme will break)
require_once( 'library/al3.php' );

// CUSTOMIZE THE WORDPRESS ADMIN
require_once( 'library/admin.php' );


/********************
LAUNCH al3
Let's get everything up and running.
*********************/

function al3_ahoy() {

    //Allow editor style.
    add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );
    // launching operation cleanup
    add_action( 'init', 'al3_head_cleanup' );
    // A better title
    add_filter( 'wp_title', 'rw_title', 10, 3 );
    // remove WP version from RSS
    add_filter( 'the_generator', 'al3_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'al3_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'al3_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'al3_gallery_style' );

    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'al3_scripts_and_styles', 999 );

    // enqueuing special inline styles
    add_action( 'wp_enqueue_scripts', 'al3_background_thumbnail', 999 );

    // launching this stuff after theme setup
    al3_theme_support();

    // cleaning up random code around images
    add_filter( 'the_content', 'al3_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'al3_excerpt_more' );

} /* end al3 ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'al3_ahoy' );


/************ OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************ THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'al3-retina-thumb', 300, 300, true );
add_image_size( 'al3-item', 600, 300, true );

// Picturefill Sizes
add_image_size( 'al3-mobile', 320, 568, true );      // iPhone Portrait
add_image_size( 'al3-small', 768, 1024, true );      // Small Tablet
add_image_size( 'al3-tablet', 1030, 800, true );     // Big Tablets
add_image_size( 'al3-desktop', 1920, 1280, true);    // Desktops
add_image_size( 'al3-retina', 2880, 1800, true);     // Retina Desktops


/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'al3-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'al3-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/


add_filter( 'image_size_names_choose', 'al3_custom_image_sizes' );

function al3_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'al3-item'           => __('Large Item (600px)', 'al3'),
        'al3-mobile'         => __('Mobile Phone', 'al3'),
        'al3-small'          => __('Small Devices', 'al3'),
        'al3-tablet'         => __('Tablets', 'al3'),
        'al3-desktop'        => __('Desktops', 'al3'),
        'al3-retina'         => __('Retina Displays', 'al3'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

function al3_background_thumbnail() {

    global $post;

    if ( has_post_thumbnail() ) {

        $mobile = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'al3-mobile', false, '' );
        $small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'al3-small', false, '' );
        $tablet = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'al3-tablet', false, '' );
        $desktop = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'al3-desktop', false, '' );
        $retina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'al3-retina', false, '' );

        $css = '';

        if ( ! empty($small)) {
            $css .= '
                @media only screen and (min-width: 481px) {  body:before { background-image: url(' . esc_url( $small[0]) . '); }}
                @media only screen and (min-width: 1030px) { body:before { background-image: url(' . esc_url( $tablet[0]) . '); }}
                @media only screen and (min-width: 1240px) { body:before { background-image: url(' . esc_url( $desktop[0]) . '); }}
                @media only screen and (min-width: 2048px) { body:before { background-image: url(' . esc_url( $retina[0]) . '); }}';

        }

        if ( is_singular( array( 'post', 'page', 'groups' ))) {
            wp_add_inline_style( 'al3-stylesheet', $css );
        }

    }
}

// Add Thumbnail Body Class

function add_featured_image_body_class( $classes ) {

        global $post;

        if ( isset ( $post->ID ) && get_the_post_thumbnail($post->ID) && is_singular( array( 'post', 'page', 'groups' ))) {
            $classes[] = 'has-featured-image';
        }
            return $classes;
}

add_filter( 'body_class', 'add_featured_image_body_class' );


/************ POST HELPER FUNCTIONS *********************/

// A basic helper function, that checks whether a user has posted anything

function al3_user_has_posts($user_id) {
  $result = new WP_Query(array(
    'author'=>$user_id,
    'post_status'=>'publish',
    'posts_per_page'=>1,
  ));
  return (count($result->posts)!=0);
}


// Check whether an event has already occured
function is_past_event () {

    $today = current_time('Y-m-d');
    $event_end_date = get_field( 'event_start_date' );

	if ( $event_end_date < $today )
		return true;

	return false;
}

// Rewrite Title when an pictures to an event are visible
function al3_custom_title() {

    global $post;

    $today = current_time('Y-m-d');
    $event_end_date = get_field( 'event_start_date', $post->ID );
    $event_gallery = get_field( 'gallery_images', $post->ID );

    if ( ! empty( $event_end_date ) && ! empty( $event_gallery ) && $event_end_date < $today ) {
        printf(__( 'Photos:', 'al3' ) . ' ' . wp_get_document_title());
    } else {
        echo wp_get_document_title();
    }
}

/************ COMMENT LAYOUT *********************/

// Check for a gravatar (thanks to  justinph / validate_gravatar.php)

/*
 * Utility function to check if a gravatar exists for a given email or id
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @return bool if the gravatar exists or not
 */

function validate_gravatar($id_or_email) {
  //id or email code borrowed from wp-includes/pluggable.php
	$email = '';
	if ( is_numeric($id_or_email) ) {
		$id = (int) $id_or_email;
		$user = get_userdata($id);
		if ( $user )
			$email = $user->user_email;
	} elseif ( is_object($id_or_email) ) {
		// No avatar for pingbacks or trackbacks
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
			return false;

		if ( !empty($id_or_email->user_id) ) {
			$id = (int) $id_or_email->user_id;
			$user = get_userdata($id);
			if ( $user)
				$email = $user->user_email;
		} elseif ( !empty($id_or_email->comment_author_email) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}

	$hashkey = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hashkey . '?d=404';

	$data = wp_cache_get($hashkey);
	if (false === $data) {
		$response = wp_remote_head($uri);
		if( is_wp_error($response) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
	    wp_cache_set($hashkey, $data, $group = '', $expire = 60*5);

	}
	if ($data == '200'){
		return true;
	} else {
		return false;
	}
}


// Comment Layout
function al3_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>

          <?php if ( validate_gravatar($bgauthemail) ) { ?>
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim ( $bgauthemail ) ) ); ?>?s=40" class="load-gravatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
          <?php } else { ?>
          <img class="load-gravatar no-avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/no-avatar.jpg" />
          <?php } ?>

        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'al3' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'al3' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'al3' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'al3' ) ?></p>
        </div>
      <?php endif; ?>
      <div class="comment_content cf">
        <?php comment_text() ?>
      </div>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

add_filter ('wpseo_breadcrumb_output','al3_microdata_breadcrumb');
function al3_microdata_breadcrumb ($link_output) {
$link_output = preg_replace(array('#<span xmlns:v="http://rdf.data-vocabulary.org/\#">#','#<span typeof="v:Breadcrumb"><a href="(.*?)" .*?'.'>(.*?)</a></span>#','#<span typeof="v:Breadcrumb">(.*?)</span>#','# property=".*?"#','#</span>$#'), array('','<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="$1" itemprop="url"><span itemprop="title">$2</span></a></span>','<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">$1</span></span>','',''), $link_output);

return $link_output;
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
