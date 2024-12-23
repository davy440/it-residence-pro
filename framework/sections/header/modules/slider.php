<?php
/**
 * The Slider module to be used in Header
 */
?>

<div class="header-slider-wrapper owl-carousel">
    <?php
    for ($i = 1; $i <= 8; $i++ ) {
        $img = get_theme_mod('itre_header_slider_img_' . $i, '');
        if (empty($img) ) {
            continue;
        }
        $img_tag = wp_get_attachment_image( attachment_url_to_postid( $img ), 'full' );
        printf('<div class="slide-img">%s</div>', $img_tag );
    }
?>
</div>