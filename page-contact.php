<?php
/*
Template Name: Contact
*
* @package al3
* @subpackage Page Templates
*
* Rather boring: This template is nothing more
* than a common page. But we use it to track the
* Scripts of Contact Form 7 in order to avoid them
* on every other page. Easy.
*
*/
__( 'Contact', 'al3' );
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

                <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e( 'Oops, Page Not Found!', 'al3' ); ?></h1>
                        </header>
                        <div class="entry-content">
                            <p><?php _e( 'This page appears to be missing. Strange. Sure you wanted to land here?', 'al3' ); ?></p>
                        </div>
                        <footer class="article-footer">
                                <p>
                                    <?php printf ( __('If you want us to fix this error, simply write a short message to <a href="mailto:%s" title="Write us!">%s</a>!', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?>
                                </p>
                        </footer>
                    </article>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
