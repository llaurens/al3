 <article id="post-<?php the_ID(); ?>" <?php post_class( 'card cf' ); ?> >

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

     <?php if ( 'post' == get_post_type() ) { ?>

         <footer class="article-footer cf">

             <p class="footer-comment-count">
                 <span class="dashicons dashicons-admin-comments"></span>
                 <a href="<?php comments_link(); ?>"><?php comments_number( __( '<span>No</span> Comments', 'al3' ), __( '<span>One</span> Comment', 'al3' ), __( '<span>%</span> Comments', 'al3' ) );?></a>
             </p>

             <?php printf( '<p class="footer-category"><span class="dashicons dashicons-category"></span>' . get_the_category_list(', ') . '</p>' ); ?>

             <?php the_tags( '<p class="footer-tags tags"><span class="dashicons dashicons-tag"></span>', ', ', '</p>' ); ?>

         </footer>

     <?php } elseif ( 'events' == get_post_type() ) { ?>

         <footer class="article-footer cf">

            <?php

                $meta_target_group = get_the_term_list( $post->ID, 'event_target_group', ' ', '  	&amp; ', '' );
                $meta_start_date = get_field( 'event_start_date' );
                $meta_end_date = get_field( 'event_end_date' );
                $meta_location = get_field( 'event_location' );

                if( !empty ( $meta_target_group )) {
                    printf( '<h4 class="footer-meta">' . __( 'Event Target Group: %1$s', 'al3' ) . '</h4>', $meta_target_group );
                }

                if( ! empty( $meta_start_date ) &&  empty( $meta_end_date )) {
                    printf( '<h4 class="footer-meta">' . __( 'On', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s' . '</h4>',
                           date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) )
                          );
                }

                if( ! empty( $meta_start_date ) && ! empty( $meta_end_date )) {
                    printf( '<h4 class="footer-meta">' . __( 'From', 'al3' ) . '<meta itemprop="startDate" content="%1$s"> %2$s ' . __( 'to', 'al3' ) .  '<meta itemprop="endDate" content="%3$s"> %4$s' . '</h4>',
                           date_i18n( "c", strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_start_date' )) ),
                           date_i18n( "c", strtotime( get_field( 'event_end_date' )) ),
                           date_i18n( get_option( 'date_format' ), strtotime( get_field( 'event_end_date' )) )
                          );
                }

                if( ! empty ( $meta_location ) && is_user_logged_in() ) {
                    printf( '<h4 class="footer-meta">' . __( 'Location: %1$s', 'al3' ) . '</h4>', '<span itemprop="location">' . $meta_location . '</span>' );
                }

            ?>

        </footer>

     <?php } ?>

 </article>
