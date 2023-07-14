<?php
/**
 * Template part for displaying Single Properties
 *
 * @package IT_Residence
 */
$itre_stored_meta = get_post_meta( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
        ?>
	</header><!-- .entry-header -->

    <div class="entry-meta">

		<?php
		if (!empty($itre_stored_meta["for"][0])) {
			itre_get_for( $itre_stored_meta["for"][0] );
		}
		?>

        <?php
        //Price of Property
		if (!empty( $itre_stored_meta['price'][0] ) ) {
			itre_get_property_price( $itre_stored_meta['price'][0] );
		}

		if (has_term( '', 'location' ) ) {
            printf( '<span class="itre_location"><i class="fa fa-map-marker" aria-hidden="true"></i><span>%s</span></span>', get_the_terms($post, 'location')[0]->name );
		}

        //Bedrooms
        if ( !empty( $itre_stored_meta[ 'bedrooms' ][0] ) ) {
            printf( '<span class="itre_bed"><i class="fa fa-bed" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bedrooms' ][0] );
        }

        //Bathrooms
        if ( !empty( $itre_stored_meta[ 'bathrooms' ][0] ) ) {
            printf( '<span class="itre_shower"><i class="fa fa-shower" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bathrooms' ][0] );
        }

		if ( !empty( $itre_stored_meta[ 'stories' ][0] ) ) {
			printf( '<span class="itre_stories"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>Untitled-6</title><polygon points="3.1 20 0 20 0 11.27 5.63 11.27 5.63 5.63 11.27 5.63 11.27 0 20 0 20 3.1 14.37 3.1 14.37 8.73 8.73 8.73 8.73 14.37 3.1 14.37 3.1 20"/></svg><span class="itre_stories">%u</span></span>', $itre_stored_meta[ 'stories' ][0] );
		}


		if ( !empty( $itre_stored_meta[ 'garage' ][0] ) ) {
			printf( '<span class="garage"><svg xmlns="http://www.w3.org/2000/svg" width="20.07" height="20.06" viewBox="0 0 20.07 20.06"><title>garage</title><path d="M3.51,20.09H.69a.71.71,0,0,1-.76-.77V5.83A.78.78,0,0,1,.4,5.07L7.2,1.41C8,1,8.75.58,9.52.15a.85.85,0,0,1,.87,0l9.16,4.93a.79.79,0,0,1,.45.76V19.28a.73.73,0,0,1-.8.81H16.41V8.78c0-.61-.26-.88-.86-.88H4.37c-.6,0-.86.27-.86.87V20.09Z" transform="translate(0.07 -0.03)"/><path d="M15,11.48H5V9.35H15Z" transform="translate(0.07 -0.03)"/><path d="M15,12.93v2.13H5V12.93Z" transform="translate(0.07 -0.03)"/><path d="M5,18.64V16.52H15v2.12Z" transform="translate(0.07 -0.03)"/></svg><span class="itre_garage">%u</span></span>', $itre_stored_meta[ 'garage' ][0] );
		}

        //Date of Property
        itre_posted_on();
        ?>
    </div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'it-residence' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'it-residence' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php itre_single_property_map(); ?>

	<footer class="entry-footer">
		<?php itre_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
