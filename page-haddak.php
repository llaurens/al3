<?php
/*
Template Name: haddak
*
* @package al3
* @subpackage Page Templates
* @link http://haddak.de
*
* Real special stuff here and therefore highely experimental:
* This page plays around with the new WP REST API and crawls data
* http://haddak.de in order to create a nice shelf of the recent
* issues of the haddak.
*
*/
__( 'haddak', 'al3' );
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


                            <section class="cf overview entry-content" id="issues-overview">

                                <?php

                                $args = array(
                                    'per_page' => 100,
                                    'orderby' => 'slug',
                                    'order' => 'desc'
                                );

                                $url = add_query_arg( $args, haddak_wp_json('issues') );
                                $issues = slug_get_json( $url );

                                if ( ! empty( $issues ) ) {

                                    foreach( $issues as $issue ) {

                                        $issue_infos = add_query_arg( $args, haddak_acf_json('term/issues/' . $issue->id) );
                                        $issue_meta = slug_get_json( $issue_infos );
                                        $cover_infos = add_query_arg( $args, haddak_wp_json('media/' . $issue_meta->acf->cover) );
                                        $cover_meta = slug_get_json( $cover_infos );



                                        ?>

                                        <a href="<?php echo $issue->link; ?>" title="<?php printf( __('View all posts from %s', 'al3'), $issue->name ); ?>" target="_blank">

                                            <figure class="m-all t-all d-1of2 cf">

                                                <img
                                                     class="wp-post-image article-thumbnail"
                                                     src="<?php echo $cover_meta->media_details->sizes->haddak_tablet->source_url; ?>"
                                                     alt="<?php echo $issue->name; ?>"
                                                >

                                                <figcaption>

                                                    <h3><?php echo $issue->name; ?></h3>
                                                    <span class="h4 count">
                                                        <?php printf( __('%s Articles', 'al3'), $issue->count  ); ?>
                                                    </span>

                                                <?php

                                                $release_date = $issue_meta->acf->release_date;

                                                if ( ! empty ($release_date)) {?>

                                                    <span class="h4 release">
                                                        <?php printf( __('Released %s', 'al3'), date_i18n( get_option( 'date_format' ), strtotime($release_date))); ?>
                                                    </span>

                                                <?php } ?>

                                                </figcaption>

                                            </figure>

                                        </a>

                                <?php }} ?>

                            </section>

                        </div> <?php // end article div ?>

				    </article>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
