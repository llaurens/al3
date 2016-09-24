<?php
/*
Template Name: Schedule
*
* @package al3
* @subpackage Page Templates
*
* This page crawls the data of the groups, who meet
* on a regular basis and displays them as kind of a
* schedule.
*
*/
__( 'Schedule', 'al3' );
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
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</div> <?php // end article div ?>

                            </article>

                            <div class="entry-content hentry card schedule cf">

                                <?php

                                $groups_args = array(
                                    'paged' => $paged, // Pagination Fix
                                    'posts_per_page' => -1, // Display all groups
                                    'post_type' => 'groups', // Tell WordPress to show only groups posts
                                    'orderby' => 'meta_value_num', // We want to organize the groups by date
                                    'meta_key' => 'groups_meet_day', // Grab the "start date" field data
                                    'order' => 'ASC', // DSC is the other option
                                    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
                                        array(
                                            'key' => 'groups_meet_day', // Check the date field
                                            'value' => 'null', // Compare to this value (empty)
                                            'compare' => '!=' // Return the ones that have a date
                                        )
                                    )
                                );


                                $groups_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                                $groups = new WP_Query( $groups_args );

                                // Pagination fix
                                $temp_query = $wp_query;
                                $wp_query   = NULL;
                                $wp_query   = $groups;

                                ?>

                                <?php if ( $groups->have_posts()) : while ( $groups->have_posts()) : $groups->the_post(); ?>

                                    <?php

                                    $count = $groups->post_count;

                                    if ( $count == 1 ) { ?>
                                        <div <?php post_class( 'm-all t-all d-all cf' ); ?> >
                                    <?php } elseif ( $count == 2 || $count % 2 == 0 && $count > 3 ) { ?>
                                        <div <?php post_class( 'm-all t-1of2 d-1of2 cf' ); ?> >
                                    <?php } elseif ( $count == 3 || $count % 2 != 0 && $count > 3 ) { ?>
                                        <div <?php post_class( 'm-all t-1of3 d-1of3 cf' ); ?> >
                                    <?php } else { ?>
                                        <div <?php post_class( 'm-all t-all d-all cf' ); ?> >
                                    <?php }

                                    ?>

                                        <?php get_template_part( 'partials/schedule', 'groups' ); ?>

                                    </div>

                                <?php endwhile; ?>

                                <?php else : ?>

                                    <?php get_template_part( 'partials/404', 'groups' ); ?>

                                <?php endif; ?>

                                <?php
                                // Reset postdata
                                wp_reset_postdata();
                                $wp_query = NULL;
                                $wp_query = $temp_query;
                                ?>

                        <?php endwhile; else : ?>

                                <?php get_template_part( 'partials/404', 'page' ); ?>

                        <?php endif; ?>

				    </main>

            </div>

    </div>

<?php get_footer(); ?>
