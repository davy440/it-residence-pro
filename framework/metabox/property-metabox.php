<?php

/**
 *
 *	PHP file for the Metabox containing Property Details
 *
**/
if ( !function_exists('itlst_custom_meta') ) {
    function itlst_custom_meta() {
        add_meta_box( 'itre_prop_meta', __( 'Property Details', 'it-residence' ), 'itlst_meta_callback', 'property','normal','high' );
    }
    add_action( 'add_meta_boxes', 'itlst_custom_meta' );
}

/**
 * Outputs the content of the meta box
 */
if ( !function_exists('itlst_meta_callback') ) {
    function itlst_meta_callback( $post ) {
        wp_nonce_field( basename( __FILE__ ), 'itlst_nonce' );
        $itlst_stored_meta = get_post_meta( $post->ID );

        $agent	    =	isset( $itlst_stored_meta['agent']) ? $itlst_stored_meta['agent'][0] : 0;
        $for	    =	isset( $itlst_stored_meta['for']) ? $itlst_stored_meta['for'][0] : "sale";
        $price	    =	isset( $itlst_stored_meta['price']) ? $itlst_stored_meta['price'][0] : 0;
        $area	    =	isset( $itlst_stored_meta['area']) ? $itlst_stored_meta['area'][0] : 0;
        $bedrooms	=	isset( $itlst_stored_meta['bedrooms']) ? $itlst_stored_meta['bedrooms'][0] : 0;
        $bathrooms	=	isset( $itlst_stored_meta['bathrooms']) ? $itlst_stored_meta['bathrooms'][0] : 0;
        $streetName =   isset( $itlst_stored_meta['streetName']) ? $itlst_stored_meta['streetName'][0] : "";
        $city       =   isset( $itlst_stored_meta['city']) ? $itlst_stored_meta['city'][0] : "";
        $country    =   isset( $itlst_stored_meta['country']) ? $itlst_stored_meta['country'][0] : "";
        $zip        =   isset( $itlst_stored_meta['zip']) ? $itlst_stored_meta['zip'][0] : "";
        $maps       =   isset( $itlst_stored_meta['maps']) ? $itlst_stored_meta['maps'][0] : "";
        $location   =   isset( $itlst_stored_meta['location']) ? $itlst_stored_meta['location'][0] : "footer";
        $color      =   isset( $itlst_stored_meta['color']) ? $itlst_stored_meta['color'][0] : "default";
        $long		=	isset( $itlst_stored_meta['long']) ? $itlst_stored_meta['long'][0] : 0;
        $lat		=	isset( $itlst_stored_meta['lat']) ? $itlst_stored_meta['lat'][0] : 0;
        $zoom		=	isset( $itlst_stored_meta['zoom']) ? $itlst_stored_meta['zoom'][0] : 14;
        $labels		=	isset( $itlst_stored_meta['labels']) ? $itlst_stored_meta['labels'][0] : "";
        $controls	=	isset( $itlst_stored_meta['controls']) ? $itlst_stored_meta['controls'][0] : "";
        ?>
            
    	    <div class="itre-prop-metafields row">

                <div class="half-width">
                    <h4><?php _e('Agent', 'it-residence'); ?></h4>
                    <?php
                        $agents = get_posts(['post_type' => 'agent']);
                    ?>
                    <label for="agent">
                        <select id="agent" name="agent">
                            <option value="0"><?php _e('– Select –', 'it-residence'); ?></option>
                            <?php
                            if (!empty($agents)) {
                                foreach($agents as $current) {
                                    $id = $current->ID;
                                    $name = $current->post_title;
                                    printf('<option value="%s"%s>%s</option>', $id, selected($id, intval($agent)), esc_html($name));
                                }
                            }
                            ?>
                        </select>
                    </label>
                </div>

                <div class="half-width">
                    <h4> <?php _e('Status', 'it-residence'); ?></h4>

                    <input type="radio" id="sale" name="for" value="sale" <?php if ( isset( $itlst_stored_meta['for'][0] ) ) checked( $itlst_stored_meta['for'][0], "sale" ); ?>>
                    <label for="for" class="color-label"><?php _e("Sale", "it-residence"); ?></label>

                    <input type="radio" id="rent" name="for" value="rent" <?php if ( isset( $itlst_stored_meta['for'][0] ) ) checked( $itlst_stored_meta['for'][0], "rent" ); ?>>
                    <label for="rent" class="color-label"><?php _e("Rent", "it-residence"); ?></label>
                    
                    <input type="radio" id="sold" name="for" value="sold" <?php if ( isset( $itlst_stored_meta['for'][0] ) ) checked( $itlst_stored_meta['for'][0], "sold" ); ?>>
                    <label for="sold" class="color-label"><?php _e("Sold", "it-residence"); ?></label>
                    
                    <input type="radio" id="coming-soon" name="for" value="coming-soon" <?php if ( isset( $itlst_stored_meta['for'][0] ) ) checked( $itlst_stored_meta['for'][0], "coming-soon" ); ?>>
                    <label for="coming-soon" class="color-label"><?php _e("Coming Soon", "it-residence"); ?></label>

                </div>

                <div class="half-width">
    		    <label for="price">
    		    	<h4><?php _e('Price', 'it-residence'); ?></h4>
    		    	<input type="number" name="price" id="price" autocomplete="on" value="<?php echo esc_attr($price) ?>" placeholder="500000">
    		    </label><br/>
                </div>

                <div class="half-width">
    		     <label for="area">
    		    	<h4><?php _e('Area', 'it-residence'); ?></h4>
    		    	<input type="number" name="area" id="area" autocomplete="on" value="<?php echo esc_attr($area) ?>" placeholder="3000">
    		    </label><br/>
                </div>

                <div class="half-width">
    		    <label for="bedrooms">
    		    	<h4><?php _e('Bedrooms', 'it-residence'); ?></h4>
    		    	<input type="number" name="bedrooms" id="bedrooms" autocomplete="on" value="<?php echo esc_attr($bedrooms) ?>" placeholder="3">
    		    </label><br/>
                </div>

                <div class="half-width">
    		    <label for="bathrooms">
    		    	<h4><?php _e('Bathrooms', 'it-residence'); ?></h4>
    		    	<input type="number" name="bathrooms" id="bathrooms" autocomplete="on" value="<?php echo esc_attr($bathrooms) ?>" placeholder="2">
    		    </label><br/>
                </div>

                <div class="full-width">
                <h4><?php _e('Address', 'it-residence'); ?></h4>
                    <div class="address">
                        <label for="streetName">
                        <input type="text" name="streetName" id="streetName" autocomplete="on" value="<?php echo esc_attr($streetName); ?>" placeholder="123 Street Name">
                        </label>

                        <label for="city">
                        <input type="text" name="city" id="city" autocomplete="on" value="<?php echo esc_attr($city); ?>" placeholder="City">
                        </label>

                        <label for="province">
                            <select name="province" id="province" disabled>
                                <option value ="–" data-province="">Province</option>
                            </select>
                        </label>

                        <label for="country">
                        <?php
                            $countries = json_decode(file_get_contents( ITRE_PATH . 'assets/countries.json'));

                            $options = '';
                            foreach($countries as $item) {
                                $name = str_replace(' ', '_', $item->name);
                                $options .= "<option value={$item->code} data-country={$name} " . selected($country, $item->code, false) . ">{$name}</option>";
                            }   
                            printf('<select for="country" name="country" id="country"><option value="" data-country="" %s>%s</option>%s</select>', selected($country, $item->code), __('Select Country', 'it-residence'), $options);
                        ?>
                        </label>

                        <label for="zip">
                        <input type="text" name="zip" id="zip" autocomplete="on" value="<?php echo esc_attr($zip); ?>" placeholder="ZIP Code">
                        </label>
                    </div>

                    <div class="full-width">
        		    <label for="maps">
        		    	<h4><?php _e('Show Map', 'it-residence'); ?></h4>
        		    	<input type="checkbox" name="maps" id="maps" value="yes" <?php if ( isset( $maps ) ) checked( $maps, "yes" ); ?> />
        		    </label><br/>
                    </div>

                    <div id="map-controls" class="row">
                    <h3 class="full-width"><?php _e('Map Details', 'it-residence'); ?></h3>

                    <div class="half-width">
        		    <label for="location">
        		    	<h4><?php _e('Location of Map', 'it-residence'); ?></h4>
        		    	<select  name="location" id="location">
                            <option value="header" <?php selected( $location, 'header'); ?>><?php _e('Header', 'it-residence'); ?></option>
                            <option value="footer" <?php selected( $location, 'footer'); ?>><?php _e('Footer', 'it-residence'); ?></option>
                        </select>
        		    </label>
                    </div>

                    <div class="half-width">
                        <label for="color">
                            <h4><?php _e('Map Color', 'it-residence'); ?></h4>
                            <fieldset class="color-group">
                                <span>
                                    <input type="radio" id="default" name="color" value="default" <?php if ( isset( $itlst_stored_meta['color'][0] ) ) checked( $itlst_stored_meta['color'][0], 'default' ); ?>>
                                    <label for="for"><?php _e("Default", "it-residence"); ?></label>
                                </span>

                                <span>
                                    <input type="radio" id="default" name="color" value="blue" <?php if ( isset( $itlst_stored_meta['color'][0] ) ) checked( $itlst_stored_meta['color'][0], 'blue' ); ?>>
                                    <label for="for"><?php _e("Blue", "it-residence"); ?></label>
                                </span>

                                <span>
                                    <input type="radio" id="default" name="color" value="yellow" <?php if ( isset( $itlst_stored_meta['color'][0] ) ) checked( $itlst_stored_meta['color'][0], 'yellow' ); ?>>
                                    <label for="for"><?php _e("Yellow", "it-residence"); ?></label>
                                </span>

                                <span>
                                    <input type="radio" id="default" name="color" value="brown" <?php if ( isset( $itlst_stored_meta['color'][0] ) ) checked( $itlst_stored_meta['color'][0], 'brown' ); ?>>
                                    <label for="for"><?php _e("Brown", "it-residence"); ?></label>
                                </span>

                                <span>
                                    <input type="radio" id="default" name="color" value="green" <?php if ( isset( $itlst_stored_meta['color'][0] ) ) checked( $itlst_stored_meta['color'][0], 'green' ); ?>>
                                    <label for="for"><?php _e("Green", "it-residence"); ?></label>
                                </span>
                            </fieldset>
                    </div>

                    <div class="half-width">
        		    <label for="lat">
        		    	<h4><?php _e('Location Latitude', 'it-residence'); ?></h4>
        		    	<input type="number" name="lat" id="lat" step="0.001" value="<?php echo esc_attr($lat) ?>">
        		    </label>
                    </div>

                    <div class="half-width">
        		    <label for="long">
        		    	<h4><?php _e('Location Longitude', 'it-residence'); ?></h4>
        		    	<input type="number" name="long" id="long" step="0.001" value="<?php echo esc_attr($long) ?>">
        		    </label>
                    </div>

                    <p class="full-width">
                        <?php _e('<i>You can find longitude and latitude values of a location from Google Maps by just right clicking the location.</i>', 'it-residence') ?>
                    </p>

                    <div class="half-width">
        		    <label for="zoom">
        		    	<h4><?php _e('Zoom', 'it-residence'); ?></h4>
        		    	<input type="number" name="zoom" id="zoom" min="4" max="16" step="1" placeholder="<?php esc_attr_e('Any number between 4-16', 'it-residence') ?>" value="<?php echo esc_attr($zoom) ?>">
        		    </label>
                    <p><?php _e('Any integer between 4-16.<br></bt>More the value, more the zoom.', 'it-residence'); ?></p>
                    </div>

                    <div class="quarter-width">
        		    <label for="labels">
        		    	<h4><?php _e('Hide all Places except Marker', 'it-residence'); ?></h4>
        		    	<input type="checkbox" name="labels" id="labels" value="yes" <?php if ( isset( $labels ) ) checked( $labels, "yes" ); ?> />
        		    </label>
                    </div>

                    <div class="quarter-width">
        		    <label for="controls">
        		    	<h4><?php _e('Show Controls', 'it-residence'); ?></h4>
        		    	<input type="checkbox" name="controls" id="controls" value="yes" <?php if ( isset( $controls ) ) checked( $controls, "yes" ); ?> />
        		    </label>
                    </div>
                </div>

    	    </div>

            <script>
                jQuery(document).ready(function() {

                    var showMaps = jQuery("#itre_prop_meta #maps"),
                        mapControls = jQuery("#itre_prop_meta #map-controls");

                    const toggleMapControls = function(element = this ) {
                        jQuery( element ).is(':checked') ? mapControls.show() : mapControls.hide()
                    }

                    toggleMapControls( showMaps )
                    showMaps.on('input', function() {
                        toggleMapControls(this)
                    });
                });
            </script>
        <?php
    }
}


