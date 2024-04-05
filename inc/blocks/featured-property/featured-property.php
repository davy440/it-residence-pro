<?php
/**
 * Featured Property Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */

$property = $attributes['property'];
$align = $attributes['align'];

if (empty($property)) {
    return;
}

$img = get_the_post_thumbnail($property);
$title = get_the_title($property);
$price = get_post_meta($property, 'price', true);
$bedrooms = get_post_meta($property, 'bedrooms', true);
$bathrooms = get_post_meta($property, 'bathrooms', true);
$area = get_post_meta($property, 'area', true);
?>
<section class="itre-featured-property section <?php echo esc_attr(IT_Listings::itlst_block_align( $align ) ) ?>">
    <?php
    if (!empty($img)) {
        echo $img;
    }
    ?>
    <div class="itre-featured-property__info">
        <?php
        if (!empty($price)) {
            printf('<div class="itre-featured-property__price">');
                $cost = new NumberFormatter( $locale = 'en_US', NumberFormatter::CURRENCY );
                $cost->setTextAttribute( NumberFormatter::CURRENCY_CODE, 'USD');
                $cost->setAttribute( NumberFormatter::MAX_FRACTION_DIGITS, 0);

                printf('<span>%s</span>', $cost->format($price));
                printf('</div>');
            }
            
            if (!empty($title)) {
                printf('<h2 class="itre-featured-property__title">%s</h2>', esc_html( $title ) );
            }
        ?>
        <div class="itre-featured-property__features">
            <?php
            if ( !empty($bedrooms) ) {
                printf( '<span class="itre_bed"><i class="fa fa-bed" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $bedrooms );
            }

            if ( !empty($bathrooms) ) {
                printf( '<span class="itre_shower"><i class="fa fa-shower" aria-hidden="true"></i><span class="itre_bed_count">%u</span></span>', $bathrooms );
            }

            if ( !empty($area) ) {
                printf( '<span class="itre_area"><i class="fa fa-area-chart" aria-hidden="true"></i><span class="itre_area">%u</span></span>', $area );
            }
            ?>
        </div>

        <div class="itre-featured-property__excerpt">
            <?php itre_get_blog_excerpt( $property, 30 ); ?>
        </div>

        <?php
            printf('<div class="itre-featured-property__link"><a href="%s">%s</a></div>', get_post_permalink( $property ), __( 'Find Out More', 'it-listings' ) );
        ?>
    </div>
</section>

