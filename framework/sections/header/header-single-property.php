<?php
/**
 *  Default Header
 */
 
$is_map = get_post_meta( get_the_ID(), 'maps', true );
$location = get_post_meta( get_the_ID(), 'location', true );

$map_in_header = !empty( $is_map ) && $location === 'header';
?>
 <header id="masthead" class="site-header single-property">
    <?php itre_get_top_bar(); ?>

    <?php if ( !empty(get_header_image() || has_post_thumbnail() ) ) : ?>
    <div class="itre-banner-wrapper <?php if ( $map_in_header) echo 'header-map'; ?>">
        <div class="itre-banner">
        <?php
            $setting = get_theme_mod('itre_blog_header_layout', 'default');
            if ( has_post_thumbnail() && $setting == 'image' ) {
                the_post_thumbnail();
            } else {
                echo wp_get_attachment_image( attachment_url_to_postid( get_header_image() ), 'full' );
            }
            endif; ?>
        </div>

        <?php
        if ( get_post_type() === 'property' ) {
        

        if (!empty($is_map) && $location === 'header') {
            echo '<div id="property-map"></div>';
        }
    }
    ?>
    </div>
 </header><!-- #masthead -->
