<?php
/**
 * The archive template for Jetpack testimonial posts.
 *
 * @package Daniela
 */

get_header(); ?>
	<?php $jetpack_options = get_theme_mod( 'jetpack_testimonials' ); ?>

	<?php if ( '' != $jetpack_options['featured-image'] ) : ?>
	<p class="archive-thumbnail">
		<?php echo wp_get_attachment_image( (int)$jetpack_options['featured-image'], 'daniela-full-width' ); ?>
	</p><!-- .archive-thumbnail -->
	<?php endif; ?>

	<header class="archive-header">
		<h1 class="archive-title">
			<?php
				if ( '' != $jetpack_options['page-title'] )
					echo esc_html( $jetpack_options['page-title'] );
				else
					_e( 'Testimonials', 'daniela' );
			?>
		</h1>
		<?php if ( '' != $jetpack_options['page-content'] ) : ?>
			<div class="archive-description">
				<?php echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_options['page-content'] ) ) ) ) ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<div class="testimonials">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'testimonial' ); ?>

				<?php endwhile; ?>

				<?php the_posts_navigation( array(
					'prev_text'          => __( 'Older testimonials', 'daniela' ),
					'next_text'          => __( 'Newer testimonials', 'daniela' ),
					'screen_reader_text' => __( 'Testimonials navigation', 'daniela' ),
				) ); ?>

			</div><!-- .projects -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
