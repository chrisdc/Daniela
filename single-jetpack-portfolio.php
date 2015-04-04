<?php
/**
 * The single template for Jetpack portfolio posts.
 *
 * @package Daniela
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'portfolio-single' ); ?>

			<?php the_post_navigation( array(
				'next_text' => '<span class="meta-nav">' . __( 'Next Project', 'daniela' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav">' . __( 'Previous Project', 'daniela' ) . '</span> ' .
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
