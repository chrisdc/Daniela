<?php
/**
 * The template part for arcive view Jetpack portfolio posts.
 *
 * @package Daniela
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php daniela_post_thumbnail(); ?>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-type-links">', esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ), '</span>' );
			edit_post_link( esc_html__( 'Edit', 'daniela' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' );
		?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->