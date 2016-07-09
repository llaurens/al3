<?php
/*
 * Archive page for Target Groups
 *
 * @package al3
 * @subpackage Events
 */
?>

<?php get_header(); ?>

<div id="content" class="main-content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

            <h1 class="archive-title">
                <span><?php _e( 'Events for', 'al3' ); ?></span> <?php single_cat_title(); ?>
            </h1>

            <?php

            $terms = get_terms('event_target_group');

            if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                echo '<div class="target-group-buttons cf">';
                $count = count($terms);
                $i=0;
                foreach ($terms as $term) {
                    $i++;
                    $term_list .= '<a class="btn blue-btn" href="' . get_term_link( $term ) . '" title="' . sprintf(__('Show all events for %s', 'al3'), $term  ->name) . '">' . $term->name . '</a>';
                    if ($count != $i) {
                        $term_list .= ' &nbsp; ';
                    }
                }
                printf( '<h3 class="cf">' . __( 'Show only events for:', 'al3' ) . '</h3>' );
                echo '<p>' . $term_list . '</p>';
                printf( '<a class="btn blue-btn m-all t-all d-all cf" href="javascript:window.print()">' . __( 'Print this schedule', 'al3' ) . '</a>' );
                echo '</div>';
            } ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php get_template_part( 'partials/archive', 'events' ); ?>

            <?php endwhile; ?>

            <?php al3_page_navi(); ?>

            <?php else : ?>

                <?php get_template_part( 'partials/404', 'events' ); ?>

            <?php endif; ?>

        </main> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
