<?php
/*
* Home Blog Entry
*
* @package al3
* @subpackage Core
*/
?>


<h2 class="archive-title block-title card cf">

    <?php

    $al3_block_url = get_theme_mod('al3_blog_setting');

    if ( !empty ($al3_block_url)) { ?>
        <a href="<?php echo $al3_block_url ?>" rel="bookmark" title="<?php _e('View more News', 'al3'); ?>"><?php _e('News', 'al3'); ?></a>
    <?php } else { _e('News', 'al3'); }; ?>

</h2>

<div class="hentry home-block block-blog card cf">

    <?php

    // Define custom query parameters
    $home_query_args = array(
        'posts_per_page' => 3, // Display only the last three posts
    );

    // Instantiate custom query
    $home_query = new WP_Query( $home_query_args );

    ?>

    <?php if ($home_query->have_posts()) : while ($home_query->have_posts()) : $home_query->the_post(); ?>

        <?php

        $count = $home_query->post_count;

        if ( $count = 3 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of3 d-1of3 cf' ); ?> >
        <?php } elseif ( $count = 2 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-1of2 d-1of2 cf' ); ?> >
        <?php } elseif ( $count = 1 ) { ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'm-all t-all d-all cf' ); ?> >
        <?php } ?>

            <header class="article-header">

                <h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

                <p class="byline entry-meta vcard">
                        <?php printf( __( 'Posted', 'al3' ).' %1$s %2$s',
                        /* the time the post was published */
                        '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                        /* the author of the post */
                        '<span class="by">'.__( 'by', 'al3').'</span> <span class="entry-author author" itemprop="author" itemscope itemtype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>.'
                        ); ?>
                </p>

             </header>

             <div class="entry-content cf">
                <?php the_excerpt(); ?>
             </div>

         </article>

    <?php endwhile; ?>

    <?php else : ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
                <h1><?php _e( 'Oops, Post Not Found!', 'al3' ); ?></h1>
            </header>
            <div class="entry-content">
                <p><?php _e( 'Nothing, but absolutely nothing, was found. How did you do this?', 'al3' ); ?></p>
            </div>
            <footer class="article-footer">
                <p><?php _e( 'Well, if you are not sure about what you just did, simply tell us via redaktion@al3.de. Thank you!', 'al3' ); ?></p>
            </footer>
        </article>

    <?php endif; ?>

</div> <?php // end .block-blog ?>
