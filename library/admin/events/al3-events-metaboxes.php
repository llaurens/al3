<?php

/************* EVENT METABOXES *************/

/*
This are the function to display metaboxes for events
in the backend.
*/

if ( ! function_exists( 'al3_events_metaboxes' ) ) {

    function al3_events_metaboxes() {

        if(function_exists("register_field_group")) {

            register_field_group(array (
		      'id' => 'acf_events',
		      'title' => __('Information on the event', 'al3'),
		      'fields' => array (
			     array (
				    'key' => 'field_54288748236b3',
				    'label' => __('Basic', 'al3'),
				    'name' => '',
				    'type' => 'tab',
			     ),
                array (
                    'key' => 'field_5428862ece45f',
                    'label' => __('Start Date', 'al3'),
                    'name' => 'event_start_date',
                    'type' => 'date_picker',
                    'instructions' => __('When does the event start?', 'al3'),
                    'required' => 1,
                    'date_format' => 'yy-mm-dd',
                    'display_format' => __('d. MM yy', 'al3'),
                    'first_day' => 1,
                ),
                array (
                    'key' => 'field_5428867bce460',
                    'label' => __('End Date', 'al3'),
                    'name' => 'event_end_date',
                    'type' => 'date_picker',
                    'instructions' => __('How long will the event take?', 'al3'),
                    'date_format' => 'yy-mm-dd',
                    'display_format' => __('d. MM yy', 'al3'),
                    'first_day' => 1,
                ),
                array (
                    'key' => 'field_54288793236b4',
                    'label' => __('Location', 'al3'),
                    'name' => 'event_location',
                    'type' => 'text',
                    'instructions' => __('Where does the event takes place?', 'al3'),
                    'default_value' => '',
                    'placeholder' => __('Hoffeld', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_542887b4236b5',
                    'label' => __('Details', 'al3'),
                    'name' => '',
                    'type' => 'tab',
                ),
                array (
                    'key' => 'field_542887c2236b6',
                    'label' => __('Costs', 'al3'),
                    'name' => 'event_costs',
                    'type' => 'number',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => __('&euro;', 'al3'),
                    'min' => '',
                    'max' => '',
                    'step' => '0.5',
                ),
                array (
                    'key' => 'field_542887de236b7',
                    'label' => __('Registration', 'al3'),
                    'name' => 'event_registration',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_542887f7236b8',
                    'label' => __('Leader', 'al3'),
                    'name' => 'event_leader',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_5443fd1ce52ec',
                    'label' => __('URL', 'al3'),
                    'name' => 'event_url',
                    'type' => 'text',
                    'instructions' => __('URL for further Information', 'al3'),
                    'default_value' => '',
                    'placeholder' => __('http://www.dpbm.de/', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
			     ),
                array (
                    'key' => 'field_542887b7236b6',
                    'label' => __('Pictures', 'al3'),
                    'name' => '',
                    'type' => 'tab',
                ),
                array (
                    'key' => 'field_56e7f2a709745',
                    'label' => __('Pictures', 'al3'),
                    'name' => 'gallery_images',
                    'type' => 'gallery',
                    'instructions' => __('If you have got any images of this event, simply drop them here and they will appear in the chronicle', 'al3'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'min' => '',
                    'max' => '',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => 'jpeg,jpg,png',
                ),
            ),

            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'events',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'menu_order' => 0,
                'position' => 'acf_after_title',
                'style' => 'seamless',
	           'label_placement' => 'top',
	           'instruction_placement' => 'label',
                'hide_on_screen' => array (
                    0 => 'custom_fields',
                ),
            ),
        ));

        }

    }
}

?>
