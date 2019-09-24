<?php
/**
 * Theme supports.
 *
 * @package University_Hub
 */

// Load Footer Widget Support.
require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/support/footer-widgets.php' );
