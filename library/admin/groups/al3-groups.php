<?php
/**
* Plugin Name: al3 Groups
* Plugin URI: http://lamberty.me/
* Description: A custom post type plugin to create groups. Only matching with an al3-theme.
* Version: 1.1.1
* Author: Laurens Lamberty
* Author URI: http://lamberty.me/
* License: Apache License 2.0
*/

/************* GROUPS *************/

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

// Enabling Groups Module
require_once( 'al3-groups-metaboxes.php' ); // Groups Metaboxes
require_once( 'al3-groups-core.php' ); // Core File

?>
