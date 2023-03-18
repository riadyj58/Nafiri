<?php
/**
 * Template part for displaying single post Standard hero content - Layout 13
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-13-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-13-shadow'))? ' shadow' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-13-meta');
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

$bg = rivax_get_option('single-format-standard-layout-13-bg')? : '';
$bg = $bg? '--layout-bg: ' . $bg . ';' : '';
$color = rivax_get_option('single-format-standard-layout-13-color')? : '';
$color = $color? '--layout-color: ' . $color . ';' : '';

?>
<div class="single-hero-layout-13" style="<?php echo esc_html($bg) . esc_html($color); ?>">
    <span class="layout-13-bg"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="content-container">
                    <?php get_template_part('template-parts/post/hero/title-section-2', '', $meta_args); ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="image-container<?php echo esc_html($cls); ?>">
                    <?php the_post_thumbnail('rivax-large', array( 'title' => get_the_title() )); ?>
                </div>
            </div>
        </div>
    </div>
</div>

