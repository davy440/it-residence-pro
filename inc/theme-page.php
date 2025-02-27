<?php
/**
 *  Theme Page
 */

function itre_admin_theme_page() {
    add_theme_page('IT Residence Pro', 'IT Residence Pro', 'edit_theme_options', 'itre_options', 'itre_theme_info');
}
add_action('admin_menu', 'itre_admin_theme_page');

function itre_theme_info() {
    $url = admin_url('themes.php');
    $url = add_query_arg('page', 'demo-importer', $url);
    ?>
    <div id="itre-admin-theme-info">
        <h1 class="irew-theme-page-title"><?php _e('IT Residence Pro Options'); ?></h1>
        <div class="itre-support-plugins">
            <?php $plugins = [
                'it-listings' => 'IT Listings',
                'svg-support' => 'SVG Support',
                'ninja-forms' => 'Ninja Forms'
            ]; ?>
            <p><strong>To set up the theme, you'll need to install the following plugins -</strong></p>
            <form class="itre-support-plugins-form" method="post">
                <table class="itre-support-plugins-table">
                    <?php
                    foreach ($plugins as $slug => $title) {
                        printf('<tr><th>%s</th><td>%s</td></tr>', $title, ITRE_Plugin_Upgrader::itre_button_label($slug));
                    }?>
                    
                    <input class="process" type="hidden" name="process" value="" />
                    <input class="plugin" type="hidden" name="plugin" value="" />
                </table>
            </form>
            <?php
                if (is_plugin_active('it-listings/it-listings.php') && is_plugin_active('ninja-forms/ninja-forms.php')) {
                    printf('<div class="itre-demo-import">');
                    echo '<p>Plugins Installed! You are ready to start with your website! Create something awesome!</p>';
                    echo '<p>You can also import content from our pre-made demos.</p>';
                    printf( '<div class="itre-support-plugins__links"><a href="%s" class="itre-support-plugins__links--demos">Import Demo</a><button class="itre-support-plugins__links--nothanks">No Thanks!</button></div>', esc_url( $url ) );
                    printf('</div>');
                }
            ?>
        </div>

        <div class="sep"></div>

        <h2>
            <?php echo __('Pro Features', 'it-residence'); ?>
        </h2>
        <ul class="itre-pro-features">
            <li>Everything included in IT Residence</li>
            <li>
                <h3>More Header Layouts</h3>
                <p>IT Residence Provides more options to set Headers and Banners for your website.<br>
                    Go to Appearance > Customize.<br>
                    Go to Header > header Options<br>
                    Here, you can customize the Header of the theme.
                </p>
            </li>
            <li>More Custom Blocks</li>
            <li>More Typography Options</li>
            <li>More Typography Options</li>
            <li>More Color Options</li>
            <li>More Optimization Options</li>
            <li>Premium Support</li>
            <li>and much more!</li>
        </ul>

        <?php
        $customizer_url = admin_url('customize.php');
        printf('<a href="%s" class="button button-primary">%s</a>', esc_url( $customizer_url ), __('Go to Customizer', 'it-residence'));
        ?>

        <div class="sep"></div>

        <br>
        <br>
        <p>
            <?php printf('<h3>For Support, Suggestions and Queries, please use %s or mail us at support@indithemes.com. <b>We are here for you!</b></h3>', '<a href="https://indithemes.com/contact-us/" target="_blank" rel="help">this form</a>');
            ?>
        </p>
        <p>
            <?php printf('Using IT Residence and loving it? Consider leaving it a %s review at %s. It really means a lot!', '<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', '<a href="https://wordpress.org/themes/it-residence" rel="external" target="_blank">WordPress</a>');
            ?>
        </p>
    </div>
    <?php
}
