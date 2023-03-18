<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$search_type = ( isset($settings['search_type']) && $settings['search_type'] == 'inline' )? 'inline' : 'popup';
?>
<?php if($search_type == 'popup'): ?>
<?php $style = ( !empty($settings['popup_style']) )? $settings['popup_style'] : 'style-1'; ?>
<div class="popup-search-wrapper <?php echo esc_html($style); ?>">
    <div class="popup-search-opener-wrapper">
        <span class="popup-search-opener"><i class="ri-search-2-line"></i></span>
    </div>
    <?php get_template_part("elementor/templates/search/popup-search-content"); ?>
</div>

<?php else: ?>
<div class="inline-search-form-wrapper">
    <form action="<?php echo home_url('/'); ?>" method="get" class="inline-search-form">
        <input type="text" name="s" value="" class="search-field" placeholder="<?php esc_html_e('Search ...', 'kayleen'); ?>" aria-label="Search" required>
        <button type="submit" class="submit" aria-label="Submit">
            <?php if($settings['inline_btn_title']): ?><span class="title"><?php echo esc_attr($settings['inline_btn_title']); ?></span><?php endif; ?>
            <?php if($settings['inline_show_icon'] == 'yes'): ?><i class="ri-search-2-line"></i><?php endif; ?>
        </button>
    </form>
</div>
<?php endif; ?>