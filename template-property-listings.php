<?php
/**
 * The template for displaying all pages
 *
 *	Template Name: Property Listings
 *
 */
 $header = is_front_page() ? get_theme_mod('itre_front_header_layout', 'default') : 'default';
get_header(null, ['header' => $header]);
?>

	<main id="primary" class="site-main">
		<div class="wp-block-group">

		<?php
		if ( post_type_exists('property') ) {
			do_action('itre_property_filter');
			the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'it-residence' ),
				'after'  => '</div>',
			)
		);
		}
		?>
		</div><!-- .wp-block-group -->
	</main><!-- #main -->

<?php
get_footer();
