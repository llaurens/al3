<?php
/*
Template Name: Chronicle
*
* @package al3
* @subpackage Page Templates
*
* Love this page template. It queues all past events and groups them
* by the year they occured.
*/
__( 'Chronicle', 'al3' );
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="archive wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card cf' ); ?> >

				        <header class="article-header">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header> <?php // end article header ?>

				        <div class="entry-content cf">
				            <?php
				            // the content (pretty self explanatory huh)
				            the_content();

                            /*
                             * Link Pages is used in case you have posts that are set to break into
                             * multiple pages. You can remove this if you don't plan on doing that.
                             *
                             * Also, breaking content up into multiple pages is a horrible experience,
                             * so don't do it. While there are SOME edge cases where this is useful, it's
                             * mostly used for people to get more ad views. It's up to you but if you want
                             * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
                             *
                             * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
                             *
                             */
				            wp_link_pages( array(
                                'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
                                'after'  => '</div>',
				                'link_before' => '<span>',
								'link_after'  => '</span>',
                            ) );
                            ?>
				        </div> <?php // end article div ?>

                    </article>

                    <div class="card chronicle cf">

                        <?php

                        $today = current_time('Ymd');

                        $events_args = array(
                            'paged' => $paged, // Pagination Fix
                            'posts_per_page' => -1, // Display a custom amount of posts
                            'post_type' => 'events', // Tell WordPress to show only events posts
                            'orderby' => 'meta_value', // We want to organize the events by date
                            'meta_key' => 'event_start_date', // Grab the "start date" field data
                            'order' => 'DSC', // DSC is the other option
                            'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                                array(
                                    'key' => 'event_start_date', // Check the start date field
                                    'value' => $today, // Set today's date (note the similar format)
                                    'compare' => '<', // Return the ones greater than today's date
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

                        <?php
                            $date = 0;
                            $newDate = true;
                        ?>

                        <?php if ( $events->have_posts()) : while ( $events->have_posts()) :   $events->the_post(); ?>

                            <?php

                            $meta_end_date = get_field( 'event_start_date' );

                            if ($date == 0)
                                $date = date_i18n( "Y", strtotime( $meta_end_date ));
                            else if ($date != date_i18n( "Y", strtotime( $meta_end_date ))) {
                                $date = date_i18n( "Y", strtotime( $meta_end_date ));
                                $newDate = true;
                            }

                            if ($newDate)
                                echo '<a href="#" class="has-children year-' . $date . '" ><h2 class="chronicle-headline">' . $date . '</h2></a>';

                            $newDate = false;

                            ?>

                            <?php get_template_part( 'partials/chronicle', 'events' ); ?>


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

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

                </div>

            </main>
        </div>
    </div>

<?php get_footer(); ?>
