<?php
/**
 * Template part for displaying default header
 */
?>
<div class="header-default">
    <div class="header-default-top">
        <div class="container">
            <div class="row align-items-center">
                <?php
                $has_menu = has_nav_menu( 'primary_menu' );
                if ( $has_menu ) {
                    ?>
                    <div class="col-3">
                        <?php get_template_part('elementor/templates/offcanvas/offcanvas'); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="d-flex <?php $cls = $has_menu? 'col-6 justify-content-center' : 'col-9';  echo esc_html($cls); ?>">
                    <?php
                    $logo = esc_url(rivax_get_option('site-logo', 'url'));
                    $logo_width = intval(rivax_get_option('site-logo-width'));
                    $logo_width = $logo_width? $logo_width : '';
                    if( $logo ) {
                        ?>
                        <a href="<?php echo home_url('/'); ?>"><img id="site-logo" width="<?php echo esc_html($logo_width); ?>" src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
                        <?php
                    }
                    else {
                        ?>
                        <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <?php get_template_part('elementor/templates/search/search'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ( $has_menu ) {
        ?>
        <div class="header-default-bottom">
            <div class="container">
                <nav class="rivax-header-nav-wrapper">
                <?php    // Menu
                wp_nav_menu( array(
                    'theme_location' => 'primary_menu',
                    'link_before' => '<span>',
                    'link_after'=>'</span>',
                    'fallback_cb' => false,
                    'container' => false,
                    'menu_class' => 'rivax-header-nav',
                ) );
                ?>
                </nav>
            </div>
        </div>
        <?php
    }
    ?>
</div>
