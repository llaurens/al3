<?php

/************* EVENT METABOXES *************/

/*
This are the function to display metaboxes for events
in the backend.
*/

if ( ! function_exists( 'al3_groups_metaboxes' ) ) {

    function al3_groups_metaboxes() {

        if(function_exists('register_field_group')) {

            register_field_group(

                array (
                    'id' => 'acf_groups',
                    'title' => __('Groups', 'al3'),
                    'fields' => array (

                        array (
                            'key' => 'field_54288748276b3',
                            'label' => __('Basic', 'al3'),
                            'type' => 'tab',
                        ),

                        array (
                            'key' => 'field_55d5d970ded9f',
                            'label' => __('Age', 'al3'),
                            'name' => 'groups_ages',
                            'type' => 'select',
                            'instructions' =>   __('Which is the age of the group?', 'al3'),
                            'choices' => array (
                                '01' => __('Cubs', 'al3'),
                                '02' => __('Scouts', 'al3'),
                                '03' => __('Rover', 'al3'),
                            ),
                            'default_value' => '02',
                            'allow_null' => 0,
                            'multiple' => 0,
                        ),

                        array (
                            'key' => 'field_542887c2636b6',
                            'label' => __('Members', 'al3'),
                            'name' => 'groups_members',
                            'type' => 'text',
                            'instructions' => __('Who can join the group?', 'al3'),
                            'required' => 0,
                            'default_value' => '',
                            'placeholder' => __('Boys and girls from 8 to 10 years', 'al3'),
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),


                        array (
                            'key' => 'field_55d5d68088ebb',
                            'label' => __('Leader', 'al3'),
                            'name' => 'groups_leader',
                            'type' => 'text',
                            'instructions' => __('Who is the leader of this group?', 'al3'),
                            'required' => 0,
                            'default_value' => '',
                            'placeholder' => __('James', 'al3'),
                            'prepend' => '',
                            'append' => '',
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),

                        array (
                            'key' => 'field_55d5d8ba98a2e',
                            'label' => __('E-Mail', 'al3'),
                            'name' => 'groups_mail',
                            'type' => 'email',
                            'instructions' => __('What is the e-mail of this group?', 'al3'),
                            'default_value' => '',
                            'placeholder' => __('meute@stammalexanderlion.de', 'al3'),
                            'prepend' => '', 'append' => '',
                        ),

                        array (
                            'key' => 'field_54288749236b3',
                            'label' => __('Schedule', 'al3'),
                            'type' => 'tab',
                        ),

                        array (
                            'key' => 'field_55d5d930ded9f',
                            'label' => __('Day', 'al3'),
                            'name' => 'groups_meet_day',
                            'type' => 'select',
                            'instructions' => __('On which day of the week does this group meet?', 'al3'),
                            'choices' => array (
                                '01' => __('Monday', 'al3'),
                                '02' => __('Tuesday', 'al3'),
                                '03' => __('Wednesday', 'al3'),
                                '04' => __('Thursday', 'al3'),
                                '05' => __('Friday', 'al3'),
                                '06' => __('Saturday', 'al3'),
                                '07' => __('Sunday', 'al3'),
                            ),
                            'default_value' => '',
                            'allow_null' => 1,
                            'multiple' => 0,
                        ),

                        array (
                            'key' => 'field_55d5da0ededa0',
                            'label' => __('Time', 'al3'),
                            'name' => 'groups_meet_time',
                            'type' => 'text',
                            'instructions' => __('When does this group meet?', 'al3'),
                            'default_value' => '',
                            'placeholder' => __('From 2 p.m. to 4 p.m.', 'al3'),
                            'prepend' => __('Starting at', 'al3'),
                            'append' => __('clock', 'al3'),
                            'formatting' => 'html',
                            'maxlength' => '',
                        ),

                    ),

                    'location' => array (
                        array (
                            array (
                                'param' => 'post_type',
                                'operator' => '==',
                                'value' => 'groups',
                                'order_no' => 0,
                                'group_no' => 0,
                            ),
                        ),
                    ),

                    'options' => array (
                        'position' => 'acf_after_title',
                        'layout' => 'default',
                        'hide_on_screen' => array ( ), ),
                    'menu_order' => 0,
                ));

        }

    }
}

function al3_acf_select_labels($select_name) {

    $field = get_field_object($select_name);
    $value = get_field($select_name);
    $label = $field['choices'][ $value ];

    if ( $label == 'null' ) {
        _e('Not specified', 'al3');

    } else {
        echo $label;
    }
}

?>
