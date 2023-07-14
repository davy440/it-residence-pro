<?php
/**
 *
 *	Template for displaying property listing
 *
 */
$itre_stored_meta = get_post_meta( get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('list'); ?>>

	 <div class="listing-wrapper">
		 <div class="itre-prop-thumb col-md-4">



			 <a href="<?php the_permalink(); ?>">
			 <?php
			 if ( has_post_thumbnail() ) {
				 the_post_thumbnail('itre_prop_thumb');
			 }
			 else {
				 printf('<img src="%s" alt="%s">', esc_url(get_template_directory_uri() . '/images/ph_thumb.png'), esc_attr( get_the_title() ) );
			 }
			 ?>
		 </a>

		 </div>

         <div class="itre-prop-content col-md-8">
    	 	<header class="entry-header">
    	 		<?php
    	 			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    			?>
    	 	</header><!-- .entry-header -->

            <div class="prop-price-info">
            <?php
			if (!empty( $itre_stored_meta['price'][0] ) ) {
				itre_get_property_price( $itre_stored_meta['price'][0] );
			}


            if (!empty($itre_stored_meta["for"][0])) {
                itre_get_for( $itre_stored_meta["for"][0] );
            }
            ?>
            </div>

            <?php
			if ( !empty( $itre_stored_meta[ 'address' ][0] ) ) {
				printf('<div class="itre_address">%s</div>', $itre_stored_meta[ 'address' ][0] );
			}
    		?>

    		<div class="itre_features">
    			<?php
    			if ( !empty( $itre_stored_meta[ 'bedrooms' ][0] ) ) {
    				printf( '<span class="itre_bed"><i class="fa fa-bed" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bedrooms' ][0] );
    			}

    			if ( !empty( $itre_stored_meta[ 'bathrooms' ][0] ) ) {
    				printf( '<span class="itre_shower"><i class="fa fa-shower" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $itre_stored_meta[ 'bathrooms' ][0] );
    			}

    			if ( !empty( $itre_stored_meta[ 'area' ][0] ) ) {
    				printf( '<span class="itre_area"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="itre_area">%u %s</span></span>', $itre_stored_meta[ 'area' ][0], itre_area_units() );
    			}
    			?>
    		</div>
        </div>
	</div>

 	<footer class="entry-footer">
 		<?php itre_entry_footer(); ?>
 	</footer><!-- .entry-footer -->
 </article><!-- #post-<?php the_ID(); ?> -->
