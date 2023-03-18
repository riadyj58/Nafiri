<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$link_text =esc_attr( $settings['link_text']);

$this->add_link_attributes( 'link_url', $settings['link_url'] );
$this->add_render_attribute('link_url', 'class', "rivax-link--" . $settings['animation_style'], true);
$this->add_render_attribute('link_url', 'data-text', $link_text, true);

?>
<div class="rivax-creative-link">
    <a <?php $this->print_render_attribute_string( 'link_url' ); ?>>
        <span><?php echo esc_attr($link_text); ?></span>
    </a>
</div>

