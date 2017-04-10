<?php
/*
* User Metaboxes
*
* @package al3
* @subpackage Management
*/

?>

<?php

/************ USER/MANAGEMENT METABOXES *************/

/*
This metaboxes are dispayed when editing or adding a user.
They will be used both for displaying the management but also
for fetching data from regular users.
*/


if ( ! function_exists( 'al3_user_metaboxes' ) ) {

    function al3_user_metaboxes() {

        if ( function_exists('acf_add_local_field_group') ) {

            acf_add_local_field_group( array (
                'key' => 'group_576fa003db685',
                'title' => __('Detailed Information', 'al3'),
                'fields' => array (

                array (
                    'key' => 'field_57ac960511bb8',
                    'label' => __('Avatar', 'al3'),
                    'name' => 'user_avatar',
                    'type' => 'image',
                    'instructions' => __('Upload an avatar here! It will be shown in the intern part of the website or at the gallery of the management.', 'al3'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'id',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => 150,
                    'min_height' => 150,
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => 1,
                    'mime_types' => 'jpg,jpeg,png,webp,gif',
                ),

                array (
                    'key' => 'field_576fa01059514',
                    'label' => __('Birthday', 'al3'),
                    'name' => 'user_birthday',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => get_option( 'date_format' ),
                    'return_format' => 'yy-mm-dd',
                    'first_day' => 1,
                ),

                array (
                    'key' => 'field_57ab6e0d43008',
                    'label' => __('Sex', 'al3'),
                    'name' => 'user_sex',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                        'f' => __('Female', 'al3'),
                        'm' => __('Male', 'al3'),
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),

                array (
                    'key' => 'field_57ab6bc143002',
                    'label' => __('Street', 'al3'),
                    'name' => 'user_street',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('Brücherweg 26', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

                array (
                    'key' => 'field_57ab6be443003',
                    'label' => __('Zip Code', 'al3'),
                    'name' => 'user_zip',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('53604', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => 99999,
                    'step' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

                array (
                    'key' => 'field_57ab6c3843004',
                    'label' => __('Location', 'al3'),
                    'name' => 'user_location',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('Bad Honnef', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

                array (
                    'key' => 'field_57ab6c6b43005',
                    'label' => __('State', 'al3'),
                    'name' => 'user_state',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                        'BW' => __('Badem-Württemberg', 'al3'),
                        'BY' => __('Bayern', 'al3'),
                        'BE' => __('Berlin', 'al3'),
                        'BB' => __('Brandenburg', 'al3'),
                        'HB' => __('Bremen', 'al3'),
                        'HH' => __('Hamburg', 'al3'),
                        'HE' => __('Hessen', 'al3'),
                        'MV' => __('Mecklenburg-Vorpommern', 'al3'),
                        'NI' => __('Niedersachsen', 'al3'),
                        'NW' => __('Nordrhein-Westfalen', 'al3'),
                        'RP' => __('Rheinland-Pfalz', 'al3'),
                        'SL' => __('Saarland', 'al3'),
                        'SN' => __('Sachsen', 'al3'),
                        'ST' => __('Sachsen-Anhalt', 'al3'),
                        'SH' => __('Schleswig-Holstein', 'al3'),
                        'TH' => __('Thüringen', 'al3'),
                    ),
                    'default_value' => array (
                        0 => 'NW',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'placeholder' => '',
                ),

                array (
                    'key' => 'field_57ab6d7e43006',
                    'label' => __('Phone', 'al3'),
                    'name' => 'user_phone',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('+49 (2224) 70332', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

                array (
                    'key' => 'field_57ab6dbd43007',
                    'label' => __('Mobile', 'al3'),
                    'name' => 'user_mobile',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('+49 (151) 27537090', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

                array (
                    'key' => 'field_576fa11f59516',
                    'label' => __('Group', 'al3'),
                    'name' => 'user_group',
                    'type' => 'relationship',
                    'instructions' => __('Which group is the user part of?', 'al3'),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array (
                        0 => 'groups',
                    ),
                    'taxonomy' => array (
                    ),
                    'filters' => array (
                        0 => 'search',
                    ),
                    'elements' => array (
                        0 => 'featured_image',
                    ),
                    'min' => '',
                    'max' => '',
                    'return_format' => 'id',
                ),

                array (
                    'key' => 'field_576fa06b59515',
                    'label' => __('Part of Management', 'al3'),
                    'name' => 'user_management',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                        '01' => __('Director', 'al3'),
                        '02' => __('Leader', 'al3'),
                        '03' => __('Management', 'al3'),
                        '00' => __('No Part in Management', 'al3'),
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '00',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                ),
                array (
                    'key' => 'field_57ab6e624300a',
                    'label' => __('Function', 'al3'),
                    'name' => 'user_function',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_576fa06b59515',
                                'operator' => '==',
                                'value' => 'management',
                            ),
                        ),
                        array (
                            array (
                                'field' => 'field_576fa06b59515',
                                'operator' => '==',
                                'value' => 'director',
                            ),
                        ),
                    ),
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => __('Director', 'al3'),
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),

            ),


	       'location' => array (
                array (
                    array (
                        'param' => 'user_form',
                        'operator' => '==',
                        'value' => 'all',
                    ),
                ),
                array (
                    array (
                        'param' => 'current_user_role',
                        'operator' => '==',
                        'value' => 'author',
                    ),
                ),
            ),

            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'field',
            'hide_on_screen' => '',
            'active' => 1,
            'description' => '',

            ));
        }
    }
}
