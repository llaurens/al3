<?php
/*
* Admin Functions
*
* @package al3
* @subpackage Admin
*/
?>

<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/al3/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

    - include must-use plugins
    - adding Metaboxes
    - include events plugin
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin


*/

/************ PLUGINS *********************/

/*
Via TGM Plugin Activation we can include any plugin
into the theme without integrating it directly in our
theme directory. Therefore, we don't have to care longer
about recent versions etc.
*/

// INCLUDE PLUGIN LIST
require_once( 'admin/plugin-management/al3-plugins.php' );


/************ EVENTS PLUGIN *********************/

// INCLUDE EVENTS PLUGIN
require_once( 'admin/events/al3-events.php' );


/************ GROUPS PLUGIN *********************/

// INCLUDE GROUPS PLUGIN
require_once( 'admin/groups/al3-groups.php' );


/************ MANAGEMENT PLUGIN *********************/

// INCLUDE MANAGEMENT PLUGIN
require_once( 'admin/management/al3-management.php' );

/**************** METABOXES *********************/

// ACF

// Remove ACF from WP menu

function remove_acf_menu() {
		remove_menu_page('edit.php?post_type=acf');
	}
add_action( 'admin_menu', 'remove_acf_menu', 999);

/************ API POWER *********************/

// INCLUDE API FUNCTIONS
require_once( 'api.php' );

/**************** METABOXES *********************/

/************ DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //

	// remove plugin dashboard boxes
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/al3/issues
	*/
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
function al3_rss_dashboard_widget() {
	if ( function_exists( 'fetch_feed' ) ) {
		// include_once( ABSPATH . WPINC . '/feed.php' );               // include the required file
		$feed = fetch_feed( __('http://www.dpbm.de/feed/', 'al3') );               // specify the source feed
		if (is_wp_error($feed)) {
			$limit = 0;
			$items = 0;
		} else {
			$limit = $feed->get_item_quantity(7);                        // specify number of items
			$items = $feed->get_items(0, $limit);                        // create an array of items
		}
	}
	if ($limit == 0) printf( '<div>' . __('The RSS Feed is either empty or unavailable.', 'al3' ) . '</div>');   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'al3' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<?php }
}

// calling all custom dashboard widgets
function al3_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'al3_rss_dashboard_widget', __( 'Recently on DPBM', 'al3' ), 'al3_rss_dashboard_widget' );
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}


// removing the dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'al3_custom_dashboard_widgets' );


/************ CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function al3_login_css() {
	wp_enqueue_style( 'al3_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function al3_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function al3_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'al3_login_css', 10 );
add_filter( 'login_headerurl', 'al3_login_url' );
add_filter( 'login_headertitle', 'al3_login_title' );


/************ CUSTOMIZE ADMIN *******************/

/*
I don't really recommend editing the admin too much
as things may get funky if WordPress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function al3_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://lamberty.me" target="_blank">Laurens Lamberty</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.', 'al3' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'al3_custom_admin_footer' );


/************ CUSTOMIZER ADMIN *******************/

/*
This adds a few more options to the default options
listed in the customizer menu to add links to the
home blocks.
*/

function al3_customizer_links($wp_customize){

    //adding link section in wordpress customizer
    $wp_customize->add_section('al3_link_settings_section', array(
        'title'          => __('Links Settings', 'al3')
    ));

    //adding settings for news
    $wp_customize->add_setting('al3_blog_setting', array(
        'default'        => '',
    ));
    $wp_customize->add_control('al3_blog_setting', array(
        'label'   => __('Link to Blog Page', 'al3'),
        'section' => 'al3_link_settings_section',
        'type'    => 'text',
    ));

    //adding settings for events
    $wp_customize->add_setting('al3_events_setting', array(
        'default'        => '',
    ));
    $wp_customize->add_control('al3_events_setting', array(
        'label'   => __('Link to Event Page', 'al3'),
        'section' => 'al3_link_settings_section',
        'type'    => 'text',
    ));

    //adding settings for groups
    $wp_customize->add_setting('al3_groups_setting', array(
        'default'        => '',
    ));
    $wp_customize->add_control('al3_groups_setting', array(
        'label'   => __('Link to Groups Page', 'al3'),
        'section' => 'al3_link_settings_section',
        'type'    => 'text',
    ));

    //adding settings for the schedule
    $wp_customize->add_setting('al3_schedule_setting', array(
        'default'        => '',
    ));
    $wp_customize->add_control('al3_schedule_setting', array(
        'label'   => __('Link to Schedule Page', 'al3'),
        'section' => 'al3_link_settings_section',
        'type'    => 'text',
    ));

    //adding settings for the gallery
    $wp_customize->add_setting('al3_gallery_setting', array(
        'default'        => '',
    ));
    $wp_customize->add_control('al3_gallery_setting', array(
        'label'   => __('Link to Gallery Page', 'al3'),
        'section' => 'al3_link_settings_section',
        'type'    => 'text',
    ));

}

// hook it up
add_action('customize_register', 'al3_customizer_links');

?>
