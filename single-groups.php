<?php
/*
 * SINGLE GROUPS TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="content" class="main-content">

            <div id="inner-content" class="wrap cf">

                <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php get_template_part( 'partials/single', 'groups' ); ?>

						<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'partials/404', 'groups' ); ?>

						<?php endif; ?>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
