<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package IT_Residence
 */

 $sidebar_align = get_theme_mod( 'itre_blog_sidebar_layout', 'right' );

 $header = is_front_page() ? get_theme_mod('itre_front_header_layout', 'default') : 'default';

get_header( null, array( 'header' => $header ) );

if ( $sidebar_align == 'left' ) {
	itre_get_sidebar( 'blog' );
}
?>

	<main id="primary" class="site-main container">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			?>
			<div class="row">
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

				 itre_get_layout( get_theme_mod('itre_blog_layout', 'classic') );
				//get_template_part( 'template-parts/content', 'blog' );

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
	itre_get_sidebar( 'blog' );
}
get_footer();
