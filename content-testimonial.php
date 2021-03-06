<?php
/**
 * The template part for single Jetpack testimonial posts.
 *
 * @package Daniela
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php daniela_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title">', '</h2>' );
			endif;
		?>
	</header>
	<?php edit_post_link( esc_html__( 'Edit', 'daniela' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
