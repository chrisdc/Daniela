<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Daniela
 */

if ( ! function_exists( 'daniela_posted_on' ) ) :
/**
 * Prints HTML with meta information for the post date and format.
 */
function daniela_posted_on() {
	if ( is_sticky() && is_home() && ! is_single() && ! is_paged() ) {
		echo '<span class="sticky">' . esc_html__( 'Sticky', 'daniela' ) . '</span>';
	} else {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$time_link = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		echo '<span class="posted-on">' . $time_link . '</span>';
	}

	$post_format = get_post_format();

	if ( false !== $post_format ) {
		printf( ' | <span class="entry-format"><a href="%1$s">%2$s</a></span>',
			esc_url( get_post_format_link( $post_format ) ),
			esc_html( get_post_format_string( $post_format ) )
		);
	}
}
endif;

if ( ! function_exists( 'daniela_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function daniela_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'daniela' ) );
		if ( $categories_list && daniela_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span> ',
				esc_attr_x( 'Categories: ', 'Indicates a list of post categories.', 'daniela' ),
				$categories_list
			);
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'daniela' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span> ',
				esc_attr_x( 'Tags: ', 'Indicates a list of post tags', 'daniela' ),
				$tags_list
			);
		}

		if ( is_multi_author() ) {
			printf('<span class="author-link author vcard"><span class="screen-reader-text">%1$s</span><a class="url fn n" href="%2$s">%3$s</a></span> ',
				esc_attr_x( 'Author: ', 'Indicates the post author.', 'daniela' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'daniela' ), esc_html__( '1 Comment', 'daniela' ), esc_html__( '% Comments', 'daniela' ) );
		echo '</span> ';
	}

	edit_post_link( esc_html__( 'Edit', 'daniela' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'daniela' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'daniela' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'daniela' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'daniela' ), get_the_date( esc_attr_x( 'Y', 'yearly archives date format', 'daniela' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'daniela' ), get_the_date( esc_attr_x( 'F Y', 'monthly archives date format', 'daniela' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'daniela' ), get_the_date( esc_attr_x( 'F j, Y', 'daily archives date format', 'daniela' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_attr_x( 'Asides', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_attr_x( 'Galleries', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_attr_x( 'Images', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_attr_x( 'Videos', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_attr_x( 'Quotes', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_attr_x( 'Links', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_attr_x( 'Statuses', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_attr_x( 'Audio', 'post format archive title', 'daniela' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_attr_x( 'Chats', 'post format archive title', 'daniela' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'daniela' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'daniela' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'daniela' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Generate the post thumnail with a link to the post.
 */
function daniela_post_thumbnail() {
	if ( ! has_post_thumbnail() || post_password_required() ) {
		return;
	}

	$post_type = get_post_type();

	echo '<p class="post-thumbnail">';

	if ( 'jetpack-portfolio' === $post_type && ! is_single() ) {
		$image_size = 'daniela-porfolio-archive';
	} elseif ( 'jetpack-testimonial' === $post_type ) {
		$image_size = 'daniela-testimonial-archive';
	} elseif ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template ( 'page-templates/full-width.php' ) || is_page_template ( 'page-templates/front-page.php' ) ) {
		$image_size = 'daniela-full-width';
	} else {
		$image_size = 'post-thumbnail';
	}

	if ( is_single() || ( is_page() && 'jetpack-portfolio' !== $post_type ) || 'jetpack-testimonial' === $post_type ) {
		the_post_thumbnail( $image_size );
	} else {
		?>
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( $image_size ) ?></a>
		<?php
	}
	echo '</p>';
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function daniela_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'daniela_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'daniela_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so daniela_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so daniela_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in daniela_categorized_blog.
 */
function daniela_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'daniela_categories' );
}
add_action( 'edit_category', 'daniela_category_transient_flusher' );
add_action( 'save_post',     'daniela_category_transient_flusher' );

if ( ! function_exists( 'daniela_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string The Link format URL.
 */
function daniela_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', '_s' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', '_s' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', '_s' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
