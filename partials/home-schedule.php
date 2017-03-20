<?php
/*
* Home Schedule
*
* @package al3
* @subpackage Groups
*/
?>

<h2 class="archive-title block-title card cf">

    <?php

    $al3_block_url = get_theme_mod('al3_schedule_setting');

    if ( !empty ($al3_block_url)) { ?>
        <a href="<?php echo $al3_block_url ?>" rel="bookmark" title="<?php _e('More about the Schedule', 'al3'); ?>"><?php _e('Schedule', 'al3'); ?></a>
    <?php } else { _e('Schedule', 'al3'); }; ?>

</h2>

<div class="hentry home-block block-schedule entry-content card cf">

    <?php

    $schedule_query_args = array(
        'posts_per_page' => -1, // Display all groups
        'post_type' => 'groups', // Tell WordPress to show only groups posts
        'orderby' => 'meta_value_num', // We want to organize the groups by date
        'meta_key' => 'groups_meet_day', // Grab the "start date" field data
        'order' => 'ASC', // DSC is the other option
        'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
            array(
                'key' => 'groups_meet_day', // Check the date field
                'value' => '', // Compare to this value (empty)
                'compare' => '!=' // Return the ones that have a date
            )
        )
    );

    $schedule_query = new WP_Query( $schedule_query_args );

    ?>

    <?php if ( $schedule_query->have_posts()) : while ( $schedule_query->have_posts()) : $schedule_query->the_post(); ?>

        <?php

        $count = $schedule_query->post_count;

        if ( $count == 1 ) { ?>
            <article <?php post_class( 'm-all t-all d-all cf' ); ?> >
        <?php } elseif ( $count == 2 || $count % 2 == 0 && $count > 3 ) { ?>
            <article <?php post_class( 'm-all t-1of2 d-1of2 cf' ); ?> >
        <?php } elseif ( $count == 3 || $count % 2 != 0 && $count > 3 ) { ?>
            <article <?php post_class( 'm-all t-1of3 d-1of3 cf' ); ?> >
        <?php }

        ?>

            <div class="article-header">
                <h1 class="h2 entry-title"><?php al3_acf_select_labels('groups_meet_day'); ?></h1>
                <h2 class="h3 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <?php if( get_field('groups_meet_time') ): ?>
                   <p class="strong"><?php printf(__('Between %s oclock', 'al3'), get_field('groups_meet_time')); ?></p>
                <?php endif; ?>
                <?php if( get_field('groups_members') ): ?>
                    <p class="strong"><?php printf(__('For %s.', 'al3'), get_field('groups_members')); ?></p>
                <?php endif; ?>
            </div>

        </article>

    <?php endwhile; ?>

    <?php else : ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
                <h1><?php _e( 'Oops, no group found!', 'al3' ); ?></h1>
            </header>
            <div class="entry-content">
                    <p><?php _e( 'Three Possibilites: 1. The Website is broken (not so unlikely). 2. There is no group in the near future (rather unlikely). 3. We forget to add new groups (most likely).', 'al3' ); ?></p>
            </div>
            <footer class="article-footer">
                <p><?php _e( 'You want us to add more groups? Write us: <a href="mailto:redaktion@al3.de" title="Write us!">redaktion@al3.de</a>.', 'al3' ); ?></p>
            </footer>
        </article>

    <?php endif; ?>

</div> <?php // end .block-schedule ?>
