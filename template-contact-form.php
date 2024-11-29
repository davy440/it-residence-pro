<?php
/**
 * The template for displaying all pages
 *
 *	Template Name: Header Form
 *
 */
get_header('widget');
?>

	<main id="primary" class="site-main wp-block-group has-global-padding is-layout-constrained">
		<?php
		
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'it-residence' ),
				'after'  => '</div>',
			)
		);
		?>
	</main><!-- #main -->

<?php
get_footer();
