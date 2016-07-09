<?php
/*
 Template Name: Blog
 *
 * This template is similar to a blog, except from the
 * fact that it only shows groups. So it's more like a
 * schedule.
*/
__( 'Blog', 'al3' );
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

                    <div class="cf">

                        <?php

                        // Define custom query parameters
                        $home_query_args = array( /* Parameters go here */ );

                        // Get current page and append to custom query parameters array
                        $home_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                        // Instantiate custom query
                        $home_query = new WP_Query( $home_query_args );

                        // Pagination fix
                        $temp_query = $wp_query;
                        $wp_query   = NULL;
                        $wp_query   = $home_query;

                        ?>

                        <?php

                        $blog_args = array(
                            'paged' => $paged, // Pagination Fix
                            'posts_per_page' => get_option( 'posts_per_page' ), // Display a custom amount of posts
                        );

                        $blog = new WP_Query( $blog_args );

                        ?>

                        <?php if ( $blog->have_posts()) : while ( $blog->have_posts()) : $blog->the_post(); ?>

                            <?php get_template_part( 'partials/archive', 'article' ); ?>

                        <?php endwhile; ?>

                        <?php al3_page_navi(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'partials/404', 'post' ); ?>

                        <?php endif; ?>

                        <?php
                        // Reset postdata
                        wp_reset_postdata();
                        $wp_query = NULL;
                        $wp_query = $temp_query;
                        ?>

                    </div>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
