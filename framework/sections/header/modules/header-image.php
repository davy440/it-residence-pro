<?php
/**
 * Module to include header image
 * 
 * @package IT_Residence_Pro
 */
    $header_url = get_header_image();
    $header_tag = wp_get_attachment_image( attachment_url_to_postid( $header_url ), 'full' );
    if (!empty( $header_tag)) {
        echo $header_tag;
    }
?>