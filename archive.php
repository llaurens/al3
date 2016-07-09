<?php
/*
* Default Archive Page
*
* @package al3
* @subpackage Core
*/
?>

<?php get_header(); ?>

<div id="content" class="main-content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <?php if (is_category()) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Articles from the category', 'al3' ); ?></span> <?php single_cat_title(); ?>
                    </h1>
                    <h3 class="em"><?php echo category_description(); ?></h3>

                <?php } elseif (is_tag()) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Posts Tagged:', 'al3' ); ?></span> <?php single_tag_title(); ?>
                    </h1>
                    <h3 class="em"><?php echo tag_description(); ?></h3>

                <?php } elseif (is_author()) {
                    global $post;
                    $author_id = $post->post_author;
                ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Posts By:', 'al3' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>
                    </h1>

                <?php } elseif (is_day()) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Daily Archives:', 'al3' ); ?></span> <?php the_time('l, F j, Y'); ?>
                    </h1>

                <?php } elseif (is_month()) { ?>
                        <h1 class="archive-title">
                            <span><?php _e( 'Monthly Archives:', 'al3' ); ?></span> <?php the_time('F Y'); ?>
                        </h1>

                <?php } elseif (is_year()) { ?>
                        <h1 class="archive-title">
                            <span><?php _e( 'Yearly Archives:', 'al3' ); ?></span> <?php the_time('Y'); ?>
                        </h1>

                <?php } elseif (is_tax( 'event_target_group' )) { ?>
                        <h1 class="archive-title">
                            <span><?php _e( 'Events for', 'al3' ); ?></span> <?php single_cat_title(); ?>
                        </h1>

                <?php } elseif (is_tax( 'article_author' )) { ?>
                    <h1 class="archive-title">
                        <span><?php _e( 'Articles by', 'al3' ); ?></span> <?php single_cat_title(); ?>
                    </h1>

                <?php } ?>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php if (is_tax( 'event_target_group' )) {
                        get_template_part( 'partials/archive', 'events' );
                    }   else {
                        get_template_part( 'partials/archive', 'article' );
                    }
                    ?>

            <?php endwhile; ?>

            <?php al3_page_navi(); ?>

            <?php else : ?>

            <article id="post-not-found" class="hentry cf">
                <header class="article-header">
                    <h1><?php _e( 'Oops, No Post Found!', 'al3' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'Wow. We did not find a single post matching your criteria. Jackpot!', 'al3' ); ?></p>
                </div>
                <footer class="article-footer">
                    <p><?php _e( 'In case you wonder about this problem, simply drop us a note via redaktion@al3.de. This would be surely helpful. Thanks in advance!', 'al3' ); ?></p>
                </footer>
            </article>

            <?php endif; ?>

        </div> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
