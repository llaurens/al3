<?php
/*
* Home Groups Snippet
*
* @package al3
* @subpackage Groups
*/
?>

<h2 class="archive-title block-title card cf">

    <?php

    $al3_block_url = get_theme_mod('al3_groups_setting');

    if ( !empty ($al3_block_url)) { ?>
        <a href="<?php echo $al3_block_url ?>" rel="bookmark" title="<?php _e('More about our Groups', 'al3'); ?>"><?php _e('Our Groups', 'al3'); ?></a>
    <?php } else { _e('Our Groups', 'al3'); }; ?>

</h2>

<div class="hentry home-block block-groups card cf">

    <?php

    $groups_query_args = array(
        'posts_per_page' => -1, // Display all groups
        'post_type' => 'groups', // Tell WordPress to show only groups posts
        'orderby' => 'meta_value_num', // We want to organize the groups by date
        'meta_key' => 'groups_ages', // Grab the "groups_ages" field data to order the groups by their age
        'order' => 'ASC', // DSC is the other option
    );

    $groups_query = new WP_Query( $groups_query_args );

    ?>

    <?php if ( $groups_query->have_posts()) : while ( $groups_query->have_posts()) : $groups_query->the_post(); ?>

        <?php

        $count = $groups_query->post_count;

        if ( $count == 1 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-all d-all cf' ); ?> >
        <?php } elseif ( $count == 2 || $count % 2 == 0 && $count > 3 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of2 d-1of2 cf' ); ?> >
        <?php } elseif ( $count == 3 || $count % 2 != 0 && $count > 3 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of3 d-1of3 cf' ); ?> >
        <?php }

        ?>

                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">

                    <header class="article-header">

                        <?php if ( '' != get_the_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'al3-item' ); ?>
                                <?php } ?>

                    </header>

                    <div class="group-shortinfo entry-content cf">

                        <h3 class="h4 entry-title"><?php the_title(); ?></h3>

                        <?php if( get_field('groups_members') ): ?>
                            <p class="strong">
                                <?php printf(__('For %s.', 'al3'), get_field('groups_members')); ?>
                            </p>
                            <?php endif; ?>

                    </div>

                </a>

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

</div> <?php // end .block-groups ?>
