<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="rivax-social-icons">
<?php

$icons_class = array(
    'facebook'      => "ri-facebook-fill",
    'twitter'      => "ri-twitter-fill",
    'linkedin'      => "ri-linkedin-fill",
    'whatsapp'      => "ri-whatsapp-line",
    'instagram'      => "ri-instagram-line",
    'pinterest'      => "ri-pinterest-fill",
    'dribbble'      => "ri-dribbble-line",
    'telegram'      => "ri-telegram-fill",
    'youtube'      => "ri-youtube-fill",
    'github'      => "ri-github-fill",

);

foreach (  $settings['social_media_items'] as $social_media_item ) {

    if(!$social_media_item['social_media'])
        continue;
    ?>
    <div class="social-item <?php echo esc_html($social_media_item['social_media']); ?>">
        <div class="social-icon">
            <span class="icon"><i class="<?php echo esc_html($icons_class[$social_media_item['social_media']]); ?>"></i></span>
        </div>
        <?php if($social_media_item['social_title'] || $social_media_item['social_subtitle']): ?>
        <div class="social-content">
		    <?php if($social_media_item['social_title']): ?>
            <div class="social-title"><span class="title"><?php echo esc_html($social_media_item['social_title']); ?></span></div>
		    <?php endif; ?>
			<?php if($social_media_item['social_subtitle']): ?>
            <div class="social-subtitle"><span class="subtitle"><?php echo esc_html($social_media_item['social_subtitle']); ?></span></div>
			<?php endif; ?>
        </div>
        <?php endif; ?>
        <a class="rivax-position-cover" href="<?php echo esc_url($social_media_item['social_link']) ?>" title="<?php echo esc_html(ucfirst($social_media_item['social_media'])) ?>" <?php if( $settings['open_link_new_tab'] ) echo 'target="_blank"'; ?>></a>
    </div>
    <?php
}
?>
</div>
