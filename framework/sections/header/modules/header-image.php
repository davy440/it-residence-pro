<?php
/**
 * Module to include header image
 * 
 * @package IT_Residence_Pro
 */
$default_image = ITRE_URL . 'assets/images/header.jpg';
$header_tag = sprintf('<img src="%s" alt="%s"/>', esc_url($default_image), get_bloginfo('name'));

$header_url = get_header_image();
if (!empty($header_url) || is_front_page()) {
    $header_tag = sprintf('<img src="%s" alt="%s"/>', esc_url($header_url), get_bloginfo('name'));
}

$page_thumbnail = wp_get_attachment_image( attachment_url_to_postid( $header_url ), 'full' );
if (!is_front_page() && has_post_thumbnail(get_the_ID())) {
    $header_tag = get_the_post_thumbnail(get_the_ID(), 'full');
}

echo $header_tag;
?>