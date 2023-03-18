<?php
/**
 * Template part for displaying single post Standard hero content - Layout 16
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-16-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-16-shadow'))? ' shadow' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-16-meta');
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

$bg = rivax_get_option('single-format-standard-layout-16-bg')? : '';
$bg = $bg? '--layout-bg: ' . $bg . ';' : '';

?>
<div class="single-hero-layout-16" style="<?php echo esc_html($bg); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <div class="image-container<?php echo esc_html($cls); ?>">
                    <?php the_post_thumbnail('rivax-small-square', array( 'title' => get_the_title() )); ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="content-container">
                    <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
                </div>
            </div>
        </div>
    </div>
</div>

