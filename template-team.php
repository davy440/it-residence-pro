<?php
/**
 * The template for displaying Teams Page
 *
 *  Template Name: Team
 *
 * @package IT_Residence
 */

get_header();
?>

	<main id="primary" class="site-main container">

        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_content(); ?>
        </div>
		<?php
        $args = array(
                    'post_type'     =>  'agent',
                    'posts_per_page'=>  '-1',
                );

        $team_query = new WP_Query( $args );

        // The Loop
        if ( $team_query->have_posts() ) :
			?>
			<div class="row">
			<?php
        while ( $team_query->have_posts() ) : $team_query->the_post();

			global $post;

            get_template_part('template-parts/content', 'team');
        endwhile;
		?>
		</div>
		<?php
        endif;

        // Reset Post Data
        wp_reset_postdata();
		?>

	</main><!-- #main -->

<?php
get_footer();
