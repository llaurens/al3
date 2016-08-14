<?php
/*
* Single Event
*
* @package al3
* @subpackage Events
*/
?>

<?php ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>  itemscope itemtype="http://schema.org/SocialEvent">

    <header class="article-header">

        <h1 class="single-title entry-title event-title" itemprop="name">
            <?php if ( is_past_event() ) { ?><span><?php _e( 'Pictures:', 'al3' ); ?> </span> <?php } ?><?php the_title(); ?>
        </h1>

        <?php if ( is_past_event() ) { ?>

                <?php
                $meta_start_date = get_field( 'event_start_date' );
                $meta_end_date = get_field( 'event_end_date' );

                if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
                    printf( '<h3>' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h3>',
                           date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
                          );
                }

                if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
                    printf( '<h3>' . __( 'From', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s ' . __( 'to', 'al3' ) .  '<meta itemprop="endDate" content="%3$s"> %4$s' . '</h3>',
                           date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( "c", strtotime( get_field( 'event_end_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
                          );
                    }

            ?>

            <div class="cf">

                <?php

                $images = get_field('gallery_images');

                if( $images ): ?>

                    <div id="grid" class="al-gallery gallery cf">

                        <?php foreach( $images as $image ): ?>
                            <div class="grid-particle">
                                <div class="image-wrapper">
                                    <a class="lightbox" href="<?php echo $image['url']; ?>">
                                        <img
                                             class="lazy"
                                             alt="<?php echo $image['alt']; ?>"
                                             data-original="<?php echo $image['sizes']['thumbnail']; ?>"
                                             data-original-set="<?php echo $image['sizes']['thumbnail'] . ' 1x, ' . $image['sizes']['al3-retina-thumb'] . ' 2x'; ?>"
                                        >
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div><?php // end #grid ?>

                <?php endif; ?>

            </div><?php // end .cf ?>

        <?php } else { ?>

            <p class="byline">
                <?php printf( __( 'Added <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author fn">%3$s</span>', 'al3' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
            </p>


            <div class="meta-wrapper m-all t-all d-all">

                <?php
                $meta_target_group = get_the_term_list( $post->ID, 'event_target_group', ' ', '  	&amp; ', '' );
                $meta_start_date = get_field( 'event_start_date' );
                $meta_end_date = get_field( 'event_end_date' );
                $meta_location = get_field( 'event_location' );
                $meta_costs = get_field( 'event_costs' );
                $meta_registration = get_field( 'event_registration' );
                $meta_leader = get_field( 'event_leader' );
                $meta_url = get_field( 'event_url' );
                $meta_link = '<a href="' . $meta_url . '" title="' . get_the_title() . '" target="_blank">' . get_the_title() . '</a>';

                if( !empty( $meta_target_group )) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf"><span class="dashicons dashicons-groups"></span>' . __( '%1$s', 'al3' ) . '</h4>',
                        $meta_target_group
                    );
                }

                if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h4>',
                        date_i18n( "c", strtotime( $meta_start_date ) ),
                        date_i18n( get_option( 'date_format' ), strtotime( $meta_start_date ) )
                    );
                }

                if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'From', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s ' . __( 'to', 'al3' ) .  '<meta itemprop="endDate" content="%3$s"> %4$s' . '</h4>',
                           date_i18n( "c", strtotime( $meta_start_date ) ),
                           date_i18n( get_option( 'date_format' ), strtotime( $meta_start_date ) ),
                           date_i18n( "c", strtotime( $meta_end_date ) ),
                           date_i18n( get_option( 'date_format' ), strtotime( $meta_end_date ) )
                    );
                }

                if( ! empty( $meta_location ) ) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf" title="' . __( 'The event takes place at %1$s.', 'al3' ) . '"><span class="dashicons dashicons-location-alt"></span>' . __( '%2$s', 'al3' ) . '</h4>',
                        $meta_location,
                        '<span itemprop="location">' . $meta_location . '</span>'
                    );
                }

                if( ! empty( $meta_costs ) && is_user_logged_in() ) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf" title="' . __( 'This event costs %1$s Euro.', 'al3' ) . '"><span class="dashicons dashicons-tickets-alt"></span>' . __( '%1$s Euro', 'al3' ) . '</h4>',
                        $meta_costs
                    );
                }

                if( ! empty( $meta_registration ) && is_user_logged_in() ) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf" title="' . __( 'You can register at %1$s.', 'al3' ) . '"><span class="dashicons dashicons-tickets-alt"></span>' . __( '%1$s', 'al3' ) . '</h4>',
                        $meta_registration
                    );
                }

                if( ! empty( $meta_leader ) && is_user_logged_in() ) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf" title="' . __( 'This event is organized by %1$s.', 'al3' ) . '"><span class="dashicons dashicons-businessman"></span>' . __( '%1$s', 'al3' ) . '</h4>',
                        $meta_leader
                    );
                }

                if( ! empty( $meta_url ) && is_user_logged_in() ) {
                    printf(
                        '<h4 class="m-all t-1of2 d-1of2 cf" title="' . __( 'More information at %1$s.', 'al3' ) . '"><span class="dashicons dashicons-admin-links"></span>' . __( '%1$s', 'al3' ) . '</h4>',
                        $meta_link
                    );
                }

                ?>

            </div><?php // end meta-wrapper ?>

        </header>

        <div class="entry-content cf" itemprop="description">

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
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>

        </div>

        <?php comments_template(); ?>

    <?php } ?> <?php // end is past condition ?>


</article><?php // end article

?>
