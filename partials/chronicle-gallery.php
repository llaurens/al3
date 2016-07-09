<?php
/*
* Chronicle Gallery Entry
*
* @package al3
* @subpackage Events
*/
?>

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
                         alt="<?php echo $images[0]['alt']; ?>"
                         src="<?php echo $images[0]['sizes']['thumbnail']; ?>"
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
