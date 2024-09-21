<?php
/**
 * Property Filter Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */
$filters = $attributes['filterby'];
$count = $attributes['count'];
$id = $attributes['blockId'];
$id = str_replace('-', '_', $id);
?>
<section id="<?php echo esc_attr($id); ?>" class="itre-property-filter-wrapper">
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
                                <?php foreach($locations_list as $key => $value) {
                                    printf('<option value="%s">%s</option>', esc_attr($key), esc_html($value));
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

    <div class="itre-property-listing section">
     		<?php
     		$args = array(
     			'post_type'         => 'property',
                'post_status'       => 'publish',
     			'posts_per_page'	=> 9
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
</section>
<?php
$data[] = $id;
wp_localize_script('itre-property-filter-front-js', 'filterIDs', $data);

if (!empty($attributes['style'])) {
    $css = "#{$id} {";
    if (!empty($attributes['style']['spacing']['margin']['top'])) {
        $marginTop = $attributes['style']['spacing']['margin']['top'];
        $css .= "margin-top: {$marginTop};";
    }
    if (!empty($attributes['style']['spacing']['margin']['bottom'])) {
        $marginBottom = $attributes['style']['spacing']['margin']['bottom'];
        $css .= "margin-bottom: {$marginBottom}";
    }
    $css .= '}';
    wp_add_inline_style('itre-property-filter-css', $css);
}
