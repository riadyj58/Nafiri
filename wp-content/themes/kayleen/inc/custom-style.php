<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

// Set Container to Elemetor Width
if ( class_exists( '\Elementor\Plugin' ) ) {
    $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
    $layout = $kit->get_settings_for_display( 'container_width' );
    $custom_css = ".container { max-width: {$layout['size']}px; }";
}

// Accent Colors
if(rivax_get_option('accent-color')) {
    $custom_css .= ':root { --accent-color: ' . rivax_get_option('accent-color') . ';}';
}

if(rivax_get_option('accent-color-alt')) {
    $custom_css .= ':root { --accent-color-alt: ' . rivax_get_option('accent-color-alt') . ';}';
}

if(rivax_get_option('second-color')) {
    $custom_css .= ':root { --second-color: ' . rivax_get_option('second-color') . ';}';
}

if(rivax_get_option('second-color-alt')) {
    $custom_css .= ':root { --second-color-alt: ' . rivax_get_option('second-color-alt') . ';}';
}

// Styling
if(rivax_get_option('body-bg')) {
    $custom_css .= 'body { background: ' . rivax_get_option('body-bg') . ';}';
}

if(rivax_get_option('body-color')) {
    $custom_css .= 'body { color: ' . rivax_get_option('body-color') . ';}';
}

if(rivax_get_option('link-color')) {
    $custom_css .= 'a { color: ' . rivax_get_option('link-color') . ';}';
}

if(rivax_get_option('link-color-hover')) {
    $custom_css .= 'a:hover, a:focus, a:active { color: ' . rivax_get_option('link-color-hover') . ';}';
}

if(rivax_get_option('heading-color')) {
    $custom_css .= 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 { color: ' . rivax_get_option('heading-color') . ';}';
}

if(rivax_get_option('single-progress-bar-color')) {
    $custom_css .= '.post-reading-progress-indicator span { background: ' . rivax_get_option('single-progress-bar-color') . ';}';
}

if(rivax_get_option('single-category-bg')) {
    $custom_css .= '.single-hero-title-1 .category a, .single-hero-title-2 .category a { background: ' . rivax_get_option('single-category-bg') . ';}';
}

if(rivax_get_option('single-category-bg-hover')) {
    $custom_css .= '.single-hero-title-1 .category a:hover, .single-hero-title-2 .category a:hover { background: ' . rivax_get_option('single-category-bg-hover') . ' !important;}';
}


/* Footer Elements */
if(rivax_get_option('back-to-top-bg')) {
    $custom_css .= '#back-to-top { background: ' . rivax_get_option('back-to-top-bg') . ';}';
}

if(rivax_get_option('footer-canvas-menu-bg')) {
    $custom_css .= '.footer-canvas-menu-bg { background: ' . rivax_get_option('footer-canvas-menu-bg') . ';}';
}

if(rivax_get_option('footer-canvas-menu-color')) {
    $custom_css .= '.footer-canvas-menu .header-vertical-nav li a { color: ' . rivax_get_option('footer-canvas-menu-color') . ';}';
    $custom_css .= '.footer-canvas-menu-btn { color: ' . rivax_get_option('footer-canvas-menu-color') . ';}';
}

if(rivax_get_option('footer-canvas-menu-color-hover')) {
    $custom_css .= '.footer-canvas-menu .header-vertical-nav li > a:hover, .footer-canvas-menu .header-vertical-nav li.current-menu-item > a { color: ' . rivax_get_option('footer-canvas-menu-color-hover') . ';}';
}


/* Blog Archive Title */
if(rivax_get_option('blog-archive-title-bg')) {
    $custom_css .= '.blog-archive-title { background: ' . rivax_get_option('blog-archive-title-bg') . ';}';
}

if(rivax_get_option('blog-archive-title-color')) {
    $custom_css .= '.blog-archive-title, .blog-archive-title .title { color: ' . rivax_get_option('blog-archive-title-color') . ';}';
}

if(is_array(rivax_get_option('blog-archive-title-padding'))) {
    $padding_option = rivax_get_option('blog-archive-title-padding');
    $padding = '';
    $padding .= $padding_option['padding-top']? 'padding-top:' .$padding_option['padding-top'] . ';' : '';
    $padding .= $padding_option['padding-right']? 'padding-right:' . $padding_option['padding-right'] . ';' : '';
    $padding .= $padding_option['padding-bottom']? 'padding-bottom:' . $padding_option['padding-bottom'] . ';' : '';
    $padding .= $padding_option['padding-left']? 'padding-left:' . $padding_option['padding-left'] . ';' : '';
    $custom_css .= '.blog-archive-title, .blog-archive-title .title {' . $padding . '}';
}



