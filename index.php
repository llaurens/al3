<?php get_header(); ?>

<div id="content" class="main-content">

    <div id="inner-content" class="wrap cf">

        <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

            <?php get_template_part( 'partials/home', 'blog' ); ?>

            <?php get_template_part( 'partials/home', 'events' ); ?>

            <?php get_template_part( 'partials/home', 'groups' ); ?>

            <?php get_template_part( 'partials/home', 'schedule' ); ?>

        </main> <?php // end #main ?>

    </div> <?php // end #inner-content ?>

</div> <?php // end #content ?>

<?php get_footer(); ?>
