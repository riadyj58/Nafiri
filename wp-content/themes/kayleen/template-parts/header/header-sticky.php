<?php
/**
 * Template part for displaying sticky header
 */
?>
<?php if(rivax_get_option('sticky-header-status')): ?>
<header id="site-sticky-header">
    <?php
    // Singular Custom Header
    $header_id = rivax_get_layout_template_id('sticky_header');
    $header = rivax_get_display_elementor_content($header_id);

    if($header) {
        echo apply_filters('rivax_print_sticky_header_template', $header);
    }
    else { // Default header
        get_template_part('template-parts/header/header-sticky-default');
    }
    ?>
</header>
<?php endif; ?>