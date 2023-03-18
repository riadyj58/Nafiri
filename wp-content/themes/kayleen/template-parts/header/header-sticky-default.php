<?php
/**
 * Template part for displaying default sticky header
 */
?>
<div class="sticky-header-default">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-md-2">
                <?php
                $logo = esc_url(rivax_get_option('site-logo', 'url'));
                if( $logo ) {
                    ?>
                    <a href="<?php echo home_url('/'); ?>"><img id="site-sticky-logo" src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
                    <?php
                }
                else {
                    ?>
                    <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
                    <?php
                }
                ?>
            </div>
            <div class="col-6 col-md-10 d-flex justify-content-end">
                <?php get_template_part('elementor/templates/offcanvas/offcanvas'); ?>
                <?php    // Menu
                if ( has_nav_menu( 'primary_menu' ) ) {

                    echo '<nav class="rivax-header-nav-wrapper">';
                    wp_nav_menu( array(
                        'theme_location' => 'primary_menu',
                        'link_before' => '<span>',
                        'link_after'=>'</span>',
                        'fallback_cb' => false,
                        'container' => false,
                        'menu_class' => 'rivax-header-nav',
                    ) );
                    echo '</nav>';
                }

                ?>
            </div>
        </div>
    </div>
</div>
