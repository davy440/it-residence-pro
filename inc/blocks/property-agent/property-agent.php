<?php
/**
 * Walk Score Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
 */
$post_id = $block->context['postId'];
$agent = get_post_meta($post_id, 'agent', true);

if (empty($agent)) {
    return;
}

$align = $attributes['align'] ?? '';
$thumb = get_post_thumbnail_id($agent);
$name = get_the_title($agent);
$about = get_post_meta($agent, 'about', true);
$designation = get_post_meta($agent, 'designation', true);
$phone = get_post_meta($agent, 'phone', true);
$mail = get_post_meta($agent, 'mail', true);
?>
<section class="itre-property-agent <?php if (!empty($align)) echo "align{$align}"; ?>">
    <div class="itre-property-agent__meta">
    <?php
    if (!empty($thumb)) {
        printf('<figure>%s</figure>', wp_get_attachment_image($thumb, 'large'));
    }
    
    echo '<div class="itre-property-agent__info">';
    if (!empty($name)) {
        printf('<h3 class="itre-property-agent__name">%s</h3>', $name);
    }

    if (!empty($phone)) {
        printf('<p class="itre-property-agent__phone"><a href="tel:%1$s" title="%1$s"><i class="fa fa-phone"></i>%2$s</a></p>', esc_attr($phone), esc_html($phone));
    }

    if (!empty($mail)) {
        printf('<p class="itre-property-agent__mail"><a href="mailto:%1$s" title="%1$s"><i class="fa fa-envelope"></i>%2$s</a></p>', esc_attr($mail), esc_html($mail));
    }

    echo '</div></div>';
    
    if (!empty($about)) {
        printf('<p class="itre-property-agent__about">%s</p>', $about);
    }
    ?>
</section>