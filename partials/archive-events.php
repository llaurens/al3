<article id="post-<?php the_ID(); ?>" <?php post_class('card cf'); ?>  itemscope itemtype="http://schema.org/SocialEvent">

    <header class="article-header">

        <h1 class="h2 entry-title" itemprop="name">

            <?php if ( is_user_logged_in()) { ?>
                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
            <?php } else { the_title(); } ?>

        </h1>

            <p class="byline entry-meta vcard">
                    <?php printf( __( 'Added', 'al3' ).' %1$s %2$s',
                    /* the time the post was published */
                    '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                    /* the author of the post */
                    '<span class="by">'.__( 'by', 'al3').'</span> <span class="entry-author author" itemprop="author" itemscope itemtype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>.'
                    ); ?>
            </p>

    </header>

    <div class="entry-content cf" itemprop="description">
        <?php the_content(); ?>
    </div>

    <footer class="article-footer cf">

        <?php

        $meta_target_group = get_the_term_list( $post->ID, 'event_target_group', ' ', '  	&amp; ', '' );
        $meta_start_date = get_field( 'event_start_date' );
        $meta_end_date = get_field( 'event_end_date' );
        $meta_location = get_field( 'event_location' );

        if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
            printf(
                '<h4 class="m-all t-1of3 d-1of3 cf"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h4>',
                date_i18n( "c", strtotime( $meta_start_date ) ),
                date_i18n( get_option( 'date_format' ), strtotime( $meta_start_date ) )
            );
        }

        if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
            printf(
                '<h4 class="m-all t-1of3 d-1of3 cf"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'From', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s ' . __( 'to', 'al3' ) .  '<meta itemprop="endDate" content="%3$s"> %4$s' . '</h4>',
                   date_i18n( "c", strtotime( $meta_start_date ) ),
                   date_i18n( get_option( 'date_format' ), strtotime( $meta_start_date ) ),
                   date_i18n( "c", strtotime( $meta_end_date ) ),
                   date_i18n( get_option( 'date_format' ), strtotime( $meta_end_date ) )
            );
        }

        if( ! empty( $meta_location ) ) {
            printf(
                '<h4 class="m-all t-1of3 d-1of3 cf" title="' . __( 'The event takes place at %1$s.', 'al3' ) . '"><span class="dashicons dashicons-location-alt"></span>' . __( '%2$s', 'al3' ) . '</h4>',
                $meta_location,
                '<span itemprop="location">' . $meta_location . '</span>'
            );
        }

        if( ! empty( $meta_target_group )) {
            printf(
                '<h4 class="m-all t-1of3 d-1of3 cf"><span class="dashicons dashicons-groups"></span>' . __( '%1$s', 'al3' ) . '</h4>',
                $meta_target_group
            );
        }

        ?>

    </footer>

</article><?php // end article
