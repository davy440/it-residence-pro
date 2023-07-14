<?php
/**
 * The template for displaying single properties.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage itre
 * @since 1.0.0
 */
$headerMap = empty(get_post_meta($post->ID, "header", true)) ? "" : "map";
get_header( NULL, ["header"	=>	$headerMap] );
?>

<main id="primary" class="property-content container" role="main">

	<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

            get_template_part('template-parts/content-single', 'property');

		}
		wp_reset_postdata();
	}
	?>

</main><!-- #site-content -->

<?php get_footer(); ?>
