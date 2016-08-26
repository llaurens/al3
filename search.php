<?php
/*
 * Search Results Page
 *
 * @package al3
 * @subpackage Core
 */
?>

<?php get_header(); ?>

<div id="content" class="main-content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

            <h1 class="archive-title card"><span><?php _e( 'Search Results for:', 'al3' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

                <div class="extern-search hentry card cf">

                    <div id="expanding-search" class="expanding-search">
                        <form method="get" action="<?php echo home_url( '/' ); ?>">
                            <input class="expanding-search-input" placeholder="<?php _e( 'Search …', 'al3' ) ?>" type="search" value="<?php echo get_search_query() ?>" name="s" id="search" title="<?php _e( 'Search for:', 'al3' ) ?>" onkeyup="buttonUp();">
                            <input class="expanding-search-submit" type="submit" value="">
                            <span class="expanding-icon-search dashicons dashicons-search"></span>
                        </form>
                    </div>

                </div>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php get_template_part( 'partials/archive', 'article' ); ?>

                <?php endwhile; ?>

            <?php al3_page_navi(); ?>

            <?php else : ?>

            <article id="post-not-found" class="hentry card cf">
                <header class="article-header">
                    <h1><?php _e( 'Sorry, Nothing found!', 'al3' ); ?></h1>
                </header>
                <div class="entry-content">
                    <p><?php _e( 'We do not know what you were searching for (well, we actually do, it stands right up here), but you will not find it on this page.', 'al3' ); ?></p>
                    <p><?php _e( 'So maybe try to search again, but with different keywords.', 'al3' ); ?></p>
                </div>
            </article>

            <?php endif; ?>

        </main> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
