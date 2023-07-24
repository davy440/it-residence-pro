<?php
/**
 * Enqueue scripts and styles.
 */

 function itre_enqueue_fonts() {

	$heading_font 	= 'League Spartan';
	$heading_weight = 700;
	$heading_cat	= 'sans-serif';
	$body_font 		= 'League Spartan';
	$body_weight 	= 400;
	$body_cat		= 'sans-serif';

	if (!empty( get_theme_mod('itre_gfonts_heading'))) {
		$heading_font = get_theme_mod( 'itre_gfonts_heading', 'League Spartan' );
		$heading_font = str_replace( ' ', '+', $heading_font );
	}

	if ( !empty(get_theme_mod('itre_gweights_heading'))) {
		$heading_weight = get_theme_mod( 'itre_gweights_heading', 700 );
	}

	if (!empty(get_theme_mod('itre_gfonts_body'))) {
		$body_font = get_theme_mod('itre_gfonts_body', 'League Spartan');
		$body_font = str_replace( ' ', '+', $body_font );
	}

	if (!empty( get_theme_mod('itre_gweights_body' ) ) ) {
		$body_weight = get_theme_mod('itre_gweights_body', 400);
	}

	$fontCall = '';
	$fontCall .= 'https://fonts.googleapis.com/css?family=';
	$fontCall .= $body_font;
	$fontCall .= ':' . $body_weight;

	if ( $heading_font !== $body_font ) {
		$fontCall .= '|' . $heading_font;
		$fontCall .= ':' . $heading_weight;
	}

	// At this point, both heading and body fonts are same
	if ( $heading_weight !== $body_weight ) {
		$fontCall .= ',' . $heading_weight;
	}

	if (!empty(get_theme_mod('itre_gfonts_subsets'))) {
		$fontCall .= '&subset=' . implode(',', get_theme_mod('itre_gfonts_subsets', ['latin']));
	} else {
		$fontCall .= '&subset=latin';
	}

	$fontCall .= '&display=swap';

	wp_enqueue_style( 'itre-fonts', esc_url( $fontCall ), array(), NULL );

}
add_action( 'wp_enqueue_scripts', 'itre_enqueue_fonts' );


function itre_scripts() {

	wp_enqueue_style( 'itre-style', get_stylesheet_uri(), array(), ITRE_VERSION );
	wp_style_add_data( 'itre-style', 'rtl', 'replace' );
	wp_enqueue_style('itre_fonts', 'https://fonts.googleapis.com/css?family=League+Spartan:400,700&display=swap', ITRE_VERSION );
    wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/assets/bootstrap.css'), array(), ITRE_VERSION );
	wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/assets/font-awesome.css'), array(), ITRE_VERSION );
	wp_enqueue_style( 'owl-css', esc_url(get_template_directory_uri() . '/assets/owl.carousel.css'), array(), ITRE_VERSION );
    wp_enqueue_style( 'itre-main', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/main.css'), array(), ITRE_VERSION );
	wp_enqueue_script( 'itre-bigslide', esc_url(get_template_directory_uri() . '/assets/js/bigSlide.js'), array('jquery'), ITRE_VERSION );
	wp_enqueue_script( 'owl-js', esc_url(get_template_directory_uri() . '/assets/js/owl.carousel.js'), array('jquery'), ITRE_VERSION );
	wp_enqueue_script( 'video-bg-js', esc_url(get_template_directory_uri() . '/assets/js/jquery.youtube-background.js'), array('jquery'), ITRE_VERSION, true );
	wp_enqueue_script( 'itre-navigation', esc_url(get_template_directory_uri() . '/assets/js/navigation.js'), array(), ITRE_VERSION, true );
	wp_enqueue_script( 'itre-custom-js', esc_url( get_template_directory_uri() . '/assets/js/custom.js'), array('jquery'), ITRE_VERSION, true );

	if (post_type_exists('property')) {
        wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script( 'itre-property-js', esc_url( get_template_directory_uri() . '/assets/js/property.js'), array('jquery'), ITRE_VERSION, true );

		if ( is_singular(['property']) ) {

			global $post;
            wp_enqueue_script( 'itre-property-map-js', esc_url( get_template_directory_uri() . '/assets/js/property-map.js'), array('jquery'), ITRE_VERSION, true );
			$data = get_post_meta($post->ID);

			wp_localize_script( 'itre-property-map-js', 'itreMap', $data );
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'itre_scripts' );
