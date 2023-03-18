<?php
/**
 * Template part for displaying sidebar content
 */
?>
<div class="sidebar-container-inner">
    <?php
    $template_id = rivax_get_layout_template_id('sidebar');


    $sidebar = rivax_get_display_elementor_content($template_id);
    if($sidebar) {
        echo apply_filters('rivax_print_sidebar_template', $sidebar);
    }
    elseif( is_active_sidebar( 'rivax_sidebar_widgets' ) ) {
        dynamic_sidebar( 'rivax_sidebar_widgets' );
    }

    ?>
</div>