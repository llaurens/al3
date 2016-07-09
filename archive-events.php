<?php
/*
* Events Archive Page
*
* @package al3
* @subpackage Events
*/
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <h1 class="archive-title card">
                        <?php post_type_archive_title(); ?>
                </h1>

                <?php $terms = get_terms('event_target_group');

                if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                    $count = count($terms);
                    $i=0;
                    $term_list = '<div class="target-group-buttons card cf">';
                    $term_list .= '<h3 class="cf">' . __( 'Show only events for:', 'al3' ) . '</h3><p>';
                    foreach ($terms as $term) {
                        $i++;
                        $term_list .= '<a class="h3 btn blue-btn" href="' . get_term_link( $term ) . '" title="' . sprintf(__('Show all events for %s', 'al3'), $term  ->name) . '">' . $term->name . '</a>';
                        if ($count != $i) {
                            $term_list .= ' &nbsp; ';
                        }
                    }
                    $term_list .= '</p></div>';
                    echo $term_list;
                } ?>

                <?php

                $today = current_time('Y-m-d');

                $events_args = array(
                    'paged' => $paged, // Pagination Fix
                    'posts_per_page' => get_option( 'posts_per_page' ), // Display a custom amount of posts
                    'post_type' => 'events', // Tell WordPress to show only events posts
                    'orderby' => 'meta_value', // We want to organize the events by date
                    'meta_key' => 'event_start_date', // Grab the "start date" field data
                    'order' => 'ASC', // DSC is the other option
                    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                        array(
                            'key' => 'event_start_date', // Check the start date field
                            'value' => $today, // Set today's date (note the similar format)
                            'compare' => '>=', // Return the ones greater than today's date
                            'type' => 'NUMERIC,' // Let WordPress know we're working with numbers
                        )
                    )
                );

                $events_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                $events = new WP_Query( $events_args );

                // Pagination fix
                $temp_query = $wp_query;
                $wp_query   = NULL;
                $wp_query   = $events;

                ?>

                <?php if ( $events->have_posts()) : while ( $events->have_posts()) : $events->the_post(); ?>

                        <?php get_template_part( 'partials/archive', 'events' ); ?>

				<?php endwhile; ?>

				    <?php al3_page_navi(); ?>

				<?php else : ?>

                    <?php get_template_part( 'partials/404', 'events' ); ?>

				<?php endif; ?>

                <?php
                // Reset postdata
                wp_reset_postdata();
                $wp_query = NULL;
                $wp_query = $temp_query;
                ?>

            </main>
        </div>
    </div>

<?php get_footer(); ?>
