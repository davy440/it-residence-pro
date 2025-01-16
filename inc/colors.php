<?php
/**
 *
 *  Functionality for Custom Colors
 *
 */

function itre_custom_colors() {
    
    $css = "";

    $body_bg        = get_theme_mod('background_color', '#ffffff');
    $box_bg         = get_theme_mod('itre_box_bg_color', '#ffffff');
    $text           = get_theme_mod('itre_body_text_color', '#000000');
    $excerpt        = get_theme_mod('itre_body_excerpt_color', '#999999');
    $accent         = get_theme_mod('itre_accent_color', '#2e6d87');
    $sec            = get_theme_mod('itre_sec_color', '#08445d');
    $meta_link      = get_theme_mod('itre_link_color', '#999999');
    $meta_link_hvr  = get_theme_mod('itre_link_hvr_color', '#555555');
    $header_bg      = get_theme_mod('itre_masthead_bg', '#ffffff');
    $nav_bg         = get_theme_mod('itre_nav_bg', '#2e6d87');
    $nav_link       = get_theme_mod('itre_nav_link_clr', '#2e6d87');
    $subnav_link    = get_theme_mod('itre_submenu_link_clr', '#ffffff');
    $footer_bg      = get_theme_mod('itre_footer_bg', '#08445d');
    $colophon_bg      = get_theme_mod('itre_colophon_bg', '#08445d');
    $footer_link    = get_theme_mod('itre_footer_link_clr', '#ffffff');
    $footer_text    = get_theme_mod('itre_footer_text_clr', '#ffffff');
    
    $header_overlay = get_theme_mod('itre_header_overlay_color', 'rgba(20, 88, 112, 0.4)');

    $css .= ':root {';
    $css .= $text !== '#000000' ? "--body-text:{$text};" : "";
    $css .= $excerpt !== '#999999' ? "--excerpt:{$excerpt};" : "";
    $css .= $accent !== '#2e6d87' ? "--accent:{$accent};" : "";
    $css .= $sec !== '#08445d' ? "--dark:{$sec};" : "";
    $css .= $meta_link !== '#999999' ? "--link:{$meta_link};" : "";
    $css .= $meta_link_hvr !== '#555555' ? "--link-hvr:{$meta_link_hvr};" : "";
    $css .= $header_bg !== '#ffffff' ? "--masthead-bg:{$header_bg};" : "";
    $css .= $nav_bg !== '#2e6d87' ? "--nav-bg:{$nav_bg};" : "";
    $css .= $nav_link !== '#2e6d87' ? "--nav-link:{$nav_link};" : "";
    $css .= $subnav_link !== '#ffffff' ? "--subnav-link:{$subnav_link};" : "";
    $css .= $footer_bg !== '#08445d' ? "--footer-bg:{$footer_bg};" : "";
    $css .= $footer_link !== '#ffffff' ? "--footer-link:{$footer_link};" : "";
    $css .= $footer_text !== '#ffffff' ? "--footer-text:{$footer_text};" : "";
    
    $css .= '}';

    $css .= "#itre-featured-property .itre-feat-prop-info {background-color: #{$body_bg};}";
	
    if ( is_front_page() ||
     ( is_page() && get_post_meta( get_the_ID(), 'header-overlay', true ) ) ) {
         $css .= "#header-video:before, #header-image:before, .slide-img:before, .itre-banner:before { background-color: " . esc_html( $header_overlay ) . ";}";
     }

    wp_add_inline_style('itre-main', $css);

}
add_action('wp_enqueue_scripts', 'itre_custom_colors');
