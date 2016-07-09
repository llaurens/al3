<?php
/*
* Management Core
*
* @package al3
* @subpackage Management
*/
?>

<?php
/* This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Laurens Lamberty
URL: http://lamberty.me/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'al3_flush_rewrite_rules_management' );

// Flush your rewrite rules
function al3_flush_rewrite_rules_management() {
	flush_rewrite_rules();
}


// let's create the function for the custom type
function al3_management() {
	// creating (registering) the custom type
	register_post_type( 'management', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
            'labels' => array(
                'name' => __( 'Management', 'al3' ), /* This is the Title of the Group */
                'singular_name' => __( 'Manager', 'al3' ), /* This is the individual type */
                'all_items' => __( 'All Managers', 'al3' ), /* the all items menu item */
                'add_new' => __( 'Add New', 'al3' ), /* The add new menu item */
                'add_new_item' => __( 'Add New Manager', 'al3' ), /* Add New Display Title */
                'edit' => __( 'Edit', 'al3' ), /* Edit Dialog */
                'view_item' => __( 'View Manager', 'al3' ), /* View Display Title */
                'search_items' => __( 'Search Management', 'al3' ), /* Search Custom Type Title */
                'not_found' =>  __( 'Nothing found in the Database.', 'al3' ), /* This displays if there are no entries yet */
                'not_found_in_trash' => __( 'Nothing found in Trash', 'al3' ), /* This displays if there is nothing in the trash */
                'parent_item_colon' => ''
            ), /* end of arrays */
			'description' => __( 'Here you can edit or change the management.', 'al3' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-businessman', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => __('management', 'al3'), 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => __('management', 'al3'), /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', )
		) /* end of options */
	); /* end of register post type */
}

// adding the function to the Wordpress init
add_action( 'init', 'al3_management');

/*
    looking for custom meta boxes?
    check out this fantastic tool:
    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

al3_management_metaboxes();

//Show Metadata in Backend

add_action('manage_posts_custom_column',  'management_custom_columns');
add_filter('manage_management_posts_columns', 'management_edit_columns');

function management_edit_columns($columns){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'thumbnail' => __( 'Thumbnail', 'al3' ),
        'title' => __( 'Member', 'al3' ),
        'management_name' => __( 'Official Name', 'al3' ),
        'management_head' => __( 'Member of the head', 'al3' ),
        'management_mail' => __( 'E-Mail', 'al3' ),
        'management_birthday' => __( 'Birthday', 'al3' ),
  );
  return $columns;
}

function management_custom_columns($column) {

    global $post;

    $custom = get_post_custom();

    switch ($column) {

    case 'thumbnail': if ( '' != get_the_post_thumbnail() ) {
        echo the_post_thumbnail();
    }
                           break;

    case 'management_name': if( ! empty( $custom['management_name'][0] )) {
        echo $custom['management_name'][0];
    } else {
            _e('No official name specified', 'al3');
    }
                           break;

    case 'management_head': if( ! empty( $custom['management_head'][0] )) {
            _e('Yes', 'al3');
    } else {
            _e('No', 'al3');
    }
                           break;


    case 'management_mail': if( ! empty( $custom['management_mail'][0] )) {
        echo $custom['management_mail'][0];
    } else {
            _e('No e-mail specified', 'al3');
    }
                           break;

    case 'management_birthday': if( ! empty( $custom['management_birthday'][0] )) {
        echo date_i18n( get_option( 'date_format' ), strtotime( get_field( 'management_birthday' )) );
    } else {
            _e('No age specified', 'al3');
    }
                           break;

    }
}

//Sort Groups

add_filter('manage_edit-management_sortable_columns', 'management_name_column_register_sortable');
add_filter('request', 'management_name_column_orderby');

function management_name_column_register_sortable( $columns ) {
    $columns['management_name'] = 'management_name';
    return $columns;
}

function management_name_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'management_name' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'management_name',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-management_sortable_columns', 'management_head_column_register_sortable');
add_filter('request', 'management_head_column_orderby' );

function management_head_column_register_sortable( $columns ) {
        $columns['management_head'] = 'management_head';
        return $columns;
}

function management_head_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'management_head' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'management_head',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-management_sortable_columns', 'management_mail_column_register_sortable');
add_filter('request', 'management_mail_column_orderby' );

function management_mail_column_register_sortable( $columns ) {
        $columns['management_mail'] = 'management_mail';
        return $columns;
}

function management_mail_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'management_mail' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'management_mail',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-management_sortable_columns', 'management_birthday_column_register_sortable');
add_filter('request', 'management_birthday_column_orderby' );

function management_birthday_column_register_sortable( $columns ) {
        $columns['management_birthday'] = 'management_birthday';
        return $columns;
}

function management_birthday_column_orderby ( $vars ) {
    if ( isset( $vars['orderby'] ) && 'management_birthday' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'management_birthday',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
}
