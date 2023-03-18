<?php
/**
 * Template part for displaying single post Standard hero content - Layout 22
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-22-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-22-shadow'))? ' shadow' : '';
$cls .= (rivax_get_option('single-format-standard-layout-22-title-bg'))? ' title-bg' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-22-meta');
$meta_args = array(
    'category' => $post_layout_meta['category'],
    'author-name' => $post_layout_meta['author-name'],
    'author-avatar' => $post_layout_meta['author-avatar'],
    'date' => $post_layout_meta['date'],
    'reading-time' => $post_layout_meta['reading-time'],
    'views' => false,
    'comments' => false,
    'excerpt' => $post_layout_meta['excerpt'],
);

?>
<div class="single-hero-layout-22">
    <div class="single-hero-layout-22-container<?php echo esc_html($cls); ?>" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(NULL, 'rivax-large')); ?>);">
        <div class="single-hero-layout-22-overlay"></div>
        <div class="content-container">
            <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>

            <?php if($post_layout_meta['comments'] || $post_layout_meta['views']): ?>
                <div class="top-container">
                    <?php if( $post_layout_meta['views'] ): ?>
                        <div class="views" title="<?php esc_html_e('Views', 'kayleen'); ?>">
                            <i class="ri-fire-line"></i>
                            <span class="count"><?php echo rivax_get_post_views(get_the_ID()); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if( $post_layout_meta['comments'] ): ?>
                        <div class="comments" title="<?php esc_html_e('comments', 'kayleen'); ?>">
                            <a href="#comments">
                                <?php $comments_count = get_comments_number(); ?>
                                <i class="ri-chat-1-line"></i>
                                <span class="count"><?php echo esc_html($comments_count); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

