<?php
/**
 * The template for displaying all single posts.
 *
 * @package Daniela
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<?php the_post_navigation( array(
				'next_text' => '<span class="meta-nav">' . __( 'Next Post', 'daniela' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav">' . __( 'Previous Post', 'daniela' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
