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
add_action( 'after_switch_theme', 'al3_flush_rewrite_rules_events' );

// Flush your rewrite rules
function al3_flush_rewrite_rules_events() {
	flush_rewrite_rules();
}


// let's create the function for the custom type


// Register Custom Post Type
function al3_events() {

	$labels = array(
		'name'                  => __( 'Events', 'al3' ),
		'singular_name'         => __( 'Event', 'al3' ),
		'menu_name'             => __( 'Events', 'al3' ),
		'name_admin_bar'        => __( 'Events', 'al3' ),
		'archives'              => __( 'Events Archiv', 'al3' ),
		'parent_item_colon'     => __( 'Parent Event:', 'al3' ),
		'all_items'             => __( 'All Events', 'al3' ),
		'add_new_item'          => __( 'Add New Event', 'al3' ),
		'add_new'               => __( 'Add New', 'al3' ),
		'new_item'              => __( 'New Event', 'al3' ),
		'edit_item'             => __( 'Edit Event', 'al3' ),
		'update_item'           => __( 'Update Event', 'al3' ),
		'view_item'             => __( 'View Event', 'al3' ),
		'search_items'          => __( 'Search Event', 'al3' ),
		'not_found'             => __( 'Not found', 'al3' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'al3' ),
		'featured_image'        => __( 'Featured Image', 'al3' ),
		'set_featured_image'    => __( 'Set featured image', 'al3' ),
		'remove_featured_image' => __( 'Remove featured image', 'al3' ),
		'use_featured_image'    => __( 'Use as featured image', 'al3' ),
		'insert_into_item'      => __( 'Insert into item', 'al3' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'al3' ),
		'items_list'            => __( 'Events list', 'al3' ),
		'items_list_navigation' => __( 'Events list navigation', 'al3' ),
		'filter_items_list'     => __( 'Filter Event list', 'al3' ),
	);
	$rewrite = array(
		'slug'                  => __('events', 'al3'),
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Event', 'al3' ),
		'description'           => __( 'This is were you can add or edit events.', 'al3' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'comments', 'trackbacks', 'revisions', ),
		'taxonomies'            => array( 'event_target_group', 'event_organizer' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => __('events', 'al3'),
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);

	register_post_type( 'events', $args );

}

add_action( 'init', 'al3_events', 0 );


/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

// now let's add custom categories (these act like categories)

function event_categories() {

    // First of, the target groups
	$labels = array(
		'name'                       => __( 'Event Target Groups', 'al3' ),
		'singular_name'              => __( 'Event Target Group', 'al3' ),
		'menu_name'                  => __( 'Event Target Groups', 'al3' ),
		'all_items'                  => __( 'All Event Target Groups', 'al3' ),
		'parent_item'                => __( 'Parent Event Target Group', 'al3' ),
		'parent_item_colon'          => __( 'Parent Event Target Group:', 'al3' ),
		'new_item_name'              => __( 'New Event Target Group', 'al3' ),
		'add_new_item'               => __( 'Add Event Target Group', 'al3' ),
		'edit_item'                  => __( 'Edit Event Target Group', 'al3' ),
		'update_item'                => __( 'Update Event Target Group', 'al3' ),
		'view_item'                  => __( 'View Event Target Group', 'al3' ),
		'separate_items_with_commas' => __( 'Separate Target Groups with commas', 'al3' ),
		'add_or_remove_items'        => __( 'Add or remove Target Groups', 'al3' ),
		'choose_from_most_used'      => __( 'Choose from the most used Target Groups', 'al3' ),
		'popular_items'              => __( 'Popular Target Groups', 'al3' ),
		'search_items'               => __( 'Search Event Target Groups', 'al3' ),
		'not_found'                  => __( 'Not Found', 'al3' ),
		'no_terms'                   => __( 'No Event Target Groups', 'al3' ),
		'items_list'                 => __( 'Event Target Groups list', 'al3' ),
		'items_list_navigation'      => __( 'Event Target Groups list navigation', 'al3' ),
	);
	$rewrite = array(
		'slug'                       => __('event_target_group', 'al3'),
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);

    // Hook this pile of code
	register_taxonomy( 'event_target_group', array( 'events' ), $args );


    // Now for the organizer (recently added)
    $labels = array(
		'name'                       => __( 'Event Organizer', 'al3' ),
		'singular_name'              => __( 'Event Organizer', 'al3' ),
		'menu_name'                  => __( 'Event Organizer', 'al3' ),
		'all_items'                  => __( 'All Event Organizer', 'al3' ),
		'parent_item'                => __( 'Parent Event Organizer', 'al3' ),
		'parent_item_colon'          => __( 'Parent Event Organizer:', 'al3' ),
		'new_item_name'              => __( 'New Event Organizer', 'al3' ),
		'add_new_item'               => __( 'Add Event Organizer', 'al3' ),
		'edit_item'                  => __( 'Edit Event Organizer', 'al3' ),
		'update_item'                => __( 'Update Event Organizer', 'al3' ),
		'view_item'                  => __( 'View Event Organizer', 'al3' ),
		'separate_items_with_commas' => __( 'Separate Event Organizer with commas', 'al3' ),
		'add_or_remove_items'        => __( 'Add or remove Event Organizer', 'al3' ),
		'choose_from_most_used'      => __( 'Choose from the most used Event Organizer', 'al3' ),
		'popular_items'              => __( 'Popular Event Organizer', 'al3' ),
		'search_items'               => __( 'Search Event Organizer', 'al3' ),
		'not_found'                  => __( 'Not Found', 'al3' ),
		'no_terms'                   => __( 'No Event Organizer', 'al3' ),
		'items_list'                 => __( 'Event Organizer list', 'al3' ),
		'items_list_navigation'      => __( 'Event Organizer list navigation', 'al3' ),
	);
	$rewrite = array(
		'slug'                       => __('event_organizer', 'al3'),
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);

	register_taxonomy( 'event_organizer', array( 'events' ), $args );

}

add_action( 'init', 'event_categories', 0 );


/*
    looking for custom meta boxes?
    check out this fantastic tool:
    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
*/


al3_events_metaboxes();


// Show Metadata in Backend

function events_edit_columns($columns){

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Event', 'al3' ),
        'event_date' => __( 'Date', 'al3' ),
        'event_target_group' => __( 'Target Group', 'al3' ),
        'event_organizer' => __( 'Organizer', 'al3' ),
        'event_location' => __( 'Location', 'al3' ),
        'event_costs' => __( 'Costs in Euro', 'al3' ),
  );

  return $columns;

}

