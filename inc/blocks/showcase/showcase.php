<?php
/**
 * Showcase Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */

$title = $attributes['title'];
$sections = $attributes['sections'];
$align = $attributes['align'];
?>
<section class="itre-showcase section <?php echo esc_attr(IT_Listings::itlst_block_align( $align ) ) ?>">
    <?php
        if(!empty($title)) {
            printf( '<h2 class="section-top section-title">%s</h2>', esc_html( $title ) );
        }

        printf('<div class="itre-showcase__sections">');
            foreach($sections as $section) {
                printf('<div class="itre-showcase__section">');
                    $image = $section['mediaId'];
                    $section_title  = $section['sectionTitle'];
                    $section_desc   = $section['sectionDesc'];

                    if (!empty($image)) {
                        printf( '<figure>%s</figure>', wp_get_attachment_image( $image, 'large' ) );
                    }

                    if(!empty($section_title)) {
                        printf('<h3>%s</h3>', esc_html( $section_title ) );
                    }

                    if(!empty($section_desc)) {
                        printf('<p>%s</p>', esc_html( $section_desc ) );
                    }
                printf('</div>');
            }
        printf('</div>');
    ?>
</section>