<?php
/**
 * Template part for displaying single post hero content - inside content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_format = get_post_format() ? : 'standard';
$selected_standard_layout = intval( get_post_meta(get_the_ID(), 'rivax_single_post_layout', true ) );
$global_standard_layout = intval(rivax_get_option('single-format-standard-layout'));
$standard_post_layout = $selected_standard_layout && class_exists('Redux')? $selected_standard_layout : $global_standard_layout; // Current post selected layout
$standard_inside_layouts = array(1, 3, 8, 11, 19, 22, 25); // Standard layouts for inside place

echo '<div class="single-hero-inside">';

if( $post_format == 'gallery' && rivax_get_option('single-format-gallery-position') == 'inside' ) {
    get_template_part('template-parts/post/hero/content-gallery');
}
elseif( $post_format == 'video' && rivax_get_option('single-format-video-position') == 'inside' ) {
    get_template_part('template-parts/post/hero/content-video');
}
elseif( $post_format == 'audio' && rivax_get_option('single-format-audio-position') == 'inside' ) {
    get_template_part('template-parts/post/hero/content-audio');
}
elseif( $post_format == 'link' && rivax_get_option('single-format-link-position') == 'inside' ) {
    get_template_part('template-parts/post/hero/content-link');
}
elseif( $post_format == 'quote' && rivax_get_option('single-format-quote-position') == 'inside' ) {
    get_template_part('template-parts/post/hero/content-quote');
}
elseif( $post_format == 'standard' && in_array($standard_post_layout, $standard_inside_layouts) ) {
    get_template_part('template-parts/post/hero/content-' . $standard_post_layout);
}
elseif( $standard_post_layout == 0 ) {
    get_template_part('template-parts/post/hero/content-default');
}

echo '</div>';