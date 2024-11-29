<?php
/**
 *  Default Header
 */
$header = $args ?? 'default';
 ?>

 <header id="masthead" class="site-header default">

    <?php itre_get_top_bar(); ?>

    <div class="itre-header-content">
    <?php
        itre_hero_area();
        var_dump($header);
        itre_header_setting($header);
    ?>
    </div>
 </header><!-- #masthead -->
