<?php
/**
 * Module to include header image
 * 
 * @package IT_Residence_Pro
 */
$default_image = ITRE_URL . 'assets/images/header.jpg';
$header_tag = sprintf('<img src="%s" alt="%s"/>', esc_url($default_image), get_bloginfo('name'));
$header_url = get_header_image();


if (!empty($header_url)) {
    if (is_front_page() || is_home()) {
        $header_tag = sprintf('<img src="%s" alt="%s"/>', esc_url($header_url), get_bloginfo('name'));
    }
}

if (!is_front_page() && is_singular() && has_post_thumbnail(get_the_ID())) {
    $header_tag = get_the_post_thumbnail(get_the_ID(), 'full');
}

echo $header_tag;
?>