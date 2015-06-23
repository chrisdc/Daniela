<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Daniela
 */

/**
 * Setup Jetpack features and image sizes.
 */
function daniela_jetpack_setup() {
	add_image_size( 'daniela-porfolio-archive', 524, 339, true );
	add_image_size( 'daniela-site-logo', 100, 100 );
	add_image_size( 'daniela-testimonial-archive', 70, 70, true );

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
		'wrapper'   => false,
		'render'    => 'daniela_infinite_scroll_render',
	) );

	// Add support for Jetpack Site Logo.
	add_theme_support( 'site-logo', array( 'size' => 'daniela-site-logo' ) );

	// Add support for Jetpack Testimonials.
	add_theme_support( 'jetpack-testimonial' );

    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'daniela_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function daniela_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();

		if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
			get_template_part( 'content', 'portfolio' );
		} elseif ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			get_template_part( 'content', 'testimonial' );
		} else {
			get_template_part( 'content', get_post_format() );
		}
	}
}

/**
 * Conditionally load the Jetpack site logo.
 */
function daniela_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	} else {
		jetpack_the_site_logo();
	}
}

if ( ! function_exists( 'daniela_portfolio_entry_footer' ) ) :
/**
 * Prints HTML with meta information on portfolio posts.
 */
function daniela_portfolio_entry_footer() {
	echo get_the_term_list(
		get_the_ID(),
		'jetpack-portfolio-type',
		sprintf(
			'<span class="portfolio-type-links"><span class="screen-reader-text">%1$s </span>',
			esc_html__( 'Project types: ', 'daniela' )
		),
		esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ),
		'</span>'
	);

	echo get_the_term_list(
		get_the_ID(),
		'jetpack-portfolio-tag',
		sprintf(
			'<span class="portfolio-tag-links"><span class="screen-reader-text">%1$s </span>',
			esc_html__( 'Project tags: ', 'daniela' )
		),
		esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ),
		'</span>'
	);

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'daniela' ), esc_html__( '1 Comment', 'daniela' ), esc_html__( '% Comments', 'daniela' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'daniela' ), '<span class="edit-link">', '</span>' );
}
endif;
