
<<?php echo esc_attr($settings['title_tag']); ?> class="rivax-advanced-heading-tag">
<span class="rivax-advanced-heading-wrap" data-background-text="<?php echo esc_attr( $settings['background_text']); ?>">
    <span class="rivax-advanced-heading-one"><?php echo esc_attr( $settings[ 'heading_one' ]) ; ?></span>
    <span class="rivax-advanced-heading-two"><?php echo  esc_attr($settings[ 'heading_two' ]) ; ?></span>
    <span class="rivax-advanced-heading-three"><?php echo  esc_attr($settings[ 'heading_three' ]) ; ?></span>
    <span class="rivax-advanced-heading-border"></span>
</span>
<?php
if ( ! empty( $settings['link']['url'] ) ) {
    $this->add_link_attributes( 'link', $settings['link'] );
    $this->add_render_attribute('link', 'class', "rivax-advanced-heading-link");

    echo '<a ';
    $this->print_render_attribute_string( 'link' );
    echo '></a>';
}
?>
</<?php echo esc_attr($settings['title_tag']); ?>>