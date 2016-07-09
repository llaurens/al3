<?php
/*
* Management Archive Page
*
* @package al3
* @subpackage Management
*/
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <div class="info cf">
                    <header>
                        <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
                    </header></div>
                <div class="head cf">

                        <?php

                        $head_args = array(
                            'posts_per_page' => -1, // Display all members of the head
                            'post_type' => 'management', // Tell WordPress to show only management posts
                            'orderby' => 'meta_value', // We want to organize the groups by date
                            'meta_key' => 'management_birthday', // Grab the "start date" field data
                            'order' => 'ASC', // We sort the head from old and wise to young and wild
                            'meta_query' => array( // WordPress has all the results, now, return only the members that are in the head
                                array(
                                    'key' => 'management_head', // Check the head field
                                    'value' => 1, // Compare to this value (true)
                                    'compare' => '==' // Return the ones that are in the head
                                )
                            )
                        );

                        $head = new WP_Query( $head_args );

                        ?>

                        <?php if ( $head->have_posts()) : ?>

                            <header>
                                <h2 class="archive-title"><?php _e('Head of Management', 'al3'); ?></h2>
                            </header>

                        <?php while ( $head->have_posts()) : $head->the_post(); ?>

                            <?php get_template_part( 'partials/archive', 'management' ); ?>

                        <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part( 'partials/404', 'management_leader' ); ?>

                        <?php endif; ?>

                    </div>

                <div class="management cf">

                        <?php

                        $head_args = array(
                            'posts_per_page' => -1, // Display all members of the management
                            'post_type' => 'management', // Tell WordPress to show only management posts
                            'orderby' => 'meta_value', // We want to organize the groups by date
                            'meta_key' => 'management_birthday', // Grab the "start date" field data
                            'order' => 'DESC', // And here the other way round
                            'meta_query' => array( // WordPress has all the results, now, return only the members that are not in the head
                                array(
                                    'key' => 'management_head', // Check the head field
                                    'value' => 1, // Compare to this value (true)
                                    'compare' => '!=' // The other way round: Return the ones that not are in the head
                                )
                            )
                        );

                        $head = new WP_Query( $head_args );

                        ?>

                        <?php if ( $head->have_posts()) : ?>

                            <header>
                                <h2 class="archive-title"><?php _e('Management', 'al3'); ?></h2>
                            </header>

                        <?php while ( $head->have_posts()) : $head->the_post(); ?>

                            <?php get_template_part( 'partials/archive', 'management' ); ?>

                        <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part( 'partials/404', 'management' ); ?>

                        <?php endif; ?>

                    </div>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
