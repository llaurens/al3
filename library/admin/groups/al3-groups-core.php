<?php
/* Scout Events Plugin
This page walks you through creating
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
add_action( 'after_switch_theme', 'al3_flush_rewrite_rules_groups' );

// Flush your rewrite rules
function al3_flush_rewrite_rules_groups() {
	flush_rewrite_rules();
}


// let's create the function for the custom type
function al3_groups() {
	// creating (registering) the custom type
	register_post_type( 'groups', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
            'labels' => array(
                'name' => __( 'Groups', 'al3' ), /* This is the Title of the Group */
                'singular_name' => __( 'Group', 'al3' ), /* This is the individual type */
                'all_items' => __( 'All Groups', 'al3' ), /* the all items menu item */
                'add_new' => __( 'Add New', 'al3' ), /* The add new menu item */
                'add_new_item' => __( 'Add New Group', 'al3' ), /* Add New Display Title */
                'edit' => __( 'Edit', 'al3' ), /* Edit Dialog */
                'view_item' => __( 'View Group', 'al3' ), /* View Display Title */
                'search_items' => __( 'Search Groups', 'al3' ), /* Search Custom Type Title */
                'not_found' =>  __( 'Nothing found in the Database.', 'al3' ), /* This displays if there are no entries yet */
                'not_found_in_trash' => __( 'Nothing found in Trash', 'al3' ), /* This displays if there is nothing in the trash */
                'parent_item_colon' => ''
            ), /* end of arrays */
			'description' => __( 'Here you can edit or change groups.', 'al3' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 6, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-groups', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => __('groups', 'al3'), 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => __('groups', 'al3'), /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', )
		) /* end of options */
	); /* end of register post type */
}

// adding the function to the Wordpress init
add_action( 'init', 'al3_groups');

/*
    looking for custom meta boxes?
    check out this fantastic tool:
    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/

al3_groups_metaboxes();

//Show Metadata in Backend

add_action('manage_posts_custom_column',  'groups_custom_columns');
add_filter('manage_groups_posts_columns', 'groups_edit_columns');

function groups_edit_columns($columns){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Groups', 'al3' ),
        'groups_ages' => __( 'Ages', 'al3' ),
        'groups_members' => __( 'Group Members', 'al3' ),
        'groups_meet_day' => __( 'Day to meet', 'al3' ),
        'groups_leader' => __( 'Group Leader', 'al3' ),
  );
  return $columns;
}

function groups_custom_columns($column) {

    global $post;

    $custom = get_post_custom();

    switch ($column) {

    case 'groups_ages': if( ! empty( $custom['groups_ages'][0] )) {

        al3_acf_select_labels('groups_ages');

    }
                           break;

    case 'groups_members': if( ! empty( $custom['groups_members'][0] )) {

        echo $custom['groups_members'][0];

    } else {
            _e('No Information about members specified', 'al3');
    }
                           break;

    case 'groups_meet_day': if( ! empty( $custom['groups_meet_day'][0] )) {

        al3_acf_select_labels('groups_meet_day');

    }
                           break;

    case 'groups_leader': if( ! empty( $custom['groups_leader'][0] )) {
        echo $custom['groups_leader'][0];
    } else {
            _e('No Group Leader', 'al3');
    }
                           break;

    }
}

//Sort Groups

add_filter('manage_edit-groups_sortable_columns', 'group_date_column_register_sortable');
add_filter('request', 'group_date_column_orderby');

function group_date_column_register_sortable( $columns ) {
    $columns['group_date'] = 'group_start_date';
    return $columns;
}

function group_date_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'group_start_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'group_start_date',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-groups_sortable_columns', 'groups_ages_column_register_sortable');
add_filter('request', 'groups_ages_column_orderby' );

function groups_ages_column_register_sortable( $columns ) {
        $columns['groups_ages'] = 'groups_ages';
        return $columns;
}

function groups_ages_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'groups_ages' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'groups_ages',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-groups_sortable_columns', 'groups_members_column_register_sortable');
add_filter('request', 'groups_members_column_orderby' );

function groups_members_column_register_sortable( $columns ) {
        $columns['groups_members'] = 'groups_members';
        return $columns;
}

function groups_members_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'groups_members' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'groups_members',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-groups_sortable_columns', 'groups_meet_day_column_register_sortable');
add_filter('request', 'groups_meet_day_column_orderby' );

function groups_meet_day_column_register_sortable( $columns ) {
        $columns['groups_meet_day'] = 'groups_meet_day';
        return $columns;
}

function groups_meet_day_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'groups_meet_day' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'groups_meet_day',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-groups_sortable_columns', 'groups_leader_column_register_sortable');
add_filter('request', 'groups_leader_column_orderby' );

function groups_leader_column_register_sortable( $columns ) {
        $columns['groups_leader'] = 'groups_leader';
        return $columns;
}

function groups_leader_column_orderby ( $vars ) {
    if ( isset( $vars['orderby'] ) && 'groups_leader' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'groups_leader',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}
