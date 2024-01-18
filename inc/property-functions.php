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
            case "active":
                $for = "active";
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

        printf('<span class="itre-for-tag %s">%s</span>', esc_attr( $value ),  esc_html( $for ) );
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
    			<div class="row align-items-center">
                    <div class="filter-fields col-md-9">
                        <div class="row">
                            <div class="itre-type form-control-wrapper col-md-4">
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

                            <div class="itre-min-area form-control-wrapper col-md-4">
                                <input class="form-control-min-area" type="number" name="min-area" id="min-area" placeholder="<?php esc_attr_e("Min Area", 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-max-area form-control-wrapper col-md-4">
                                <input class="form-control-max-area" type="number" name="max-area" id="max-area" placeholder="<?php esc_attr_e('Max Area', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-bedrooms form-control-wrapper col-md-4">
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

                            <div class="itre-min-price form-control-wrapper col-md-4">
                                <input class="form-control-min-price" type="number" name="min-price" id="min-price" placeholder="<?php esc_attr_e('Min Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-max-price form-control-wrapper col-md-4">
                                <input class="form-control-max-area" type="number" name="max-price" id="max-price" placeholder="<?php esc_attr_e('Max Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="filter-btn col-md-3">
                        <button type="button"><?php esc_html_e('Submit', 'it-residence'); ?></button>
                    </div>
    			</div>
    		</form>
     	</div>
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
if ( !function_exists('get_itre_ajax_property') ) {
    function get_itre_ajax_property() {

         check_ajax_referer( 'itre_ajax_property', 'security' );

     	$type 		= $_POST['type'];
        $nonce      = $_POST['nonce'];
     	$beds 		= intval($_POST['beds']);
     	$minPrice	= intval($_POST['minPrice']);
     	$maxPrice	= intval($_POST['maxPrice']);
     	$minArea	= intval($_POST['minArea']);
     	$maxArea	= intval($_POST['maxArea']);

     	$price		= array($minPrice, $maxPrice);
     	$area		= [intval($_POST['minArea']), intval($_POST['maxArea'])];

     	$args = array(
     		'post_type'		=>	'property',
     		'posts_per_page'=>	-1
     	);

     	if ( !empty($type) ) {
     		$args['tax_query'] = array(
     			array(
     				'taxonomy'	=>	'property-type',
     				'field'		=>	'slug',
     				'terms'		=>	$type
     			)
     		);
     	}

     	if ( !empty($beds) ) {
     		$args['meta_query'][]	=	array(
     			'key'	=>	'bedrooms',
     			'value'	=>	$beds,
     			'type'	=>	'NUMERIC'
     		);
     	}

     	if ( !empty($minPrice) && !empty($maxPrice) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'price',
     			'value'		=>	$price,
     			'type'		=>	'numeric',
     			'compare'	=>	'BETWEEN'
     		);
     	}

     	if ( !empty($minPrice) && empty($maxPrice) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'price',
     			'value'		=>	$minPrice,
     			'type'		=>	'numeric',
     			'compare'	=>	'>='
     		);
     	}

     	if ( empty($minPrice) && !empty($maxPrice) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'price',
     			'value'		=>	$maxPrice,
     			'type'		=>	'numeric',
     			'compare'	=>	'<='
     		);
     	}

     	if ( !empty($minArea) && !empty($maxArea) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'area',
     			'value'		=>	$area,
     			'type'		=>	'numeric',
     			'compare'	=>	'BETWEEN'
     		);
     	}

     	if ( !empty($minArea) && empty($maxArea) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'area',
     			'value'		=>	$minArea,
     			'type'		=>	'numeric',
     			'compare'	=>	'>='
     		);
     	}

     	if ( empty($minArea) && !empty($maxArea) ) {
     		$args['meta_query'][]	=	array(
     			'key'		=>	'area',
     			'value'		=>	$maxArea,
     			'type'		=>	'numeric',
     			'compare'	=>	'<='
     		);
     	}

     	$prop_query = new WP_Query( $args );

     	// The Loop
     	if ( $prop_query->have_posts() ) :

     	echo '<div class="row">';
     	while ( $prop_query->have_posts() ) : $prop_query->the_post();

     	global $post;

     	get_template_part('template-parts/property-layouts/content', 'property', 'filter');

     	endwhile;
     	echo '</div>';
     	endif;

     	// Reset Post Data
     	wp_reset_postdata();

     	wp_die();
    }
}
 add_action('wp_ajax_itre_ajax_property', 'get_itre_ajax_property');
 add_action('wp_ajax_nopriv_itre_ajax_property', 'get_itre_ajax_property');

//Pass Variables to JS for use in AJAX
if ( !function_exists('itre_localize_ajax_data') ) {
    function itre_localize_ajax_data() {

         $data['nonce']     = wp_create_nonce('itre_ajax_property');
         $data['ajaxurl']    = admin_url('admin-ajax.php');
         wp_localize_script( 'itre-property-js', 'itre', $data );

    }
}
add_action('wp_enqueue_scripts', 'itre_localize_ajax_data', 20);

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
