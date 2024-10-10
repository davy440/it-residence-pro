<?php
/**
 *  Enqueue scripts and styles in admin area
 */

function itre_enqueue_admin_scripts() {
    global $pagenow;
    wp_enqueue_style( 'itre-admin-style', esc_url( get_template_directory_uri() . '/assets/theme-styles/css/admin.css' ), array(), ITRE_VERSION );
    if (get_post_type() === 'property' && $pagenow === 'post.php') {
        wp_enqueue_script('itre-admin-js', esc_url( get_template_directory_uri() . '/assets/js/admin.js' ), array('jquery'), ITRE_VERSION, true );
        
        $data = [];
        $data['themePath']  = ITRE_PATH;
        $data['province']   = get_post_meta(get_the_ID(), 'province', true);

        wp_localize_script('itre-admin-js', 'itreAdmin', $data);
    }
}
add_action('admin_enqueue_scripts', 'itre_enqueue_admin_scripts');

function itre_load_module($tag, $handle) {

    if (!is_admin()) {
        return $tag;
    }

    if ($handle === 'itre-admin-js') {
        $tag = str_replace('<script ', '<script type="module" ', $tag);
;    }
    return $tag;
}
add_filter('script_loader_tag', 'itre_load_module', 10, 2);

function itre_customize_controls_enqueue_scripts() {
    wp_enqueue_script('itre-customize-controls-js', esc_url( get_template_directory_uri() . '/assets/js/customize_controls.js' ), array('jquery'), ITRE_VERSION, true );
    wp_enqueue_script("itre-typography-js", esc_url(get_template_directory_uri() . "/assets/js/typography.js"), array(), ITRE_VERSION, true );
}
add_action('customize_controls_enqueue_scripts', 'itre_customize_controls_enqueue_scripts');
