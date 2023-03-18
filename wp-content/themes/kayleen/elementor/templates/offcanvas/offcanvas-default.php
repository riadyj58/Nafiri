<?php
/**
 * Template part for displaying default offcanvas content
 */
?>
<div class="offcanvas-default">
    <div class="container">
        <?php    // Menu
        if ( has_nav_menu( 'primary_menu' ) ) {

            echo '<nav class="header-vertical-nav">';
            wp_nav_menu( array(
                'theme_location' => 'primary_menu',
                'link_before' => '<span>',
                'link_after'=>'</span>',
                'fallback_cb' => false,
                'container' => false
            ) );
            echo '</nav>';
        }
        ?>
    </div>
</div>
