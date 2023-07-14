<?php
/**
 *
 *	Template for displaying property listing
 *
 */

$itre_stored_meta = get_post_meta( get_the_ID() );
?>

 <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3 property-tab'); ?>>

     <a href="<?php the_permalink(); ?>">
	    <div class="listing-wrapper">
    		 <div class="itre-prop-thumb">

                 <?php
                 itre_get_for( $itre_stored_meta["for"][0] );
                 ?>

    			 <?php
    			 if ( has_post_thumbnail() ) {
    				 the_post_thumbnail('itre_feat_thumb');
    			 }
    			 else {
    				 printf('<img src="%s" alt="%s">', esc_url( get_template_directory_uri() . '/images/itre_ph.png'), esc_attr( get_the_title() ) );
    			 }

                 if (!empty( $itre_stored_meta['price'][0] ) ) {
                    itre_get_property_price( $itre_stored_meta['price'][0] );
                 }

                 $for = $itre_stored_meta["for"][0];
                 ?>

    		 </div>

    	 	<header class="entry-header">
    	 		<?php
    	 			the_title( '<h2 class="entry-title">', '</h2>' );
    			?>
    	 	</header><!-- .entry-header -->
	     </div>
    </a>

 	<footer class="entry-footer">
 		<?php itre_entry_footer(); ?>
 	</footer><!-- .entry-footer -->
 </article><!-- #post-<?php the_ID(); ?> -->
