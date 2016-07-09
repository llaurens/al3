<?php
/*
* Archive Member
*
* @package al3
* @subpackage Core
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card cf' ); ?> >

    <header class="article-header">
        <h2 class="h3 entry-title"><?php the_title(); ?><?php if( get_field('management_name') ): echo ' &#40;' . get_field('management_name') . '&#41;'; endif; ?></h2>
    </header>

    <div class="entry-content cf">

        <?php if ( '' != get_the_post_thumbnail() ) { the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft rounded' ) ); } ?>

        <?php the_content(); ?>
    </div>

    <?php if( get_field('management_mail') || get_field('management_birthday') ): ?>
        <footer class="article-footer cf">

            <p class="footer-management-mail">
                <?php

                if( get_field('management_mail') ): printf('<span class="dashicons dashicons-email-alt"></span> <a href="mailto:%2$s" title="' . __('Write an e-mail to %1$s.', 'al3') . '">%2$s</a>', get_the_title(), antispambot( get_field('management_mail')));
                endif;

                ?>

            </p>

            <p class="footer-management-age">
                <?php

                if( get_field('management_birthday') ): printf('<span class="dashicons dashicons-clock"></span>' . __('%1$s years old', 'al3'), date_diff(date_create(get_field('management_birthday')), date_create('today'))->y);
                endif;

                ?>
            </p>

            <?php $user_link = get_field('management_link'); ?>

            <?php if ( !empty ($user_link) && al3_user_has_posts($user_link['ID'])) { ?>

                <p class="footer-management-posts">
                    <span class="dashicons dashicons-edit"></span>
                    <a
                       href="<?php echo get_author_posts_url( $user_link['ID'], get_the_author_meta( 'user_nicename', $user_link['ID'] )) ?>"
                       title="<?php printf (__('View posts by %s.', 'al3'), get_the_title()); ?>">
                        <?php printf (__('Posts by %s', 'al3'), get_the_title()); ?>
                    </a>
                </p>

            <?php } ?>

            <?php if ( is_user_logged_in() ) { ?>

                <p class="footer-management-edit">

                    <span class="dashicons dashicons-admin-tools"></span><?php edit_post_link(); ?>

                </p>

            <?php } ?>

        </footer>

    <?php endif; ?>

</article>
