<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="content" class="main-content">

            <div id="inner-content" class="wrap cf">

                <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                    <?php get_template_part( 'partials/single', 'article' ); ?>

                    <?php endwhile; ?>

				    <?php else : ?>

                        <?php get_template_part( 'partials/404', 'post' ); ?>

				    <?php endif; ?>

        </main> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
