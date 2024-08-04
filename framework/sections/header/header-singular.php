<?php
/**
 *  Default Header
 */
 ?>

 <header id="masthead" class="site-header singlular">
    <?php itre_get_top_bar(); ?>
    <?php if ( !empty(get_header_image() || has_post_thumbnail() ) ) : ?>
        <div class="itre-banner">
            <?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail();
            } else if (has_header_image()) {
                $image = get_header_image();
                $image_id = attachment_url_to_postid( $image );
                if (empty($image_id)) {
                    $title = get_the_title();
                    echo "<img src={$image} alt={$title} width='100%' height='100%' loading='lazy'/>";
                } else {
                    echo wp_get_attachment_image( attachment_url_to_postid( get_header_image() ), 'full' );
                }
            }          
            
        ?>
    </div>
    <?php endif; ?>
 </header><!-- #masthead -->
