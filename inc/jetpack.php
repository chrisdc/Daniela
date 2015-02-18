<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Daniela
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function daniela_jetpack_setup() {
	add_image_size( 'daniela-porfolio-archive', 310, 310, true );
	add_image_size( 'daniela-site-logo', 1020, 300 );

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

	// Add support for Jetpack site logo.
	add_theme_support( 'site-logo', array( 'size' => 'daniela-site-logo' ) );
}
add_action( 'after_setup_theme', 'daniela_jetpack_setup' );


function daniela_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}