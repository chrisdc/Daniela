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
 * Define the code that is used to render the posts added by Infinite Scroll.
 *
 * Includes the whole loop. Used to include the correct template part for the Portfolio CPT.
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
			__( 'Project types: ', 'daniela' )
		),
		_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ),
		'</span>'
	);

	echo get_the_term_list(
		get_the_ID(),
		'jetpack-portfolio-tag',
		sprintf(
			'<span class="portfolio-tag-links"><span class="screen-reader-text">%1$s </span>',
			__( 'Project tags: ', 'daniela' )
		),
		_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ),
		'</span>'
	);

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'daniela' ), __( '1 Comment', 'daniela' ), __( '% Comments', 'daniela' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'daniela' ), '<span class="edit-link">', '</span>' );
}
endif;
