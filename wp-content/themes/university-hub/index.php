<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package University_Hub
 */

get_header(); ?>

<?php if ( true === apply_filters( 'university_hub_filter_home_page_content', true ) ) : ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ); ?>

			<?php endwhile; ?>

			<?php
			/**
			 * Hook - university_hub_action_posts_navigation.
			 *
			 * @hooked: university_hub_custom_posts_navigation - 10
			 */
			do_action( 'university_hub_action_posts_navigation' );?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - university_hub_action_sidebar.
	 *
	 * @hooked: university_hub_add_sidebar - 10
	 */
	do_action( 'university_hub_action_sidebar' );
?>

<?php endif; // End if show home content. ?>

<?php get_footer(); ?>
