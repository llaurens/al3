<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <h1 class="archive-title">
                        <?php post_type_archive_title(); ?>
                </h1>

                <?php

                $today = current_time('Y-m-d');

                $gallery_link = get_field('gallery_link');

                if( ! empty($gallery_link)) { $start_date = get_field('event_start_date', $gallery_link[0]); }

                $events_args = array(
                    'paged' => $paged, // Pagination Fix
                    'posts_per_page' => get_option( 'posts_per_page' ), // Display a custom amount of posts
                    'post_type' => 'gallery', // Tell WordPress to show only events posts
                    //'orderby' => 'meta_value', // We want to organize the events by date
                    //'meta_key' => 'event_start_date', // Grab the "start date" field data
                    'order' => 'ASC', // DSC is the other option
                );

                $events_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                $events = new WP_Query( $events_args );

                // Pagination fix
                $temp_query = $wp_query;
                $wp_query   = NULL;
                $wp_query   = $events;

                ?>

                <?php if ( $events->have_posts()) : while ( $events->have_posts()) : $events->the_post(); ?>

                        <?php get_template_part( 'partials/archive', 'gallery' ); ?>

				<?php endwhile; ?>

				    <?php al3_page_navi(); ?>

				<?php else : ?>

                    <?php get_template_part( 'partials/404', 'gallery' ); ?>

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
