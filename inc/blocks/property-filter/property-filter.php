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
?>
<section class="itre-ptoperty-filter">
    <div class="itre-property-filter-wrapper container">
        <div class="itre-property-filter">
            <form id="itre-property-filter-form" method="post">
                <div class="row align-items-center">
                    <div class="filter-fields col-md-9">
                        <div class="row">
                            <?php if (in_array('type', $filters)) {
                                echo '<div class="itre-type form-control-wrapper col-md-4">';
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
                                    <?php } ?>
                                </select>
                                <?php
                                echo '</div>';
                            }

                            if (in_array('area', $filters)) {
                            ?>
                                <div class="itre-min-area form-control-wrapper col-md-4">
                                    <input class="form-control-min-area" type="number" name="min-area" id="min-area" placeholder="<?php esc_attr_e("Min Area", 'it-residence'); ?>" autocomplete="off" value="" />
                                </div>

                                <div class="itre-max-area form-control-wrapper col-md-4">
                                    <input class="form-control-max-area" type="number" name="max-area" id="max-area" placeholder="<?php esc_attr_e('Max Area', 'it-residence'); ?>" autocomplete="off" value="" />
                                </div>
                            <?php } ?>

                            <?php
                            if (in_array('bedrooms', $filters)) { ?>
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
                            <?php
                            }

                            if (in_array('price', $filters)) {
                            ?>
                            <div class="itre-min-price form-control-wrapper col-md-4">
                                <input class="form-control-min-price" type="number" name="min-price" id="min-price" placeholder="<?php esc_attr_e('Min Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>

                            <div class="itre-max-price form-control-wrapper col-md-4">
                                <input class="form-control-max-area" type="number" name="max-price" id="max-price" placeholder="<?php esc_attr_e('Max Price', 'it-residence'); ?>" autocomplete="off" value="" />
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="filter-btn col-md-3">
                        <input type="submit" value="<?php esc_html_e('Submit', 'it-residence'); ?>"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
</section>