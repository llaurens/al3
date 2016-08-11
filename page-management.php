<?php
/*
Template Name: Management
*
* @package al3
* @subpackage Page Templates
*
* A page for the celebs: All Members of
* the administration will appear here.
*
*/
__( 'Management', 'al3' );
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
                                'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
                                'after'  => '</div>',
				                'link_before' => '<span>',
								'link_after'  => '</span>',
                            ) );
                            ?>
				        </div> <?php // end article div ?>

                    </article>

                    <div class="management cf">

                        <?php

                        // A little helper function to create a Query for users based on the meta data

                         function get_users_by_meta_data( $orderby, $order, $meta_key, $meta_value, $compare ) {

                             $user_query = new WP_User_Query(
                                 array(
                                     'orderby'      =>  $orderby,
                                     'order'        =>  $order,
                                     'meta_key'	    =>	$meta_key,
                                     'meta_value'	=>	$meta_value,
                                     'compare'      =>  $compare
                                )
                            );

                           // Get the results from the query, returning the first user
                           $users = $user_query->get_results();

                           return $users;

                        }

                        ?>

                        <?php

                        // Querying the users by their level: 01 is a director, 02 is member of the direction, 03 is a member of the management

                        // Directors
                        foreach( get_users_by_meta_data( 'name', 'ASC', 'user_management', '01', 'LIKE' ) as $user ) {
                            if ( ! empty ($user) ) {
                                // use locate_template() instead of get_template_part() to pass the variable $user on. Needed, but Bah! Might be reworked sometimes.
                                include( locate_template( 'partials/archive-user.php', false, false ) );
                            }
                        }

                        // Members of the Direction
                        foreach( get_users_by_meta_data( 'name', 'ASC', 'user_management', '02', 'LIKE' ) as $user ) {
                            if ( ! empty ($user) ) {
                                include( locate_template( 'partials/archive-user.php', false, false ) );
                            }
                        }

                        // Members of the Management
                        foreach( get_users_by_meta_data( 'name', 'ASC', 'user_management', '03', 'LIKE' ) as $user ) {
                            if ( ! empty ($user) ) {
                                include( locate_template( 'partials/archive-user.php', false, false ) );
                            }
                        }

                        ?>

                    </div>

                <?php endwhile; else : ?>

                    <?php get_template_part( 'partials/404', 'page' ); ?>

                <?php endif; ?>

            </main>

        </div>

    </div>

<?php get_footer(); ?>
