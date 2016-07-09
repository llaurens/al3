<?php ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>  itemscope itemtype="http://schema.org/SocialEvent">

    <header class="article-header">

        <h1 class="single-title entry-title event-title" itemprop="name"><?php the_title(); ?></h1>

        <p class="byline">
            <?php printf( __( 'Added <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author fn">%3$s</span>', 'al3' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
        </p>

        <div class="meta-wrapper m-all t-all d-all">

            <?php

            $gallery_link = get_field('gallery_link');

            print_r ($gallery_link);

            if( ! empty($gallery_link)) { $start_date = get_field('event_start_date', $gallery_link[0]); }

         if( ! empty( $start_date ) ) {
                printf( '<h4 class="m-all t-1of2 d-1of2 cf">' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h4>',
                       date_i18n( "c", strtotime( $start_date )),
                       date_i18n( get_option( 'date_format' ), strtotime( $start_date ))
                      );
            }

            ?>

        </div><?php // end meta-wrapper ?>

    </header>

    <div class="entry-content cf" itemprop="description">

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

    </div>

    <div class="entry-content cf">

        <?php

        $images = get_field('gallery_images');

        if( $images ): ?>
        <div id="grid" class="al-gallery cf" data-columns>
            <div class="grid-sizer"></div>
            <?php foreach( $images as $image ): ?>
                <div class="grid-item">
                    <a
                       data-imagelightbox="ilb"
                       class="lightbox"
                       href="<?php echo $image['url']; ?>">
                        <img
                             alt="<?php echo $image['alt']; ?>"
                             src="<?php echo $image['sizes']['medium']; ?>"
                        ></a>
                 </div>
        <?php endforeach; ?>
    </div>
        <?php endif; ?>

    </div>

    <?php comments_template(); ?>

</article><?php // end article

?>
