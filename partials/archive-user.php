<?php
/*
* Archive Member
*
* @package al3
* @subpackage Core
*/
?>

<article id="user-<?php echo $user->ID ?>" class="hentry card cf" >

    <header class="article-header">
        <h2 class="h3 entry-title">
            <?php echo $user->display_name; ?>
            <?php if ( ! empty ($user->first_name) && ! empty ($user->last_name)) {
                echo ' &#40;' . $user->first_name . ' ' . $user->last_name . '&#41;';
            } ?></h2>
    </header>

    <div class="entry-content cf">

        <?php // Kinda tricky here: I removed Gravatar from WordPress for Performance and Usability reason, so instead we will fetch a custom image ?>

        <?php if ( ! empty ($user->user_avatar)) { ?>

        <?php

        $avatar_attributes = wp_get_attachment_image_src( $user->user_avatar );
        $retina_avatar = wp_get_attachment_image_src( $user->user_avatar, 'al3-retina-thumb' );

        ?>

            <img
                 alt="user-<?php echo $user->ID ?>"
                 src="<?php echo $avatar_attributes[0]; ?>"
                 srcset="<?php echo $avatar_attributes[0] . ',' . $retina_avatar[0] . ' 2x'; ?>"
                 class="avatar avatar-150 photo alignleft rounded"
                 width="<?php echo $avatar_attributes[1]; ?>"
                 height="<?php echo $avatar_attributes[2]; ?>"
            >

        <?php } ?>

        <?php echo $user->description; ?>

    </div>

    <?php if ( ! empty ($user->user_email) || ! empty ($user->user_birthday) || al3_user_has_posts($user->ID) ) { ?>

        <footer class="article-footer cf">

            <?php if ( ! empty ($user->user_email)) { ?>

                <p class="footer-management-mail">
                    <?php printf(
                        '<span class="dashicons dashicons-email-alt"></span> <a href="mailto:%2$s" title="' . __('Write an e-mail to %1$s.', 'al3') . '">%2$s</a>',
                        $user->display_name,
                        antispambot( $user->user_email )
                    ); ?>
                </p>

            <?php } ?>

            <?php if ( ! empty ($user->user_birthday)) { ?>

                <p class="footer-management-age">
                    <?php printf(
                        '<span class="dashicons dashicons-clock"></span>' . __('%1$s years old', 'al3'),
                        date_diff( date_create( $user->user_birthday ), date_create('today'))->y
                    ); ?>
                </p>

            <?php } ?>

            <?php if ( al3_user_has_posts($user->ID) ) { ?>

                <p class="footer-management-posts">
                    <span class="dashicons dashicons-edit"></span>
                    <a
                       href="<?php echo get_author_posts_url($user->ID) ?>"
                       title="<?php printf (__('View posts by %s.', 'al3'), $user->display_name ); ?>">
                        <?php printf (__('Posts by %s', 'al3'), $user->display_name );
                        ?>
                    </a>
                </p>

            <?php } ?>

            <?php if ( is_user_logged_in() ) { ?>

                <p class="footer-management-edit">

                    <span class="dashicons dashicons-admin-tools"></span><?php edit_post_link(); ?>

                </p>

            <?php } ?>

        </footer>

    <?php } ?>

</article>
