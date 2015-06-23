<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Daniela
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php wp_nav_menu( array(
	 				'theme_location' => 'social',
	 				'link_before' => '<span class="screen-reader-text">',
	 				'link_after' => '</span>'
				) ); ?>
			</nav>
		<?php endif; ?>

		<div class="site-info">
			<a href="<?php echo esc_url( esc_html__( 'http://wordpress.org/', 'daniela' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'daniela' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'daniela' ), 'Daniela', 'Christopher Crouch' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
