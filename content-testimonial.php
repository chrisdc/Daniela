<?php
/**
 * The template part for single Jetpack testimonial posts.
 *
 * @package Daniela
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<p class="post-thumbnail">
		<?php the_post_thumbnail( 'daniela-testimonial-archive' ); ?>
	</p>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php edit_post_link( __( 'Edit', 'daniela' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->