/**
 * Saves the custom meta input
 */
if ( !function_exists('itlst_meta_save') ) {
    function itlst_meta_save( $post_id ) {

        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'itlst_nonce' ] ) && wp_verify_nonce( $_POST[ 'itlst_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || !$is_valid_nonce ) {
            return;
        }

        $agent = isset($_POST['agent']) ? $_POST['agent'] : '';
    	update_post_meta( $post_id, 'agent', $agent);

        $for = isset($_POST['for']) ? $_POST['for'] : 'sale';
    	update_post_meta( $post_id, 'for', sanitize_text_field($for));

        // Checks for input and saves
        if ( isset($_POST['price'])) {
    	    update_post_meta( $post_id, 'price', absint($_POST['price']));
        } else {
    	    update_post_meta( $post_id, 'price', 0);
        }


        if ( isset($_POST['area'])) {
    	    $area	=   $_POST['area'];
        } else {
    	   $area	=	0;
        }
        update_post_meta( $post_id, 'area', $area);


        if ( isset($_POST['bedrooms'])) {
    	    update_post_meta( $post_id, 'bedrooms', absint($_POST['bedrooms']));
        } else {
    	    update_post_meta( $post_id, 'bedrooms', 0);
    	}


        if ( isset($_POST['bathrooms'])) {
    	    $bathrooms	=	absint($_POST['bathrooms']);
        } else {
    	    $bathrooms	=	0;
    	}
    	update_post_meta( $post_id, 'bathrooms', $bathrooms);

        $streetName = isset($_POST['streetName']) ? sanitize_text_field($_POST['streetName']) : '';
    	update_post_meta( $post_id, 'streetName', $streetName);
        
        $city = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';
    	update_post_meta( $post_id, 'city', $city);
    	
        $province = isset($_POST['province']) ? $_POST['province'] : '';
    	update_post_meta( $post_id, 'province', $province);

        $country = isset($_POST['country']) ? $_POST['country'] : '';
    	update_post_meta( $post_id, 'country', $country);

        $zip = $_POST['zip'] ?? '';
    	update_post_meta( $post_id, 'zip', $zip);

        if ( isset($_POST['long'])) {
    	    $long	=	sanitize_text_field($_POST['long']);
        } else {
    	    $long	=	0;
    	}
    	update_post_meta( $post_id, 'long', $long);

        


        if ( isset($_POST['maps'])) {
    	    $maps	=	sanitize_text_field($_POST['maps']);
        } else {
    	    $maps	=	"";
    	}
    	update_post_meta( $post_id, 'maps', $maps);


        if ( isset($_POST['location'])) {
    	    $location	=	sanitize_text_field($_POST['location']);
        } else {
    	    $location	=	"footer";
    	}
    	update_post_meta( $post_id, 'location', $location);


        if ( isset($_POST['color'])) {
    	    $color	=	sanitize_text_field($_POST['color']);
        } else {
    	    $color	=	"default";
    	}
    	update_post_meta( $post_id, 'color', $color);


        if ( isset($_POST['lat'])) {
    	    $lat	=	sanitize_text_field($_POST['lat']);
        } else {
    	    $lat	=	0;
    	}
    	update_post_meta( $post_id, 'lat', $lat);


        if ( isset($_POST['zoom']) ) {
    	    $zoom	=	sanitize_text_field($_POST['zoom']);
        } else {
    	    $zoom	=	12;
    	}
    	update_post_meta( $post_id, 'zoom', $zoom);


        if ( isset($_POST['labels'])) {
    	    $labels	=	sanitize_text_field($_POST['labels']);
        } else {
    	    $labels	=	"";
    	}
    	update_post_meta( $post_id, 'labels', $labels);

        if ( isset($_POST['controls'])) {
    	    $controls	=	sanitize_text_field($_POST['controls']);
        } else {
    	    $controls	=	"";
    	}
    	update_post_meta( $post_id, 'controls', $controls);
    }
    add_action( 'save_post', 'itlst_meta_save' );
}