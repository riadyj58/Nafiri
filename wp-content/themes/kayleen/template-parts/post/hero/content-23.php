<?php
/**
 * Template part for displaying single post Standard hero content - Layout 23
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-23-title-bg'))? ' title-bg' : '';
$cls .= (rivax_get_option('single-format-standard-layout-23-title-center'))? ' title-center' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-23-meta');
$meta_args = array(
    'category' => $post_layout_meta['category'],
    'author-name' => $post_layout_meta['author-name'],
    'author-avatar' => $post_layout_meta['author-avatar'],
    'date' => $post_layout_meta['date'],
    'reading-time' => $post_layout_meta['reading-time'],
    'views' => $post_layout_meta['views'],
    'comments' => $post_layout_meta['comments'],
    'excerpt' => $post_layout_meta['excerpt'],
);

?>
<div class="single-hero-layout-23">
    <div class="single-hero-layout-23-container<?php echo esc_html($cls); ?>" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(NULL, 'full')); ?>);">
        <div class="single-hero-layout-23-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-container">
                        <?php get_template_part('template-parts/post/hero/title-section-2', '', $meta_args); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

