<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <h1 class="archive-title">
                        <?php post_type_archive_title(); ?>
                </h1>

                <div class="block-groups cf">

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

                        <?php get_template_part( 'partials/404', 'post' ); ?>

                    <?php endif; ?>

                </div> <?php // end .block-groups ?>

            </main>
        </div>
    </div>

<?php get_footer(); ?>
