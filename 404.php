<?php
/*
* Default Error 404
*
* @package al3
* @subpackage Core
*/
?>

<?php get_header(); ?>

<div id="content" class="main-content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<article id="post-not-found" class="not-found hentry card cf">

				    <header class="article-header">

				        <h1><?php _e( 'Epic 404 - Article Not Found', 'al3' ); ?></h1>

				    </header>

				    <div class="entry-content cf">

				        <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'al3' ); ?></p>

				    </div>

				    <div class="extern-search entry-content cf">

				        <div id="expanding-search" class="expanding-search">
                            <form method="get" action="<?php echo home_url( '/' ); ?>">
                                <input class="expanding-search-input" placeholder="<?php _e( 'Search …', 'al3' ) ?>" type="search" value="<?php echo get_search_query() ?>" name="s" id="search" title="<?php _e( 'Search for:', 'al3' ) ?>" onkeyup="buttonUp();">
                                <input class="expanding-search-submit" type="submit" value="">
                                <span class="expanding-icon-search dashicons dashicons-search"></span>
                            </form>
                        </div>

				    </div>

				    <footer class="article-footer not-found hentry">

				        <p><?php printf ( __('If you want us to fix this error, simply write a short message to <a href="mailto:%s" title="Write us!">%s</a>!', 'al3'), get_option( 'admin_email' ), get_option( 'admin_email' ) ); ?></p>

				    </footer>

				</article>

        </main> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
