<?php
/**
 * Template part for displaying single post Standard hero content - Layout 26
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-26-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-26-shadow'))? ' shadow' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-26-meta');
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

$bg = rivax_get_option('single-format-standard-layout-26-bg')? : '';
$bg = $bg? '--layout-bg: ' . $bg . ';' : '';

?>
<div class="single-hero-layout-26">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-hero-layout-26-container<?php echo esc_html($cls); ?>" style="<?php echo esc_html($bg); ?>">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="content-container">
                                    <?php get_template_part('template-parts/post/hero/title-section-2', '', $meta_args); ?>
                                </div>
                            </div>
                            <div class="col-md-6 image-container" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(NULL, 'rivax-large')); ?>);">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
