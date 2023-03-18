<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$custom_css = '';

// Accent Colors
if(rivax_get_option('accent-color')) {
	$custom_css .= 'body .editor-styles-wrapper { --accent-color: ' . rivax_get_option('accent-color') . ';}';
}

if(rivax_get_option('accent-color-alt')) {
	$custom_css .= 'body .editor-styles-wrapper { --accent-color-alt: ' . rivax_get_option('accent-color-alt') . ';}';
}

if(rivax_get_option('second-color')) {
	$custom_css .= 'body .editor-styles-wrapper { --second-color: ' . rivax_get_option('second-color') . ';}';
}

if(rivax_get_option('second-color-alt')) {
	$custom_css .= 'body .editor-styles-wrapper { --second-color-alt: ' . rivax_get_option('second-color-alt') . ';}';
}


/* Typography */
if(rivax_get_option('typography-body', 'font-family')) {
	$custom_css .= 'body .editor-styles-wrapper {';

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
	$custom_css .= 'body .editor-styles-wrapper { font-size: ' . rivax_get_option('typography-body', 'font-size') . ';}';
}

if(rivax_get_option('typography-heading', 'font-family')) {
	$custom_css .= 'body .editor-styles-wrapper h1, body .editor-styles-wrapper h2, body .editor-styles-wrapper h3, body .editor-styles-wrapper h4, body .editor-styles-wrapper h5, body .editor-styles-wrapper h6, body .editor-styles-wrapper .h1, body .editor-styles-wrapper .h2, body .editor-styles-wrapper .h3, body .editor-styles-wrapper .h4, body .editor-styles-wrapper .h5, body .editor-styles-wrapper .h6 {';

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
	$custom_css .= 'body .editor-styles-wrapper h1, body .editor-styles-wrapper .h1 { font-size: ' . rivax_get_option('h1-font-size') . ';}';
}

if(rivax_get_option('h2-font-size')) {
	$custom_css .= 'body .editor-styles-wrapper h2, body .editor-styles-wrapper .h2 { font-size: ' . rivax_get_option('h2-font-size') . ';}';
}

if(rivax_get_option('h3-font-size')) {
	$custom_css .= 'body .editor-styles-wrapper h3, body .editor-styles-wrapper .h3 { font-size: ' . rivax_get_option('h3-font-size') . ';}';
}

if(rivax_get_option('h4-font-size')) {
	$custom_css .= 'body .editor-styles-wrapper h4, body .editor-styles-wrapper .h4 { font-size: ' . rivax_get_option('h4-font-size') . ';}';
}

if(rivax_get_option('h5-font-size')) {
	$custom_css .= 'body .editor-styles-wrapper h5, body .editor-styles-wrapper .h5 { font-size: ' . rivax_get_option('h5-font-size') . ';}';
}

if(rivax_get_option('h6-font-size')) {
	$custom_css .= 'body .editor-styles-wrapper h6, body .editor-styles-wrapper .h6 { font-size: ' . rivax_get_option('h6-font-size') . ';}';
}