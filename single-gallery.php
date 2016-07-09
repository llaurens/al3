<?php
/*
 * Single Gallery Page
 *
 * @package al3
 * @subpackage Gallery
 */
?>

<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="content" class="main-content">

            <div id="inner-content" class="wrap cf">

                <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php get_template_part( 'partials/single', 'gallery' ); ?>

						<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'partials/archive', 'gallery' ); ?>

						<?php endif; ?>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
