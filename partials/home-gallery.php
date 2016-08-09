<?php
/*
* Home Gallery Snippet
*
* @package al3
* @subpackage Events
*/
?>

<h2 class="archive-title block-title card cf">

    <?php

    $al3_block_url = get_theme_mod('al3_gallery_setting');

    if ( !empty ($al3_block_url)) { ?>
        <a href="<?php echo $al3_block_url ?>" rel="bookmark" title="<?php _e('View more Pictures', 'al3'); ?>"><?php _e('Latest Pictures', 'al3'); ?></a>
    <?php } else { _e('Latest Pictures', 'al3'); }; ?>

</h2>

<div class="hentry home-block block-gallery gallery-snippet card cf">

    <?php

    $today = current_time('Ymd');

    // Define custom query parameters
    $events_query_args = array(
        'posts_per_page' => 3, // Display a custom amount of posts
        'post_type' => 'events', // Tell WordPress to show only events posts
        'orderby' => 'meta_value', // We want to organize the events by date
        'meta_key' => 'event_start_date', // Grab the "start date" field data
        'order' => 'DSC', // DSC is the other option
        'meta_query' => array( // WordPress has all the results, now, return only the events before today's date
            'relation' => 'AND', // Query must be whithin date range, but should also include only posts with images
            array(
                'key' => 'event_start_date', // Check the start date field
                'value' => $today, // Set today's date (note the similar format)
                'compare' => '<', // Return the ones greater than today's date
                'type' => 'NUMERIC,' // Let WordPress know we're working with numbers
            ),
            array(
                'key'     => 'gallery_images', // Check the gallery images field
                'value'   => '', // Is it empty?
                'compare' => '!=' // Show only events which have images assigned
            )
        )
    );

    // Instantiate custom query
    $events_query = new WP_Query( $events_query_args );

    ?>

    <?php if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('chronicle-entry'); ?> >

            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">


                <div class="overlay-wrapper">
                    <span class="dashicons dashicons-visibility"></span>
                    <div class="overlay"></div>
                </div>


                <header class="article-header thumbnail-header">

                        <?php

                        $images = get_field('gallery_images');

                        if( $images ): ?>

                            <img
                                 class="wp-image alignleft gallery-thumbnail rounded"
                                 alt="<?php echo $images[array_rand($images)]['alt']; ?>"
                                 src="<?php echo $images[array_rand($images)]['sizes']['thumbnail']; ?>"
                            >

                        <?php endif; ?>

                </header>

                <section class="entry-content cf">

                    <h2 class="gallery-title"><?php the_title(); ?></h2>

                    <?php

                    $meta_start_date = get_field( 'event_start_date' );
                    $meta_end_date = get_field( 'event_end_date' );

                    if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
                        printf( '<p class="byline chronicle-date"><span class="gallery-icon dashicons dashicons-calendar-alt"></span>' . __( 'On %s', 'al3' ) . '</p>',
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
                              );
                    }

                    if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
                        printf( '<p class="byline chronicle-date"><span class="gallery-icon dashicons dashicons-calendar-alt"></span>' . __( 'From %1$s to %2$s', 'al3' ) . '</p>',
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
                              );
                    }

                    ?>

                </section><?php // end .entry-content ?>

            </a>

        </article><?php // end article ?>

    <?php endwhile; ?>

    <?php else : ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
                <h1><?php _e( 'Oops, Post Not Found!', 'al3' ); ?></h1>
            </header>
            <div class="entry-content">
                <p><?php _e( 'Nothing, but absolutely nothing, was found. How did you do this?', 'al3' ); ?></p>
            </div>
            <footer class="article-footer">
                <p><?php _e( 'Well, if you are not sure about what you just did, simply tell us via redaktion@al3.de. Thank you!', 'al3' ); ?></p>
            </footer>
        </article>

    <?php endif; ?>

</div> <?php // end .block-gallery ?>