add_filter('manage_events_posts_columns', 'events_edit_columns');


function events_custom_columns($column) {

    global $post;

	if ($column == 'event_date') {

		if ( (get_field('event_start_date')) && ! (get_field('event_end_date')) ) {
			printf(
                __('On %s', 'al3'),
                date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
            );

		} elseif ( (get_field('event_start_date')) && (get_field('event_end_date')) ) {
			printf(
                __('From %1$s to %2$s', 'al3'),
                date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
            );
		}

        else {
			_e( 'No date specified.', 'al3' );
		}
	}

    elseif ($column == 'event_target_group') {

        $terms = get_the_terms( $post->ID, 'event_target_group' );

		if ( !empty( $terms ) ) {

            $out = array();

            foreach ( $terms as $term ) {
                $out[] = sprintf( esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'event_target_group', 'display' ) )
                );
            }

            echo join( ', ', $out );

		}

        else {
			_e( 'No Target Group specified.', 'al3' );
		}
    }

    elseif ($column == 'event_organizer') {

        $terms = get_the_terms( $post->ID, 'event_organizer' );

		if ( !empty( $terms ) ) {

            $out = array();

            foreach ( $terms as $term ) {
                $out[] = sprintf( esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'event_organizer', 'display' ) )
                );
            }

            echo join( ', ', $out );

		}

        else {
			_e( 'No Organizer specified.', 'al3' );
		}
    }

    elseif ($column == 'event_location') {

		if ( get_field('event_location') ) {
			printf(
                __('%s', 'al3'),
                get_field( 'event_location' )
            );
		}

        else {
			_e( 'No location specified.', 'al3' );
		}
    }

    elseif ($column == 'event_costs') {

		if ( get_field('event_costs') ) {
			printf(
                __('%s', 'al3'),
                get_field( 'event_costs' )
            );
		}

        else {
			_e( 'No location specified.', 'al3' );
		}
    }

}

add_action('manage_posts_custom_column',  'events_custom_columns');


//Sort Events

add_filter('manage_edit-events_sortable_columns', 'event_date_column_register_sortable');
add_filter('request', 'event_date_column_orderby');

function event_date_column_register_sortable( $columns ) {
    $columns['event_date'] = 'event_start_date';
    return $columns;
}

function event_date_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_start_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'event_start_date',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-events_sortable_columns', 'event_target_group_column_register_sortable');
add_filter('request', 'event_target_group_column_orderby' );

function event_target_group_column_register_sortable( $columns ) {
        $columns['event_target_group'] = 'event_target_group';
        return $columns;
}

function event_target_group_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_target_group' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'event_target_group',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-events_sortable_columns', 'event_location_column_register_sortable');
add_filter('request', 'event_location_column_orderby' );

function event_location_column_register_sortable( $columns ) {
        $columns['event_location'] = 'event_location';
        return $columns;
}

function event_location_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_location' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'event_location',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}

add_filter('manage_edit-events_sortable_columns', 'event_cost_column_register_sortable');
add_filter('request', 'event_costs_column_orderby' );

function event_cost_column_register_sortable( $columns ) {
        $columns['event_costs'] = 'event_costs';
        return $columns;
}

function event_costs_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_costs' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'event_costs',
            'orderby' => 'meta_value'
        ) );
    }
    return $vars;
}
