<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package University_Hub
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<footer class="entry-footer">
		<?php university_hub_entry_footer(); ?>
	</footer><!-- .entry-footer -->

    <?php
	  /**
	   * Hook - university_hub_single_image.
	   *
	   * @hooked university_hub_add_image_in_single_display -  10
	   */
	  do_action( 'university_hub_single_image' );
	?>

	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'university-hub' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-wrapper -->

</article><!-- #post-## -->
