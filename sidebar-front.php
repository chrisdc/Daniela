<?php
/**
 * The sidebar area for the template front-page.php
 *
 * @package Daniela
 */

/* Get the number of front page widget areas in use and return early if 0. */
$daniela_widget_count = daniela_count_widgets();

if ( 0 === $daniela_widget_count ) {
	return;
}
?>

<div id="front-page-widgets" class="front-page-widgets <?php echo 'widgets-' . esc_attr( $daniela_widget_count ) ?>" role="complementary">
	<?php if ( is_active_sidebar( 'front-page-1' ) ) : ?>
		<div class="widget-area front-page-1">
			<?php dynamic_sidebar( 'front-page-1' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'front-page-2' ) ) : ?>
		<div class="widget-area front-page-2">
			<?php dynamic_sidebar( 'front-page-2' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'front-page-3' ) ) : ?>
		<div class="widget-area front-page-3">
			<?php dynamic_sidebar( 'front-page-3' ); ?>
		</div>
	<?php endif; ?>
</div><!-- #front-page-widgets -->
