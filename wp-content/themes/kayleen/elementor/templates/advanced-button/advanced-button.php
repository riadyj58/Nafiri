<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$button_text = esc_attr($settings['button_text']);

$this->add_link_attributes( 'button', $settings['button_url'] );
$this->add_render_attribute('button', 'class', "rivax-advanced-button style-" . $settings['button_style']);

if($settings['button_icon'] != 'none') {
    $this->add_render_attribute('button', 'class', "icon-" . $settings['icon_position']);
}

if($settings['button_style'] == '1') {
    $this->add_render_attribute('button', 'class', "shape-" . $settings['button_shape_position']);
}

?>
<div class="rivax-advanced-button-wrapper">
    <a <?php $this->print_render_attribute_string( 'button' ); ?>>
        <span class="title"><?php echo esc_attr($button_text); ?></span>
        <?php if($settings['button_icon'] != 'none'): ?>
        <i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
        <?php endif; ?>
    </a>
</div>

