<?php
/**
 *  Default Header
 */
 ?>

 <header id="masthead" class="site-header default">

    <?php itre_get_top_bar(); ?>

    <div id="header-image">
        <?php
            require_once ITRE_PATH . 'framework/sections/header/modules/header-image.php';
        ?>
        <?php itre_hero_area(); ?>
    </div>

 </header><!-- #masthead -->
