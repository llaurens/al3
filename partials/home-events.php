<?php
/*
* Home Events Snippet
*
* @package al3
* @subpackage Events
*/
?>

<h2 class="archive-title block-title card cf">

    <?php

    $al3_block_url = get_theme_mod('al3_events_setting');

    if ( !empty ($al3_block_url)) { ?>
        <a href="<?php echo $al3_block_url ?>" rel="bookmark" title="<?php _e('View more Events', 'al3'); ?>"><?php _e('Next Events', 'al3'); ?></a>
    <?php } else { _e('Next Events', 'al3'); }; ?>

</h2>

<div class="hentry home-block block-events card cf">

    <?php

    $today = current_time('Ymd');

    // Define custom query parameters
    $events_query_args = array(
        'posts_per_page' => 3, // Display a custom amount of posts
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

    // Instantiate custom query
    $events_query = new WP_Query( $events_query_args );

    ?>

    <?php if ($events_query->have_posts()) : while ($events_query->have_posts()) : $events_query->the_post(); ?>

        <?php

        $count = $events_query->post_count;

        if ( $count = 3 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of3 d-1of3 cf' ); ?> >
        <?php } elseif ( $count = 2 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of2 d-1of2 cf' ); ?> >
        <?php } elseif ( $count = 1 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-all d-all cf' ); ?> >
        <?php } ?>

                <header class="article-header">

                    <h1 class="h2 entry-title" itemprop="name">
                        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
                    </h1>

                </header>

                <div class="entry-content cf">

                    <?php

                    $meta_start_date = get_field( 'event_start_date' );
                    $meta_end_date = get_field( 'event_end_date' );


                    if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
                        printf( '<h4 class="footer-meta">' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h4>',
                               date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
                              );
                    }

                    if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
                        printf( '<h4 class="footer-meta">' . __( 'From', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s ' . __( 'to', 'al3' ) .  '<meta itemprop="endDate" content="%3$s"> %4$s' . '</h4>',
                               date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                               date_i18n( "c", strtotime( get_field( 'event_end_date' )) ),
                               date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
                              );
                    }

                    ?>

                </div>

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

</div> <?php // end .block-events ?>
