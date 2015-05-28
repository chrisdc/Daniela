<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Daniela
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function daniela_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'fff',
			'border' => 'd0d0d0',
			'text'   => '333',
			'link'   => '21759b',
			'url'    => '21759b',
		);
	}
}
add_action( 'after_setup_theme', 'daniela_wpcom_setup' );
