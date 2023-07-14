<?php
/**
 *
 *  Functionality for Custom Colors
 *
 */

function itre_custom_colors() {

    $css = "";

    $body_bg       = get_theme_mod('background_color', '#ffffff');
    $box_bg        = get_theme_mod('itre_box_bg_color', '#ffffff');
    $text           = get_theme_mod('itre_body_text_color', '#000000');
    $excerpt        = get_theme_mod('itre_body_excerpt_color', '#999999');
    $accent         = get_theme_mod('itre_accent_color', '#2e6d87');
    $meta_link      = get_theme_mod('itre_link_color', '#999999');
    $meta_link_hvr  = get_theme_mod('itre_link_hvr_color', '#555555');
    $header_bg      = get_theme_mod('itre_masthead_bg', '#ffffff');
    $nav_bg         = get_theme_mod('itre_nav_bg', '#2e6d87');
    $nav_link       = get_theme_mod('itre_nav_link_clr', '#2e6d87');
    $subnav_link    = get_theme_mod('itre_submenu_link_clr', '#ffffff');
    $footer_bg      = get_theme_mod('itre_footer_bg', '#08445d');
    $footer_link    = get_theme_mod('itre_footer_link_clr', '#ffffff');
    $footer_text    = get_theme_mod('itre_footer_text_clr', '#ffffff');

    $header_overlay = get_theme_mod('itre_header_overlay_color', 'rgba(20, 88, 112, 0.4)');

    if ($text !== '#000000') {
        $css .= ':root {--body-text: ' . $text . ';}';
    }

    $css .= "#itre-featured-property .itre-feat-prop-info {background-color: #{$body_bg};}";

    if ( $box_bg !== '#ffffff' && !is_page_template('template-property-front.php') ) {
        $css .= "#content { background-color: {$box_bg} !important;}";
    }

    if ($excerpt !== '#999999') {
        $css .= ":root {--excerpt: {$excerpt};}";
    }

    if ($accent !== '#2e6d87') {
        $css .= ":root {--accent: {$accent};}";
    }

    if ($meta_link !== '#999999') {
        $css .= ":root {--link: {$meta_link};}";
    }

    if ($meta_link_hvr !== '#555555') {
        $css .= "root {--link-hvr: {$meta_link_hvr};}";
    }

    if ($header_bg !== '#ffffff') {
        $css .= ":root {--masthead-bg: {$header_bg};}";
    }

    if ($nav_bg !== '#2e6d87') {
        $css .= ":root {--nav-bg: {$nav_bg};}";
    }

    if ($nav_link !== '#2e6d87') {
        $css .= ":root {--nav-link: {$nav_link};}";
    }

    if ($subnav_link !== '#ffffff') {
        $css .= ":root {--subnav-link: {$subnav_link};}";
    }

    if ($footer_bg !== '#08445d') {
        $css .= ":root {--footer-bg: {$footer_bg};}";
    }

    if ($footer_link !== '#ffffff') {
        $css .= ":root {--footer-link: {$footer_link};}";
    }

    if ($footer_text !== '#ffffff') {
        $css .= ':root {--footer-text: ' . $footer_text . ';}';
    }

    if ( is_front_page() ||
     ( is_page() && get_post_meta( get_the_ID(), 'header-overlay', true ) ) ) {
         $css .= "#header-video:before, #header-image:before, .slide-img:before { background-color: " . esc_html( $header_overlay ) . ";}";
     }

    wp_add_inline_style('itre-main', $css);

}
add_action('wp_enqueue_scripts', 'itre_custom_colors');
