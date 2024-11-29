<?php
/**
 *  Default Header
 * 
 * @package IT_Residence_Pro
 */
 ?>
<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package IT_Residence
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'it-residence' ); ?></a>

	<header id="masthead" class="site-header header-widget">
        
            <?php
            itre_get_top_bar();
            ?>
            
        <div class="header-widget-area-wrapper">
            <div class="container">
            <?php
                itre_hero_area();
                if ( is_active_sidebar( 'header' ) ) :
                    echo '<div class="header-widget-area">';
                    dynamic_sidebar( 'header');
                    echo '</div>';
                endif;
            ?>
            </div>
            
            <?php
                $setting = !empty(is_front_page()) ? get_theme_mod('itre_front_header_layout', 'default') : 'default';
                itre_header_setting($setting);
            ?>
            </div>
        </div>
    </header><!-- #masthead -->
	<div id="content">