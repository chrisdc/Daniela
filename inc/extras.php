<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Daniela
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function daniela_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ( ! is_active_sidebar( 'sidebar-1' ) )
		|| is_page_template( 'page-templates/full-width.php' ) ) {
		$classes[] = 'full-width';
	}

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'daniela_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function daniela_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'daniela' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'daniela_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function daniela_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'daniela_render_title' );
endif;

/**
 * Filter special cases of the_archive_title()
 * @param   string $title Archive title.
 * @returns string $title Filtered archive title.
 */
function daniela_archive_title( $title ) {
	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		$title = esc_html__( 'Projects', 'daniela' );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'daniela_archive_title' );

/**
 * Counts the number of front page widget areas currently in use.
 * @returns int @count Number of widget areas in use.
 */
function daniela_count_widgets() {
	$count = 0;

	if ( is_active_sidebar( 'front-page-1' ) ) {
		$count += 1;
	}

	if ( is_active_sidebar( 'front-page-2' ) ) {
		$count += 1;
	}

	if ( is_active_sidebar( 'front-page-3' ) ) {
		$count += 1;
	}

	return $count;
}
