<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> >

    <header class="article-header">

        <h1 class="page-title"><?php the_title(); ?></h1>

    </header><?php // end article header ?>

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
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'al3' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );

        ?>

    </div><?php // end article div ?>

    <?php if( get_field('groups_meet_day') || get_field('groups_meet_time') || get_field('groups_members') || get_field('groups_leader') || get_field('groups_mail') ): ?>

        <footer class="article-footer cf">

            <?php if( get_field('groups_meet_day') && get_field('groups_meet_time') ): ?>
                <p>
                    <span class="dashicons dashicons-calendar-alt"></span>
                    <?php printf(__('%1$s from %2$s o clock', 'al3'), al3_acf_select_labels('groups_meet_day'), get_field('groups_meet_time') ); ?>
                <p>
            <?php endif; ?>

            <?php if( get_field('groups_members') ): ?>
                <p><span class="dashicons dashicons-groups"></span><?php printf(__('For %s', 'al3'), get_field('groups_members')); ?></p>
            <?php endif; ?>

            <?php if( get_field('groups_leader') ): ?>
                <p><span class="dashicons dashicons-businessman"></span><?php printf(__('With %s', 'al3'), get_field('groups_leader')); ?></p>
            <?php endif; ?>

            <?php if( get_field('groups_mail') ): ?>
                <p>
                    <span class="dashicons dashicons-email-alt"></span>
                    <a href="mailto:<?php echo antispambot( get_field('groups_mail') ); ?>" title="<?php printf(__('Send an E-Mail to %s!', 'al3'), get_field('groups_mail')); ?>">
                        <?php echo antispambot( get_field('groups_mail') ); ?>
                    </a>
                </p>
            <?php endif; ?>

        </footer>

    <?php endif; ?>

</article>
