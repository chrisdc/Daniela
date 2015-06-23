<?php
/**
 * The archive template for Jetpack portfolio posts.
 *
 * @package Daniela
 */

get_header(); ?>
	<header class="archive-header">
		<?php
			the_archive_title( '<h1 class="archive-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main portfolio-projects" role="main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'portfolio' ); ?>

				<?php endwhile; ?>

				<?php the_posts_navigation( array(
					'prev_text'          => esc_html__( 'Older projects', 'daniela' ),
					'next_text'          => esc_html__( 'Newer projects', 'daniela' ),
					'screen_reader_text' => esc_html__( 'Projects navigation', 'daniela' ),
				) ); ?>
		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
