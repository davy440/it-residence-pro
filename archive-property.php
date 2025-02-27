<?php
/**
 * The template for displaying property pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */
$layout = get_theme_mod('itre_property_layout', 'col3');
 $sidebar_align = get_theme_mod( 'itre_property_sidebar_layout', 'right' );

$header = '';
if (!empty($_GET)) {
	$header = 'filter-simple';
}
get_header(null, ['header' => $header]);

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar('property');
}
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="property-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="itre-property-archive-wrapper container <?php echo $layout ?>">
			<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					if ( $layout == 'list') {
						get_template_part('template-parts/property-layouts/content', 'property-list');
					} else {
						get_template_part('template-parts/property-layouts/content', 'property', 'archive');
					}

				endwhile;
            ?>
			</div>
            <?php

			the_posts_pagination(  array(
				'class'					=>	'itre-pagination',
				'before_page_number'	=>	'<span>',
				'after_page_number'		=>	'</span>',
				'prev_text'				=> '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
				'next_text'				=> '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span></i>'
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
if ( $sidebar_align == 'right' ) {
	itre_get_sidebar('property');
}
get_footer();
