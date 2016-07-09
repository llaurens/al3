<?php
/*
 * Single Member of the Management
 *
 * @package al3
 * @subpackage Core
 */
?>

<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="content" class="main-content">

            <div id="inner-content" class="wrap cf">

                <main id="main" class="cf"  itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php get_template_part( 'partials/single', 'management' ); ?>

						<?php endwhile; ?>

						<?php else : ?>

							<?php get_template_part( 'partials/404', 'management' ); ?>

						<?php endif; ?>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
