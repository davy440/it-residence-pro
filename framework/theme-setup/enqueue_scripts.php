<?php
/**
 * Enqueue fonts. The woff2 files are added using @font-face file via fonts.css file.
 *
 * @return  void
 */
function itre_enqueue_fonts() {
	$fonts = ITRE_Google_Fonts::itre_get_font_settings();
	$filePaths = glob(get_template_directory() . '/assets/cache/fontFiles/*.woff2');
	$fileURI = get_template_directory_uri() . '/assets/cache/fontFiles/';
	$fontFace = '';

	foreach($filePaths as $path) {
		if (strpos($path, 'heading')) {
			$uri['heading'] = $fileURI . basename( $path );
		}
	
		if (strpos($path, 'body')) {
			$uri['body'] = $fileURI . basename( $path );
		}
	}

	foreach($fonts as $key => $value) {
		$fontFamily = $value['family'];
		$fontWeight = $value['weight'];
		$fontURI = $uri[$key];
		$fontCat = $value['cat'];

		$fontFace .= '@font-face {';
		$fontFace .= "font-family: {$fontFamily};";
		$fontFace .= "font-weight: {$fontWeight};";
		$fontFace .= "src: url({$fontURI}) format('woff2');";
		$fontFace .= "font-display: swap;";
		$fontFace .= "font-stretch: normal;";
		$fontFace .= "}";
	}
	$filePath = get_template_directory() . '/assets/cache/fontFiles/fonts.css';

	$c = fopen( $filePath, 'w+' );
	fwrite( $c, $fontFace );
	fclose( $c );

	$fileURI = get_template_directory_uri() . '/assets/cache/fontFiles/fonts.css';
	wp_enqueue_style('itre-fonts', esc_url( $fileURI ), ITRE_VERSION );
}
add_action( 'wp_enqueue_scripts', 'itre_enqueue_fonts' );


function itre_scripts() {

	wp_enqueue_style( 'itre-style', get_stylesheet_uri(), array(), ITRE_VERSION );
	wp_style_add_data( 'itre-style', 'rtl', 'replace' );
    wp_enqueue_style( 'bootstrap', esc_url(get_template_directory_uri() . '/assets/bootstrap.css'), array(), ITRE_VERSION );
	wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri() . '/assets/font-awesome.css'), array(), ITRE_VERSION );
	wp_enqueue_style( 'owl-css', esc_url(get_template_directory_uri() . '/assets/owl.carousel.css'), array(), ITRE_VERSION );
    wp_enqueue_style( 'itre-main', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/main.css'), array(), ITRE_VERSION );
	wp_enqueue_style( 'glightbox-css', esc_url(get_template_directory_uri() . '/assets/theme-styles/css/glightbox.min.css'), array(), ITRE_VERSION );
	wp_enqueue_script( 'owl-js', esc_url(get_template_directory_uri() . '/assets/js/owl.carousel.js'), array('jquery'), ITRE_VERSION );
	wp_enqueue_script( 'glightbox-js', esc_url(get_template_directory_uri() . '/assets/js/glightbox.min.js'), array(), ITRE_VERSION, true );
	wp_enqueue_script( 'video-bg-js', esc_url(get_template_directory_uri() . '/assets/js/jquery.youtube-background.js'), array('jquery', 'glightbox-js'), ITRE_VERSION, true );
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
