<?php

/************* MANAGEMENT METABOXES *************/

/*
This are the function to display metaboxes for events
in the backend.
*/

function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['birthday'] = 'Twitter Username';

	// Remove old fields
	unset($profile_fields['googleplus']);
	unset($profile_fields['twitter']);
	unset($profile_fields['facebook']);

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');


if ( ! function_exists( 'al3_management_metaboxes' ) ) {

    function al3_management_metaboxes() {

        if(function_exists('register_field_group')) {

            register_field_group(array (
                'id' => 'acf_management',
                'title' => __('Management', 'al3'),
                'fields' => array (

                    array (
                        'key' => 'field_55d71942e1a89',
                        'label' => __('Official Name', 'al3'),
                        'name' => 'management_name',
                        'type' => 'text',
                        'instructions' => __('What is the civil Name of this Person?', 'al3'),
                        'default_value' => '',
                        'placeholder' => __('James', 'al3'),
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),

                    array (
                        'key' => 'field_55d71942e1af0',
				        'label' => __('Head', 'al3'),
				        'name' => 'management_head',
				        'type' => 'true_false',
				        'instructions' => __('Is this person part of the head of administration?', 'al3'),
				        'message' => '',
				        'default_value' => 0,
                    ),

                    array (
				        'key' => 'field_55d7197ae1af1',
				        'label' => 'E-Mail',
				        'name' => 'management_mail',
				        'type' => 'email',
				        'instructions' => __('What E-Mail has this manager?', 'al3'),
				        'default_value' => '',
				        'placeholder' => 'chef@stammalexanderlion.de',
				        'prepend' => '',
				        'append' => '',
                    ),

                    array (
				        'key' => 'field_55d718e8e1aef',
				        'label' => __('Birthday', 'al3'),
				        'name' => 'management_birthday',
				        'type' => 'date_picker',
				        'instructions' => __('When is this member of the management born?', 'al3'),
				        'date_format' => 'yy-mm-dd',
				        'display_format' => __('d. MM yy', 'al3'),
				        'first_day' => 1,
                    ),

                    array (
                        'key' => 'field_56e9115c7356c',
                        'label' => __('Link to User Profile', 'al3'),
                        'name' => 'management_link',
                        'type' => 'user',
                        'instructions' => __('You can link this member to a user profile of this page, if you would like to', 'al3'),
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'role' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                ),


                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'management',
                            'order_no' => 0,
                            'group_no' => 0,
                        ),
                    ),
                ),

                'options' => array (
                    'position' => 'acf_after_title',
                    'layout' => 'default',
                    'hide_on_screen' => array (),
                ),
                'menu_order' => 0,
            ));
        }
    }
}

?>
