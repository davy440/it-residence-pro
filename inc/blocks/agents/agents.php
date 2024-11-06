<?php
/**
 * Agents Block.
 * 
 * @param   array   $attributes     The block attributes.
 * @param   string  $content        The block default content.
 * @param   object  $block          WP_Block - The block instance.
**/

$title = $attributes['title'];
$description = $attributes['description'];
$agents = $attributes['agents'];
$align = $attributes['align'];
?>
<section class="itre-agents section <?php echo esc_attr(IT_Listings::itlst_block_align( $align ) ) ?>">
    <?php
        if (!empty($title)) {
            printf( '<h2 class="itre-agents__title section-title">%s</h2>', esc_html( $title ) );
        }

        if (!empty($description)) {
            printf( '<p class="itre-agents__description section-sub">%s</p>', esc_html( $description ) );
        }

        printf('<div class="itre-agents__agents">');
        foreach($agents as $agent) {
            $agent_id = $agent['agentId'];
            $role = $agent['role'];
            $phone = $agent['phone'];
            $mail = $agent['mail'];
            if (!empty($agent_id)) {
                printf('<div class="itre-agents__agent">');
                printf('<figure>%s</figure>', wp_get_attachment_image(get_post_thumbnail_id($agent_id), 'full'));

                printf('<div class="itre-agents__agent-details">');
                printf('<h3 class="itre-agents__agent-name">%s</h3>', get_the_title($agent_id));
                if (!empty($role)) {
                    printf('<p class="itre-agents__agent-role"><span>%s</span></p>', esc_html($role));
                }
                printf('<p class="itre-agents__agent-description">%s</p>', get_the_excerpt($agent_id));
                
                printf('<div class="itre-agents__agent-links">');
                    if (!empty($phone)) {
                        printf('<span class="itre-agents__agent-phone"><a href="tel:%s"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-phone fa-stack-1x fa-inverse"></i></span><span class="phone">%s</span></a></span>', esc_attr($phone), esc_html($phone));
                    }
                    if (!empty($mail)) {
                        printf('<span class="itre-agents__agent-mail"><a href="mailto:%s"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span><span class="mail">%s</span></a></span>', esc_attr($mail), esc_html($mail));
                    }
                printf('</div></div></div>');
            }
        }
        printf('</div>');
    ?>
</section>