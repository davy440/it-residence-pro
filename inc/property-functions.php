<?php
/**
 *
 *  Functions for Property Custom Post Type
 *
 */

if ( !function_exists('itre_get_for') ) {
    function itre_get_for( $value ) {

        $for = "";

        switch ($value):
            case "sold":
                $for = "sold";
            break;
            case "coming-soon":
                $for = "coming soon";
            break;
            case "sale":
                $for = "sale";
            break;
            case "rent":
                $for = "rent";
            break;
            default:
            $for = "";
        endswitch;

        printf('<span class="itre-for-tag %s">%s</span>', esc_attr( $value ),  esc_html( $for ));
    }
}

// AJAX Query for filtered properties
function itre_get_filtered_properties() {
	if (!wp_create_nonce($_POST['nonce'], 'filter_properties')) {
		exit;
	}
	$args = array(
        'post_type'				=>	'property',
        'ignore_sticky_posts'	=>	false,
        'posts_per_page'		=>	-1
    );

    if (!empty($_POST['bedrooms'])) {
        $args['meta_query'][] = array(
            'key'	=>	'bedrooms',
            'value'	=>	intval($_POST['bedrooms']),
            'type'	=>	'NUMERIC',
        );
    }

    if (!empty($_POST['type'])) {
        $args['tax_query'][] = array(
            'taxonomy'	=>	'property-type',
            'field'	=>	'slug',
            'terms'	=>	$_POST['type']
        );
    }

    if (!empty($_POST['location'])) {
        $args['tax_query'][] = array(
            'taxonomy'	=>	'location',
            'field'	=>	'slug',
            'terms'	=>	$_POST['location']
        );
    }

    if (!empty($_POST['for'])) {
        $args['meta_query'][] = array(
            'key'   =>  'for',
            'value' =>  $_POST['for']
        );
    }

    if (!empty($_POST['min-price']) && !empty($_POST['max-price'])) {
        $args['meta_query'][] = array(
            'key'		=>	'price',
            'value'		=>	[intval($_POST['min-price']), intval($_POST['max-price'])],
            'compare'	=>	'BETWEEN'
        );
    }

    if (!empty($_POST['min-price']) && empty($_POST['max-price'])) {
        $args['meta_query'][] = array(
            'key'		=>	'price',
            'value'		=>	intval($_POST['min-price']),
            'compare'	=>	'>='
        );
    }
    
    if (empty($_POST['min-price']) && !empty($_POST['max-price'])) {
        $args['meta_query'][] = array(
            'key'		=>	'price',
            'value'		=>	intval($_POST['max-price']),
            'compare'	=>	'<='
        );
    }

    if (!empty($_POST['min-area']) && !empty($_POST['max-area'])) {
        $args['meta_query'][] = array(
            'key'		=>	'area',
            'value'		=>	[intval($_POST['min-area']), intval($_POST['max-area'])],
            'compare'	=>	'BETWEEN'
        );
    }

    if (!empty($_POST['min-area']) && empty($_POST['max-area'])) {
        $args['meta_query'][] = array(
            'key'		=>	'area',
            'value'		=>	intval($_POST['min-area']),
            'type'		=>	'NUMERIC',
            'compare'	=>	'>='
        );
    }
    
    if (empty($_POST['min-area']) && !empty($_POST['max-area'])) {
        $args['meta_query'][] = array(
            'key'		=>	'area',
            'value'		=>	intval($_POST['max-area']),
            'compare'	=>	'<='
        );
    }

	$filter_query = new WP_Query( $args );

	// The Loop
	if ( $filter_query->have_posts() ) :
	while ( $filter_query->have_posts() ) : $filter_query->the_post();
	global $post;
		get_template_part('template-parts/property-layouts/content', 'property');
	endwhile;
	endif;

	// Reset Post Data
	wp_reset_postdata();
		
	
	wp_die();
}
add_action('wp_ajax_filter_properties', 'itre_get_filtered_properties');
add_action('wp_ajax_nopriv_filter_properties', 'itre_get_filtered_properties');


/**
 * Fetch Request for getting the neighbourhoods of a location
 *
 * @return  void
 */
 function itre_get_neighbours() {
    if (!wp_create_nonce($_POST['nonce'], 'nghbr_nonce')) {
		exit;
	}

    $location = get_term_by('slug', $_POST['location'], 'location')->term_id;
    $children = get_term_children($location, 'location');
    
    $children_tags = '';
    foreach($children as $child) {
        $child_name = get_term($child)->name;
        $child_slug = get_term($child)->slug;
        $children_tags .= "<span class='itre-nghbrhood' data-location={$child_slug}>{$child_name}</span>";
    }
    echo $children_tags;

    die();
 }
add_action('wp_ajax_get_neighbours', 'itre_get_neighbours');
add_action('wp_ajax_nopriv_get_neighbours', 'itre_get_neighbours');

//Pass Variables to JS for use in AJAX
function itre_localize_ajax_data() {
	
    $data['action_filter']    	= 'filter_properties';
    $data['nonce_filter']		= wp_create_nonce('filter_properties');
    $data['nghbr_action']       = 'get_neighbours';
    $data['nghbr_nonce']       = wp_create_nonce('get_neighbours');
    $data['ajaxurl']    		= admin_url('admin-ajax.php');
	
    wp_localize_script( 'itre-property-js', 'filter', $data );
 }
 add_action('wp_enqueue_scripts', 'itre_localize_ajax_data');

function itre_get_currency() {

    $val = get_theme_mod('itre_currency', 'dollar');
    $currency = [];
    switch ( $val ) {
        case 'dollar':
        $currency['locale'] =   'en_US';
        $currency['code']   =   'USD';
        break;

        case 'euro':
        $currency['locale'] =   'nl_NL';
        $currency['code']   =   'EUR';
        break;

        case 'pound':
        $currency['locale'] =   'en_GB';
        $currency['code']   =   'GBP';
        break;

        case 'ruble':
        $currency['locale'] =   'ru_RU';
        $currency['code']   =   'RUB';
        break;

        case 'yen':
        $currency['locale'] =   'ja_JP';
        $currency['code']   =   'JPY';
        break;

        case 'custom':
            $currency['locale'] = get_theme_mod('itre_custom_currency_locale', 'en-US');
            $currency['code']   = get_theme_mod('itre_custom_currency_code', 'USD');
        break;
        
        default:
        $currency['locale'] =   'en_US';
        $currency['code']   =   'USD';
    }

    return $currency;
}
