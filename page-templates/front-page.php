<?php
/**
 * Template Name: Front Page
 *
 * @package Daniela
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="hero-content">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hero-image">
							<?php the_post_thumbnail( 'daniela-full-width' ); ?>
						</div>

						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

						<?php edit_post_link( __( 'Edit', 'daniela' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
					</article><!-- #post-## -->
				</div><!-- .hero-content -->

				<?php
					$testimonials = new WP_Query( array(
						'post_type'      => 'jetpack-testimonial',
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'posts_per_page' => 2,
						'no_found_rows'  => true,
					) );
				?>

				<?php if ( $testimonials->have_posts() ) : ?>
				<div id="front-page-testimonials" class="front-testimonials testimonials">
					<header class="archive-header">
						<h2 class="archive-title">What Our Customers Say:</h2>
					</header>
					<div class="grid-row">
					<?php
						while ( $testimonials->have_posts() ) : $testimonials->the_post();
							 get_template_part( 'content', 'testimonial' );
						endwhile;
						wp_reset_postdata();
					?>
					</div>
				</div><!-- .testimonials -->
				<?php endif; ?>
			
				<?php
					$projects = new WP_Query( array(
						'post_type'      => 'jetpack-portfolio',
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'posts_per_page' => 3,
						'no_found_rows'  => true,
					) );
				?>
			
				<?php if ( $projects->have_posts() ) : ?>
				<div id="front-page-portfolio" class="front-portfolio portfolio-projects">
					<header class="archive-header">
						<h2 class="archive-title">Recent Projects:</h2>
					</header>
					<div class="grid-row">
					<?php
						while ( $projects->have_posts() ) : $projects->the_post();
							 get_template_part( 'content', 'portfolio' );
						endwhile;
						wp_reset_postdata();
					?>
					</div>
				</div><!-- .portfolio-projects -->
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
