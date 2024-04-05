<?php
/**
 * Featured Property Types Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */

$taxonomy = $attributes['taxonomy'];

if (empty($taxonomy)) {
    return;
}

$all = $attributes['all'];
$title = $attributes['title'];
$align = $attributes['align'];
$terms = $taxonomy == 'location' ? $attributes['locations'] : $attributes['types'];
$terms = array_map('intval', $terms);

$contents = [];

foreach($terms as $index => $term) {
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => 4,
        'ignore_sticky_posts' => true,
        'tax_query' => array(
            array(
                'taxonomy'  =>  $taxonomy,
                'field'     =>  'term_id',
                'terms'     =>  $term
            )
        )
    );
    
    $posts = get_posts($args);
    $contents[$index]['term']    = $term;
    $contents[$index]['posts']  = $posts;
}

?>
<section class="itre-featured-tabs section <?php echo esc_attr(IT_Listings::itlst_block_align( $align ) ) ?>">
    <?php
        if (!empty($title)) {
            printf( '<h2 class="itre-featured-tabs__title section-title">%s</h2>', esc_html( $title ) );
        }

        if (!empty($terms)) {
            printf('<div class="itre-featured-tabs__tab-titles">');

            if (!empty($all)) {
                printf( '<span class="itre-featured-tabs__tab is-active" tabindex="0" data-content="All">%s</span>', __( 'All', 'it-listings' ) );
            }

            foreach($contents as $index => $value) {

                if (count($value['posts']) == 0) {
                    continue;
                }
                
                $active = empty( $all ) && $index == 0 ? ' is-active' : '';
                printf('<span class="itre-featured-tabs__tab%s" tabindex="0" data-content="%s">%s</span>', esc_attr( $active ), esc_attr( get_term( $value['term'] )->name ), esc_html( get_term( $value['term'] )->name ) );
            }
            printf('</div>');

            printf('<div class="itre-featured-tabs__tab-content">');
            
            if (!empty($all)) {
                $args = array(
                    'post_type' => 'property',
                    'posts_per_page' => 4,
                    'ignore_sticky_posts' => true
                );

                $posts = get_posts( $args );
                
                if (!empty($posts)) {
                    printf('<div class="itre-featured-tabs__posts" data-tab="All">');
                        foreach($posts as $post) {
                            IT_Listings::itlst_featured_properties( $post );
                        }
                    printf('</div>');
                }
            }

            foreach($contents as $index => $value) {

                if (count($value['posts']) == 0) {
                    continue;
                }

                printf('<div class="itre-featured-tabs__posts" data-tab="%s">', esc_attr( get_term( $value['term'] )->name ) );
                    if (!empty($value['posts'])) {
                        foreach( $value['posts'] as $post ) {
                            IT_Listings::itlst_featured_properties( $post );
                        }
                    }
                printf('</div>');
                
            }
                
            printf('</div>');
        }
    ?>
</section>