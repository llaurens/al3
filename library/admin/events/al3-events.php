<?php
/**
* Plugin Name: al3 Events
* Plugin URI: http://lamberty.me/
* Description: A custom post type plugin to create events. Only matching with an al3-theme.
* Version: 1.2.1
* Author: Laurens Lamberty
* Author URI: http://lamberty.me/
* License: Apache License 2.0
*/

/************* EVENTS *************/

/*
The events module is basically a custom post
type with additional information on date, costs,
blabla on the event. This file is like a core for
the post type and its mail purpose is therefore
the activation of the custom post type in the
backend on the users request. When done so, it
furthermore loads a few additional files to handle
the metadata.
*/

// Enabling Events Module
require_once( 'al3-events-metaboxes.php' ); // Event Metaboxes
require_once( 'al3-events-core.php' ); // Core File

function change_order_for_events( $query ) {
    //only show future events and events in the last 24hours

    $today = current_time('Y-m-d');

    if ( ! is_admin() ) {

        if ( $query->is_main_query() && (is_tax('event_target_group') || is_post_type_archive('events')) ) {
            $query->set( 'meta_key', 'event_start_date' );
            $query->set( 'orderby', 'meta_value_num' );
            $query->set( 'order', 'ASC' );

            //Get events after 24 hours ago
            $query->set( 'meta_value', $today );
            $query->set( 'meta_compare', '>=' );

           //Get events before now
           //$query->set( 'meta_value', current_time('timestamp') );
           //$query->set( 'meta_compare', '<' );
        }

        if ( $query->is_main_query() && (is_tax('event_target_group')) ) {
            $query->set( 'posts_per_page', -1 );
        }
    }
}

add_action( 'pre_get_posts', 'change_order_for_events' );

?>
