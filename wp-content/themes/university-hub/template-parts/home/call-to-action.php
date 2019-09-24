<?php
/**
 * Template part for displaying home call to action section.
 *
 * @package University_Hub
 */

?>
<?php
	$cta_title                 = university_hub_get_option( 'cta_title' );
	$cta_description           = university_hub_get_option( 'cta_description' );
	$cta_primary_button_text   = university_hub_get_option( 'cta_primary_button_text' );
	$cta_primary_button_url    = university_hub_get_option( 'cta_primary_button_url' );
	$cta_secondary_button_text = university_hub_get_option( 'cta_secondary_button_text' );
	$cta_secondary_button_url  = university_hub_get_option( 'cta_secondary_button_url' );
	// TODO: Conditional buttons.
?>
<div id="university-hub-call-to-action" class="home-section-call-to-action">
	<div class="container">

		<div class="cta-content">
			<h2 class="section-title"><?php echo esc_html( $cta_title ); ?></h2>
			<div class="cta-content-text">
				<?php echo wp_kses_post( wpautop( $cta_description ) ); ?>
			</div><!-- .cta-content-text -->
		</div><!-- .cta-content -->
		<div class="cta-buttons">
			<a href="<?php echo esc_url( $cta_primary_button_url ); ?>" class="button cta-btn cta-btn-primary"><?php echo esc_html( $cta_primary_button_text ); ?></a>
			<a href="<?php echo esc_url( $cta_secondary_button_url ); ?>" class="button cta-btn cta-btn-secondary"><?php echo esc_html( $cta_secondary_button_text ); ?></a>
		</div><!-- .cta-buttons -->
	</div> <!-- .container -->
</div><!-- .home-section-call-to-action -->
