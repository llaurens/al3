<?php
/*
Template Name: Groups
*
* @package al3
* @subpackage Page Templates
*
* A dynamic page, which lists, beside the normal content,
* all groups.
*
*/
__( 'Groups', 'al3' );
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card cf' ); ?> >

				        <header class="article-header">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header> <?php // end article header ?>

				        <div class="entry-content cf">

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
                                'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
                                'after'  => '</div>',
				                'link_before' => '<span>',
								'link_after'  => '</span>',
                            ) );
                            ?>
				        </div> <?php // end article div ?>

                    </article>

                    <div class="block-groups card  cf">

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

                                            <?php if ( '' != get_the_post_thumbnail() ) { the_post_thumbnail( 'al3-item' );  } ?>

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

                            <?php get_template_part( 'partials/404', 'groups' ); ?>

                        <?php endif; ?>

                    </div> <?php // end .block-groups ?>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
