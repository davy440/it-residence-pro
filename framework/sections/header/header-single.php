<?php
/**
 *  Default Header
 */
 ?>

 <header id="masthead" class="site-header single">
    <?php itre_get_top_bar(); ?>

    <?php if ( !empty(get_header_image() || has_post_thumbnail() ) ) : ?>
    <div class="itre-banner">
        <?php
            $setting = get_theme_mod('itre_blog_header_layout', 'default');
            if ( has_post_thumbnail() && $setting == 'image' ) {
                the_post_thumbnail();
            } else {
                echo wp_get_attachment_image( attachment_url_to_postid( get_header_image() ), 'full' );
            }
            
        ?>
    </div>
    <?php endif; ?>
 </header><!-- #masthead -->
