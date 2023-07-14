<?php
/**
 *  Sanitization Functions
 */

 function itre_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function itre_sanitize_radio( $input, $setting ) {

 	// Ensure input is a slug
 	$input = sanitize_key( $input );

 	// Get list of choices from the control
 	// associated with the setting
 	$choices = $setting->manager->get_control( $setting->id )->choices;

 	// If the input is a valid key, return it;
 	// otherwise, return the default
 	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

 }

 function itre_sanitize_select( $input, $setting ) {

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

 function itre_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );

  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
