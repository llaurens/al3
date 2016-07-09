<?php
/*
* Single Article
*
* @package al3
* @subpackage Core
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> itemscope itemtype="http://schema.org/Article">

    <meta itemprop="inLanguage" content="<?php echo substr(bloginfo ( 'language' ), 0, 2);?>"/>
    <meta itemprop='description' content="<?php $excerpt = strip_tags(get_the_excerpt()); echo $excerpt; ?>"/>
    <meta itemprop='isFamilyFriendly' content='True'/>

        <header class="article-header">

            <h1 class="entry-title single-title" itemprop="name headline"><?php the_title() ?></h1>

            <p class="byline">
                <?php

                $title = '&raquo;' . get_the_title() . '&laquo;';

                $author =       '<span itemprop="author">
                                    <span itemprop="name">' . get_the_author() . '</span>
                                </span>';

                $pubdate =      '<span class="updated">
                                    <time datetime="' . get_the_time('Y-m-d') . '">' . get_the_date( get_option('date_format') ) . '</time>
                                </span>';

                $publisher =    '<span itemscope itemprop="publisher" itemtype="http://schema.org/Organization">
                                    <em itemprop="name">
                                        <a itemprop="url" href="' . home_url() . '">' . get_bloginfo('name') . '</a>
                                    </em>
                                </span>';

                ?>

                <?php printf ( __('The article %1$s was published on %2$s by %3$s for %4$s.', 'al3'), $title, $pubdate, $author, $publisher ); ?>

            </p>

        </header> <?php // end article header ?>

    <?php // } ?>

    <div class="entry-content cf" itemprop="articleBody">
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

    <footer class="article-footer cf">

        <p class="footer-comment-count">
             <span class="dashicons dashicons-admin-comments"></span>
             <a href="<?php comments_link(); ?>"><?php comments_number( __( '<span>No</span> Comments', 'al3' ), __( '<span>One</span> Comment', 'al3' ), __( '<span>%</span> Comments', 'al3' ) );?></a>
        </p>

        <?php printf( '<p class="footer-category"><span class="dashicons dashicons-category"></span>' . get_the_category_list(', ') . '</p>' ); ?>

        <?php the_tags( '<p class="footer-tags tags"><span class="dashicons dashicons-tag"></span>', ', ', '</p>' ); ?>

    </footer>

    <?php comments_template(); ?>

</article>
