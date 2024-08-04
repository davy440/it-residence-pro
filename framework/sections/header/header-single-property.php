<?php
/**
 *  Default Header
 */
global $post;
$is_map = get_post_meta( get_the_ID(), 'maps', true );
$location = get_post_meta( get_the_ID(), 'location', true );

$map_in_header = !empty( $is_map ) && $location === 'header';
?>
 <header id="masthead" class="site-header single-property">
    <?php itre_get_top_bar();

    
    if ( !empty(get_header_image()) || !empty( has_post_thumbnail() ) ) : ?>
        <div class="itre-banner-wrapper <?php if ($map_in_header) echo 'header-map'; ?>">
            <div class="itre-banner">
                <?php
            $setting = get_theme_mod('itre_blog_header_layout', 'default');
            if ( has_post_thumbnail() && $setting == 'image' ) {
                the_post_thumbnail();
            } else {
                $header_image = attachment_url_to_postid( get_header_image() );
                if (!empty($header_image)) {
                    echo wp_get_attachment_image( $header_image, 'full' );
                } else {
                    echo "<img src='" . ITRE_URL . "assets/images/header.jpg' title='" . get_the_title($post->ID) . "'/>";
                }
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
