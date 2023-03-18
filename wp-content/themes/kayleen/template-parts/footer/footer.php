<?php
/**
 * Template part for displaying footer
 */
?>
<footer id="site-footer">
    <?php
    // Singular Custom Footer
    $footer_id = rivax_get_layout_template_id('footer');
    $footer = rivax_get_display_elementor_content($footer_id);

    if($footer) {
        echo apply_filters('rivax_print_footer_template', $footer);
    }
    elseif( is_active_sidebar( 'rivax_footer_widgets' ) ) {
        ?>
        <div class="container">
            <?php dynamic_sidebar( 'rivax_footer_widgets' ); ?>
        </div>
        <?php
    }
    else { // Default Footer
        get_template_part("template-parts/footer/footer-default");
    }
    ?>
</footer>
