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

if ( !function_exists('itre_property_filter_form') ) {
    function itre_property_filter_form() {

        if ( empty( get_theme_mod('itlst_prop_filter_enable', 1) ) ) {
            return;
        } ?>
        <div class="itre-property-filter-wrapper container">
     	<div class="itre-property-filter">
    		<form id="itre-property-filter-form" method="post">
    			<div class="itre-property-filter-form-wrapper d-grid align-items-lg-center">
                    <div class="filter-fields p-0">
                        <div class="filter-fields-wrapper">
                            <div class="itre-type form-control-wrapper p-0">
                                <?php
                                $types_list = [];
                                $types = get_terms('property-type');
                                foreach($types as $type) {
                                    $types_list[$type->slug] = $type->name;
                                }
                                ?>
                                <select id="property-type" name="type">
                                    <option value="0"><?php _e('Type', 'it-residence'); ?>
                                    <?php foreach($types_list as $key => $value) { ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="itre-type form-control-wrapper p-0">
                                <?php
                                $locations_list = [];
                                $locations = get_terms('location');
                                foreach($locations as $location) {
                                    $locations_list[$location->slug] = $location->name;
                                }
                                ?>
                                <select id="location" name="location">
                                    <option value="0"><?php _e('Location', 'it-residence'); ?>
                                    <?php foreach($locations_list as $key => $value) { ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="itre-status form-control-wrapper p-0">
                                <select class="form-control-for" name="for" id="for" placeholder="<?php esc_attr_e("Status", 'it-residence'); ?>">
                                    <option value="0"><?php _e("Status", 'it-residence'); ?></option>
                                    <option value="sale"><?php _e("For Sale", 'it-residence'); ?></option>
                                    <option value="rent"><?php _e("For Rent", 'it-residence'); ?></option>
                                    <option value="sold"><?php _e("Sold", 'it-residence'); ?></option>
                                    <option value="coming-soon"><?php _e("Coming Soon", 'it-residence'); ?></option>
                                </select>
                            </div>

                            <div class="itre-bedrooms form-control-wrapper p-0">
                                <select class="form-control-bedrooms" name="bedrooms" id="bedrooms" placeholder="<?php esc_attr_e("Bedrooms", 'it-residence'); ?>">
                                    <option value="0"><?php _e("Bedrooms", 'it-residence'); ?></option>
                                    <option value="1"><?php _e("1", 'it-residence'); ?></option>
                                    <option value="2"><?php _e("2", 'it-residence'); ?></option>
                                    <option value="3"><?php _e("3", 'it-residence'); ?></option>
                                    <option value="4"><?php _e("4", 'it-residence'); ?></option>
                                    <option value="5"><?php _e("5", 'it-residence'); ?></option>
                                    <option value="5+"><?php _e("5+", 'it-residence'); ?></option>
                                </select>
                            </div>

                            <div class="itre-min-area form-control-wrapper p-0">
                                <input class="form-control-min-area" type="number" name="min-area" id="min-area" placeholder="<?php esc_attr_e("Min Area", 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-max-area form-control-wrapper p-0">
                                <input class="form-control-max-area" type="number" name="max-area" id="max-area" placeholder="<?php esc_attr_e('Max Area', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-min-price form-control-wrapper p-0">
                                <input class="form-control-min-price" type="number" name="min-price" id="min-price" placeholder="<?php esc_attr_e('Min Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-max-price form-control-wrapper p-0">
                                <input class="form-control-max-area" type="number" name="max-price" id="max-price" placeholder="<?php esc_attr_e('Max Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="filter-btn p-0">
                        <input type="submit" value="<?php esc_html_e('Submit', 'it-residence'); ?>"/>
                    </div>
    			</div>
    		</form>
     	</div>
        <div class="itre-nghbrhoods"></div>
        </div>
    <?php
    }
}
add_action('itre_property_filter', 'itre_property_filter_form');


if ( !function_exists('itre_property_listing') ) {
    function itre_property_listing() {
     	?>

     	<div class="itre-property-listing section container">
     		<?php
     		$args = array(
     			'post_type'         => 'property',
                'post_status'       => 'publish',
     			'posts_per_page'	=> 15
     		);

     		$prop_query = new WP_Query( $args );

     			// The Loop
     			if ( $prop_query->have_posts() ) :
     			while ( $prop_query->have_posts() ) : $prop_query->the_post();

     			  global $post;

                  get_template_part('template-parts/property-layouts/content', 'property');

     			endwhile;
     			endif;

     			// Reset Post Data
     			wp_reset_postdata();
     		?>
     	</div>
     <?php
    }
}
add_action('itre_property_filter', 'itre_property_listing', 20);

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

        default:
        $currency['locale'] =   'en_US';
        $currency['code']   =   'USD';
    }

    return $currency;
}
