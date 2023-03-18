<?php
/**
 * Template part for displaying single post Standard hero content - Layout 11
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_layout_meta = rivax_get_option('single-format-standard-layout-11-meta');
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
<div class="single-hero-layout-11">
    <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
</div>