/* Typography */
if(rivax_get_option('typography-body', 'font-family')) {
    $custom_css .= 'body {';

    $custom_css .= 'font-family: ' . rivax_get_option('typography-body', 'font-family') . ',sans-serif;';

    if(rivax_get_option('typography-body', 'font-weight')) {
        $custom_css .= 'font-weight: ' . rivax_get_option('typography-body', 'font-weight') . ';';
    }
    if(rivax_get_option('typography-body', 'font-style')) {
        $custom_css .= 'font-style: ' . rivax_get_option('typography-body', 'font-style') . ';';
    }

    $custom_css .= '}';
}

if(rivax_get_option('typography-body', 'font-size')) {
    $custom_css .= 'html { font-size: ' . rivax_get_option('typography-body', 'font-size') . ';}';
}

if(rivax_get_option('typography-heading', 'font-family')) {
    $custom_css .= 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {';

    $custom_css .= 'font-family: ' . rivax_get_option('typography-heading', 'font-family') . ',sans-serif;';

    if(rivax_get_option('typography-heading', 'font-weight')) {
        $custom_css .= 'font-weight: ' . rivax_get_option('typography-heading', 'font-weight') . ';';
    }
    if(rivax_get_option('typography-heading', 'font-style')) {
        $custom_css .= 'font-style: ' . rivax_get_option('typography-heading', 'font-style') . ';';
    }

    $custom_css .= '}';
}

if(rivax_get_option('h1-font-size')) {
    $custom_css .= 'h1, .h1 { font-size: ' . rivax_get_option('h1-font-size') . ';}';
}

if(rivax_get_option('h2-font-size')) {
    $custom_css .= 'h2, .h2 { font-size: ' . rivax_get_option('h2-font-size') . ';}';
}

if(rivax_get_option('h3-font-size')) {
    $custom_css .= 'h3, .h3 { font-size: ' . rivax_get_option('h3-font-size') . ';}';
}

if(rivax_get_option('h4-font-size')) {
    $custom_css .= 'h4, .h4 { font-size: ' . rivax_get_option('h4-font-size') . ';}';
}

if(rivax_get_option('h5-font-size')) {
    $custom_css .= 'h5, .h5 { font-size: ' . rivax_get_option('h5-font-size') . ';}';
}

if(rivax_get_option('h6-font-size')) {
    $custom_css .= 'h6, .h6 { font-size: ' . rivax_get_option('h6-font-size') . ';}';
}

if(rivax_get_option('single-post-title-font-size')) {
    $custom_css .= '.single-hero-title-1 .title,.single-hero-title-2 .title { font-size: ' . rivax_get_option('single-post-title-font-size') . ';}';
}


$custom_css .='@media screen and (max-width: 1024px) {';

if(rivax_get_option('h1-font-size-responsive')) {
    $custom_css .= 'h1, .h1 { font-size: ' . rivax_get_option('h1-font-size-responsive') . ';}';
}

if(rivax_get_option('h2-font-size-responsive')) {
    $custom_css .= 'h2, .h2 { font-size: ' . rivax_get_option('h2-font-size-responsive') . ';}';
}

if(rivax_get_option('h3-font-size-responsive')) {
    $custom_css .= 'h3, .h3 { font-size: ' . rivax_get_option('h3-font-size-responsive') . ';}';
}

if(rivax_get_option('h4-font-size-responsive')) {
    $custom_css .= 'h4, .h4 { font-size: ' . rivax_get_option('h4-font-size-responsive') . ';}';
}

if(rivax_get_option('h5-font-size-responsive')) {
    $custom_css .= 'h5, .h5 { font-size: ' . rivax_get_option('h5-font-size-responsive') . ';}';
}

if(rivax_get_option('h6-font-size-responsive')) {
    $custom_css .= 'h6, .h6 { font-size: ' . rivax_get_option('h6-font-size-responsive') . ';}';
}

if(rivax_get_option('single-post-title-font-size-responsive')) {
    $custom_css .= '.single-hero-title-1 .title,.single-hero-title-2 .title { font-size: ' . rivax_get_option('single-post-title-font-size-responsive') . ';}';
}

$custom_css .='}';


/* Header */
if(rivax_get_option('float-header-glass-bg-blur')) {
    $custom_css .= '#site-header.float-header::before { -webkit-backdrop-filter: blur(' . rivax_get_option('sticky-header-glass-bg-blur') . 'px); backdrop-filter: blur(' . rivax_get_option('sticky-header-glass-bg-blur') . 'px);}';
}

if(rivax_get_option('sticky-header-glass-bg-blur')) {
    $custom_css .= '#site-sticky-header::before { -webkit-backdrop-filter: blur(' . rivax_get_option('sticky-header-glass-bg-blur') . 'px); backdrop-filter: blur(' . rivax_get_option('sticky-header-glass-bg-blur') . 'px);}';
}