<?php
/**
 * Template part for displaying footer mobile menu
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( has_nav_menu( 'mobile_menu' ) ) {
?>
    <div class="footer-canvas-menu-wrapper">
        <div class="footer-canvas-menu-bg"></div>
        <div class="footer-canvas-menu">
            <nav class="header-vertical-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'mobile_menu',
                    'link_before' => '<span>',
                    'link_after'=>'</span>',
                    'fallback_cb' => false,
                    'container' => false
                ) );
                ?>
            </nav>
        </div>
        <div class="footer-canvas-menu-btn-container">
            <div class="footer-canvas-menu-btn">
                <div class="inner">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
    </div>
<?php
}