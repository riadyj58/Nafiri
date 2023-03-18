<?php
/**
 * Template part for displaying single post Standard hero content - Layout 15
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_layout_meta = rivax_get_option('single-format-standard-layout-15-meta');
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

$bg = rivax_get_option('single-format-standard-layout-15-bg')? : '';
$bg = $bg? '--layout-bg: ' . $bg . ';' : '';

?>
<div class="single-hero-layout-15" style="<?php echo esc_attr($bg); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="single-hero-layout-15-container">
                    <div class="date-container">
                        <div class="day"><?php echo get_the_date('d'); ?></div>
                        <div class="month"><?php echo get_the_date('M'); ?></div>
                    </div>
                    <div class="content-container">
                        <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

