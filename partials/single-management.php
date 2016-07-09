<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>  ">

    <header class="article-header">
        <h1 class="page-title"><?php the_title(); ?><?php if( get_field('management_name') ): echo ' &#40' . get_field('management_name') . '&#41'; endif; ?></h1>
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

        </footer>

    <?php endif; ?>

</article>
