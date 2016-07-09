<?php
/*
Template Name: Auto Gallery
*
* @package al3
* @subpackage Page Templates
* @link http://codecanyon.net/item/wp-auto-photo-albums-multi-level-image-grid/5781151?WT.ac=category_item&WT.z_author=David_Blanco
*
* This template is basically a page, which support the popular
* Auto Albums Plugin for WordPress via Shortcode.
*/
__( 'Auto Gallery', 'al3' );
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> >

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

                        <div class="block-gallery entry-content cf">
                            <?php echo do_shortcode('[autoAlbums]'); ?>
                        </div>

				    </article>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
