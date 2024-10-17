<?php
/**
 * Property Filter Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */
$filter = $attributes['filter'];
$type = $attributes['propType'] ?? '';
$location = $attributes['location'] ?? '';
$count = !empty($_GET['perPage']) ? intval($_GET['perPage']) : 9;
$sort = $_GET['sortBy'] ?? 'latest';

$section_class = ' all';
if ($filter !== 'all') {
    $term = empty($type) ? $location : $type;
    $section_class = " {$filter}-{$term}";
}
?>
<div class="itre-properties<?php echo $section_class ?>">
    <div class="itre-properties__form-wrapper">
        <form class="itre-properties__form" method="GET" action="<?php echo esc_url(get_pagenum_link()); ?>">
            <label for="perPage"><?php _e('Properties per page: ', 'it-residence'); ?></label>
            <select id="perPage" class="itre-properties__form--per-page" name="perPage">
                <option value="6"<?php selected($count, 6); ?>><?php _e(6, 'it-residence'); ?></option>
                <option value="9"<?php selected($count, 9); ?>><?php _e(9, 'it-residence'); ?></option>
                <option value="12"<?php selected($count, 12); ?>><?php _e(12, 'it-residence'); ?></option>
                <option value="15"<?php selected($count, 15); ?>><?php _e(15, 'it-residence'); ?></option>
                <option value="18"<?php selected($count, 18); ?>><?php _e(18, 'it-residence'); ?></option>
                <option value="21"<?php selected($count, 21); ?>><?php _e(21, 'it-residence'); ?></option>
                <option value="24"<?php selected($count, 24); ?>><?php _e(24, 'it-residence'); ?></option>
            </select>

            <select id="sortBy" name="sortBy">
                <option value="latest" <?php selected($sort, "latest"); ?>><?php _e('Recently Added', 'it-residence'); ?></option>
                <option value="priceUp" <?php selected($sort, "priceUp"); ?>><?php _e('Price (Low to High)', 'it-residence'); ?></option>
                <option value="priceDown" <?php selected($sort, "priceDown"); ?>><?php _e('Price (High to Low)', 'it-residence'); ?></option>
                <option value="areaUp" <?php selected($sort, "areaUp"); ?>><?php _e('Area (Low to High)', 'it-residence'); ?></option>
                <option value="areaDown" <?php selected($sort, "areaDown"); ?>><?php _e('Area (High to Low)', 'it-residence'); ?></option>
            </select>
        </form>
    </div>
<?php
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

    $args = array(
        'post_type'         => 'property',
        'posts_per_page'    =>  $count,
        'paged'             =>  $paged
    );

    if ($filter === 'type' && !empty($type)) {
        $args['tax_query'][] = array(
            'taxonomy'  =>  'property-type',
            'field'     =>  'slug',
            'terms'     =>  $type
        );
    }

    if ($filter === 'location' && !empty($location)) {
        $args['tax_query'][] = array(
            'taxonomy'  =>  'location',
            'field'     =>  'slug',
            'terms'     =>  $location
        );
    }

    if ($sort === 'priceUp') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    }

    if ($sort === 'priceDown') {
        $args['meta_key'] = 'price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }

    if ($sort === 'areaUp') {
        $args['meta_key'] = 'area';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    }

    if ($sort === 'areaDown') {
        $args['meta_key'] = 'area';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }

    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) :
    echo '<div class="itre-properties__wrapper">';
        while ( $the_query->have_posts() ) : $the_query->the_post();
            global $post;
            get_template_part('template-parts/property-layouts/content', 'property');
        endwhile;
    echo '</div>';
        ?>

    <div class="itre-pagination">
        <div class="nav-links">
        <?php
        $big = 999999999;
        echo paginate_links(  array(
            'before_page_number'	=>	'<span>',
            'after_page_number'		=>	'</span>',
            'prev_text'				=> '<span class="arrow-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
            'next_text'				=> '<span class="arrow-next"><i class="fa fa-angle-right" aria-hidden="true"></i></span></i>',
            'base'                  => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'                => '?paged=%#%',
            'current'               => max( 1, get_query_var('paged') ),
            'total'                 => $the_query->max_num_pages,
            'show_all'              =>  true
        ) );
        ?>
        </div>
    </div>

    <?php
    endif;

    // Reset Post Data
    wp_reset_postdata();
?>
</div>