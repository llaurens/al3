<?php
/*
* Chronicle Entry
*
* @package al3
* @subpackage Events
*/
?>

<?php

$meta_start_date = get_field( 'event_start_date' );
$meta_end_date = get_field( 'event_end_date' );
$meta_pictures = get_field( 'gallery_images' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('chronicle-entry entry-content year-' . $meta_start_date . ' cf'); ?> >

    <header class="article-header">

        <h4 class="chronicle-title">

            <?php

            $terms = get_the_terms( $post->ID, 'event_organizer' );

            if ( !empty( $terms ) ) {

                foreach ( $terms as $term ) {

                    $short_form = get_field('event_organizer_abbr', $term );

                    $long_form = sprintf(
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'event_organizer', 'display' ) )
                    );


                    if ( ! empty( $short_form ) ) { ?>
                        <span><abbr title="<?php echo $long_form ; ?>"><?php echo $short_form ?></abbr></span>
                    <? } else {
                        echo '<span>' . $long_form . '</span>';
                    }
                }
            }

            ?>

            <?php the_title(); ?>

        </h4>

        <?php

        if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
            printf( '<p class="cf byline chronicle-byline chronicle-date"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'On %s', 'al3' ) . '</p>',
                   date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
                  );
        }

        if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
            printf( '<p class="cf byline chronicle-byline chronicle-date"><span class="dashicons dashicons-calendar-alt"></span>' . __( 'From %1$s to %2$s', 'al3' ) . '</p>',
                   date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                   date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
                  );
        }

        if( ! empty( $meta_pictures ) ) { ?>
            <p class="cf byline chronicle-byline chronicle-pictures">
                <span class="dashicons dashicons-camera"></span>
                <a href="<?php the_permalink(); ?>" title="<?php _e( 'Pictures of this event.', 'al3' ); ?>"><?php _e( 'Pictures', 'al3' ); ?></a>
            </p>
        <?php } ?>

        <?php if ( is_user_logged_in() ) { ?>

            <p class="cf byline chronicle-byline chronicle-edit">

                <span class="dashicons dashicons-admin-tools"></span><?php edit_post_link(); ?>

            </p>

        <?php } ?>


    </header>



</article><?php // end article
