<?php
/*
Template Name: Gallery
*
* @package al3
* @subpackage Page Templates
*
* This one is nice, too. Similar to the
* page-chronicle.php, it runs through all past
* events and list them. But since this is the
* gallery template, it only shows the events
* which have pictures assigned to them.
*
*/
__( 'Gallery', 'al3' );
?>

<?php get_header(); ?>

    <div id="content" class="main-content">

        <div id="inner-content" class="archive wrap cf">

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

                    <div class="card chronicle cf">

                        <?php

                        function posts_by_year() {

                            // array to use for results
                            $years = array();

                            // Value to compare
                            $today = current_time('Y-m-d');

                            // get posts from WP
                            $posts = get_posts(array(
                                'post_type' => 'events',            // Only show events
                                'posts_per_page' => -1,             // Display all events at once
                                'orderby' => 'meta_value',          // We want to organize the events by date
                                'meta_key' => 'event_start_date',   // Grab the "start date" field data
                                'order' => 'DESC',                  // ASC is the other option
                                'meta_query' => array(              // WordPress has all the results, now, return only the events after today's date
                                    'relation' => 'AND',                // Query must be whithin date range, but should also include only posts with images
                                    array(
                                        'key' => 'event_start_date',    // Check the start date field
                                        'value' => $today,              // Set today's date (note the similar format)
                                        'compare' => '<',               // Return the ones greater than today's date
                                        'type' => 'NUMERIC,'            // Let WordPress know we're working with numbers
                                    ),
                                    array(
                                    'key'     => 'gallery_images',      // Check the gallery images field
                                    'value'   => '',                    // Is it empty?
                                    'compare' => '!='                   // Show only events which have images assigned
                                    )
                                )
                            ));


                            // loop through posts, populating $years arrays
                            foreach($posts as $post) {
                                $years[date('Y', strtotime($post->event_start_date))][] = $post;
                            }

                            // reverse sort by year
                            krsort($years);

                            // return values
                            return $years;

                        }

                        foreach( posts_by_year() as $year => $posts) { ?>

                            <?php // Headline as slide-out link ?>
                            <a href="#" class="has-children year-<?php echo $year; ?>">
                                <h2 class="chronicle-headline"><?php echo $year; ?></h2>
                            </a>

                            <div class="sub-menu chronicle-wrap">
                                <?php foreach($posts as $post) {

                                    // Fetch the postdata
                                    setup_postdata($post);

                                    // Output
                                    get_template_part( 'partials/chronicle', 'gallery' );

                                } ?>
                            </div>

                        <?php } ?>

                    </div>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
