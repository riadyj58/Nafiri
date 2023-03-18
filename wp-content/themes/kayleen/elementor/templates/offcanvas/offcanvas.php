<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$offcanvas_position = ( isset($settings['content_position']) && $settings['content_position'] == 'left' )? 'position-left' : 'position-right';

?>
<div class="rivax-offcanvas">
    <div class="offcanvas-opener-wrapper">
        <span class="offcanvas-opener">
            <span class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </span>
    </div>
    <div class="offcanvas-wrapper <?php echo esc_html($offcanvas_position); ?>">
        <div class="offcanvas-container">
            <div class="offcanvas-container-inner">
                <span class="offcanvas-closer"></span>
                <div class="offcanvas-content">
                    <?php
                    $template_id = !empty($settings['content_template'])? $settings['content_template'] : 0;
                    if($template_id) {
                        echo rivax_get_display_elementor_content($template_id);
                    }
                    else {
                        get_template_part('elementor/templates/offcanvas/offcanvas-default');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
