<?php
/**
 * The template part for single Jetpack portfolio posts.
 *
 * @package Daniela
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php daniela_post_thumbnail(); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'daniela' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php daniela_portfolio_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->