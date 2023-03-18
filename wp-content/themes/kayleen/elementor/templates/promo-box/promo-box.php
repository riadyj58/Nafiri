<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="rivax-promo-box">
    <figure class="<?php echo esc_attr($settings['promo_effect']); ?>">
        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'promo_image_size', 'promo_image' ); ?>
        <figcaption>
            <div>
                <?php if (!empty($settings['promo_heading'])) : ?>
                    <div class="promo-title"><span><?php echo esc_attr($settings['promo_heading']); ?></span></div>
                <?php endif; ?>

                <?php echo wp_kses_post(wpautop($settings['promo_content'])); ?>
            </div>
            <?php
            if ( ! empty( $settings['promo_link']['url'] ) ) {
                $this->add_link_attributes( 'promo_link', $settings['promo_link'] );

                echo '<a ';
                $this->print_render_attribute_string( 'promo_link' );
                echo '></a>';
            }
            ?>
        </figcaption>
    </figure>
</div>