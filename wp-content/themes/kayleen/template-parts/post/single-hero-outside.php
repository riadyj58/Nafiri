<?php
/**
 * Template part for displaying single post hero content - outside content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_format = get_post_format() ? : 'standard';
$selected_standard_layout = intval( get_post_meta(get_the_ID(), 'rivax_single_post_layout', true ) );
$global_standard_layout = intval(rivax_get_option('single-format-standard-layout'));
$standard_post_layout = $selected_standard_layout && class_exists('Redux')? $selected_standard_layout : $global_standard_layout; // Current post selected layout
$standard_outside_layouts = array(2, 4, 5, 6, 7, 9, 10, 12, 13, 14, 15, 16, 17, 18, 20, 21, 23, 24, 26); // Standard layouts for outside place

echo '<div class="single-hero-outside">';

if( $post_format == 'gallery' && rivax_get_option('single-format-gallery-position') == 'outside' ) {
    get_template_part('template-parts/post/hero/content-gallery');
}
elseif( $post_format == 'video' && rivax_get_option('single-format-video-position') == 'outside' ) {
    get_template_part('template-parts/post/hero/content-video');
}
elseif( $post_format == 'audio' && rivax_get_option('single-format-audio-position') == 'outside' ) {
    get_template_part('template-parts/post/hero/content-audio');
}
elseif( $post_format == 'link' && rivax_get_option('single-format-link-position') == 'outside' ) {
    get_template_part('template-parts/post/hero/content-link');
}
elseif( $post_format == 'quote' && rivax_get_option('single-format-quote-position') == 'outside' ) {
    get_template_part('template-parts/post/hero/content-quote');
}
elseif( $post_format == 'standard' && in_array($standard_post_layout, $standard_outside_layouts) ) {
    get_template_part('template-parts/post/hero/content-' . $standard_post_layout);
}

echo '</div>';