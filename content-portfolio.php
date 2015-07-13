<?php
/**
 * The template part for archive view Jetpack portfolio posts.
 *
 * @package Daniela
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php daniela_post_thumbnail(); ?>
	<header class="entry-header">
		<?php
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-type-links">', esc_attr_x(', ', 'Used between list items, there is a space after the comma.', 'daniela' ), '</span>' );
			edit_post_link( esc_html__( 'Edit', 'daniela' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' );
		?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
