<?php
/*
Template Name: Management
*
* @package al3
* @subpackage Page Templates
*
* A page for the celebs: All Members of
* the administration will appear here.
*
*/
__( 'Management', 'al3' );
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

                    <div class="head cf">

                        <?php

                        $head_args = array(
                            'posts_per_page' => -1, // Display all members of the head
                            'post_type' => 'management', // Tell WordPress to show only management posts
                            'orderby' => 'meta_value', // We want to organize the groups by date
                            'meta_key' => 'management_birthday', // Grab the "start date" field data
                            'order' => 'ASC', // We sort the head from old and wise to young and wild
                            'meta_query' => array( // WordPress has all the results, now, return only the members that are in the head
                                array(
                                    'key' => 'management_head', // Check the head field
                                    'value' => 1, // Compare to this value (true)
                                    'compare' => '==' // Return the ones that are in the head
                                )
                            )
                        );

                        $head = new WP_Query( $head_args );

                        ?>

                        <?php if ( $head->have_posts()) : while ( $head->have_posts()) : $head->the_post(); ?>

                            <?php get_template_part( 'partials/archive', 'management' ); ?>

                        <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part( 'partials/404', 'management_leader' ); ?>

                        <?php endif; ?>

                    </div>

                    <div class="management cf">

                        <?php

                        $head_args = array(
                            'posts_per_page' => -1, // Display all members of the management
                            'post_type' => 'management', // Tell WordPress to show only management posts
                            'orderby' => 'meta_value', // We want to organize the groups by date
                            'meta_key' => 'management_birthday', // Grab the "start date" field data
                            'order' => 'DESC', // And here the other way round
                            'meta_query' => array( // WordPress has all the results, now, return only the members that are not in the head
                                array(
                                    'key' => 'management_head', // Check the head field
                                    'value' => 1, // Compare to this value (true)
                                    'compare' => '!=' // The other way round: Return the ones that not are in the head
                                )
                            )
                        );

                        $head = new WP_Query( $head_args );

                        ?>

                        <?php if ( $head->have_posts()) : while ( $head->have_posts()) : $head->the_post(); ?>

                            <?php get_template_part( 'partials/archive', 'management' ); ?>

                        <?php endwhile; ?>

                        <?php else : ?>

                            <?php get_template_part( 'partials/404', 'management' ); ?>

                        <?php endif; ?>

                    </div>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
