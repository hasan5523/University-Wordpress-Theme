<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package University_Hub
 */

?><?php
	/**
	 * Hook - university_hub_action_doctype.
	 *
	 * @hooked university_hub_doctype -  10
	 */
	do_action( 'university_hub_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - university_hub_action_head.
	 *
	 * @hooked university_hub_head -  10
	 */
	do_action( 'university_hub_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - university_hub_action_before.
	 *
	 * @hooked university_hub_page_start - 10
	 * @hooked university_hub_skip_to_content - 15
	 */
	do_action( 'university_hub_action_before' );
	?>

    <?php
	  /**
	   * Hook - university_hub_action_before_header.
	   *
	   * @hooked university_hub_header_start - 10
	   */
	  do_action( 'university_hub_action_before_header' );
	?>
		<?php
		/**
		 * Hook - university_hub_action_header.
		 *
		 * @hooked university_hub_site_branding - 10
		 */
		do_action( 'university_hub_action_header' );
		?>
    <?php
	  /**
	   * Hook - university_hub_action_after_header.
	   *
	   * @hooked university_hub_header_end - 10
	   */
	  do_action( 'university_hub_action_after_header' );
	?>

	<?php
	/**
	 * Hook - university_hub_action_before_content.
	 *
	 * @hooked university_hub_content_start - 10
	 */
	do_action( 'university_hub_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - university_hub_action_content.
	   */
	  do_action( 'university_hub_action_content' );
	?>
