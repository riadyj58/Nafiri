<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

// Get Options
function rivax_get_option($opt1, $opt2 = NULL) {

    global $rivax_kayleen_options;
	
	if(!$rivax_kayleen_options) {
	    $rivax_kayleen_options = get_option('rivax_kayleen_options');
    }

    if($opt2) {
        $option =  isset($rivax_kayleen_options[$opt1][$opt2])? $rivax_kayleen_options[$opt1][$opt2] : '';
    }
    else {
        $option = isset($rivax_kayleen_options[$opt1])? $rivax_kayleen_options[$opt1] : '';
    }

    return apply_filters('rivax_get_option', $option, $opt1, $opt2);
}


// Get Elementor Content to Display
function rivax_get_display_elementor_content($post_id){

    if(!class_exists('Elementor\Plugin')){
        return '';
    }

    $pluginElementor = \Elementor\Plugin::instance();
    $response = $pluginElementor->frontend->get_builder_content_for_display($post_id);

    return $response;
}

// Get template id of layout
function rivax_get_layout_template_id($layout) {

    $template_id = 0;

    if($layout == 'sidebar') {

        if( is_page() ) {
            $template_id = intval( rivax_get_option('single-page-sidebar-template') );
        }
        elseif( is_single() ) {
            $template_id = intval( rivax_get_option('single-post-sidebar-template') );
        }
        elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
            $template_id = intval( rivax_get_option('woocommerce-sidebar-template') );
        }
        else {
            $template_id = intval( rivax_get_option('blog-sidebar-template') );
        }

    }
    elseif($layout == 'footer') {

        // Singular Footer
        if( is_singular() ) {
            $template_id = intval( get_post_meta(get_the_ID(), 'rivax_page_footer', true ) );
        }

        // Global Footer
        if(!$template_id) {
            $template_id = intval(rivax_get_option('site-footer'));
        }

    }
    elseif($layout == 'header') {

        // Singular Header
        if( is_singular() ) {
            $template_id = intval( get_post_meta(get_the_ID(), 'rivax_page_header', true ) );
        }

        // Global Single Post Header
        if(!$template_id && is_single()) {
            $template_id = intval(rivax_get_option('single-post-header'));
        }

        // Global Header
        if(!$template_id) {
            $template_id = intval(rivax_get_option('site-header'));
        }

    }
    elseif($layout == 'sticky_header' && rivax_get_option('sticky-header-status') ) {

        // Singular Header
        if( is_singular() ) {
            $template_id = intval( get_post_meta(get_the_ID(), 'rivax_page_sticky_header', true ) );
        }

        // Global Header
        if(!$template_id) {
            $template_id = intval(rivax_get_option('site-sticky-header'));
        }

    }
    elseif($layout == 'single_top_content' && is_singular() ) {

        $template_id = intval( get_post_meta(get_the_ID(), 'rivax_page_top_content', true ) ); // Get From Post Settings
        if(!$template_id) {
            $template_id = rivax_get_option('single-post-top-content-template'); // Get From Theme Options
        }

    }
    elseif($layout == 'single_bottom_content' && is_singular() ) {

        $template_id = intval( get_post_meta(get_the_ID(), 'rivax_page_bottom_content', true ) ); // Get From Post Settings
        if(!$template_id) {
            $template_id = rivax_get_option('single-post-bottom-content-template'); // Get From Theme Options
        }

    }
    elseif($layout == '404' && is_404() ) {

        $template_id = intval( rivax_get_option('page-404-template') );

    }
    elseif($layout == 'archive' && ( is_archive() || is_home() || is_search() ) ) {

        $template_id = intval( rivax_get_option('archive-template') );

    }



    return intval($template_id);

}


// Get Rivax Templates List
if( !function_exists('rivax_get_templates_list') ) {
	function rivax_get_templates_list() {

		$templates_list = array('0' => esc_html__('Default', 'kayleen'));

		$args = array(
			'numberposts' => -1,
			'post_type' => 'rivax-template',
			'post_status'    => 'publish'
		);
		$templates_posts = get_posts( $args );

		foreach ($templates_posts as $post_item) {
			$templates_list[$post_item->ID] = esc_html($post_item->post_title);
		}

		return $templates_list;
	}
}





// Calculate Post Reading Time
// $post : Post ID or WP_Post object
function rivax_get_reading_time( $post = null ) {
    $post = get_post( $post );

    if ( ! $post ) {
        return false;
    }

    $words_per_minute = absint(rivax_get_option('reading-time-words-per-minute'));
    $words_per_minute = $words_per_minute ?: 255;

    $content = get_post_field( 'post_content', $post );
    $number_of_images = substr_count( strtolower( $content ), '<img ' );

    $content = wp_strip_all_tags( $content );
    $word_count = count( preg_split( '/\s+/', $content ) );

    // Each image is like 25 words
    $word_count += $number_of_images * 25;

    $reading_time = $word_count / $words_per_minute;

    return ceil($reading_time);
}


// HexColor
function rivax_strToHex( $string, $steps = -10 ) {
    $hex_output = sprintf( '%s', substr( md5( $string ), 0, 6 ) );
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max( -255, min( 255, $steps ) );
    // Split into three parts: R, G and B
    $color_parts = str_split( $hex_output, 2 );
    $output = '#';
    foreach ( $color_parts as $color ) {
        $color = hexdec( $color );
        // Convert to decimal
        $color = max( 0, min( 255, $color + $steps ) );
        // Adjust color
        $output .= str_pad(
            dechex( $color ),
            2,
            '0',
            STR_PAD_LEFT
        );
        // Make two char hex code
    }
    return strToUpper( $output );
}


// Title Tags
function rivax_title_tags() {
    $title_tags = [
        'h1'   => 'H1',
        'h2'   => 'H2',
        'h3'   => 'H3',
        'h4'   => 'H4',
        'h5'   => 'H5',
        'h6'   => 'H6',
        'div'  => 'div',
        'span' => 'span',
        'p'    => 'p',
    ];
    return $title_tags;
}


// Grid Tiles Layouts
function rivax_grid_tiles_layouts() {
    $layouts = [
        '0'         => esc_html__( 'Default', 'kayleen' ),
        '1'         => esc_html__( 'Layout 1 (5 items)', 'kayleen' ),
        '2'         => esc_html__( 'Layout 2 (4 items)', 'kayleen' ),
        '3'         => esc_html__( 'Layout 3 (4 items)', 'kayleen' ),
        '4'         => esc_html__( 'Layout 4 (4 items)', 'kayleen' ),
        '5'         => esc_html__( 'Layout 5 (4 items)', 'kayleen' ),
        '6'         => esc_html__( 'Layout 6 (3 items)', 'kayleen' ),
        '7'         => esc_html__( 'Layout 7 (5 items)', 'kayleen' ),
        '8'         => esc_html__( 'Layout 8 (5 items)', 'kayleen' ),
        '9'         => esc_html__( 'Layout 9 (5 items)', 'kayleen' ),
        '10'        => esc_html__( 'Layout 10 (3 items)', 'kayleen' ),
        '11'        => esc_html__( 'Layout 11 (3 items)', 'kayleen' ),
        '12'        => esc_html__( 'Layout 12 (4 items)', 'kayleen' ),
        '13'        => esc_html__( 'Layout 13 (6 items)', 'kayleen' ),
        '14'        => esc_html__( 'Layout 14 (5 items)', 'kayleen' ),
        '15'        => esc_html__( 'Layout 15 (4 items)', 'kayleen' ),
        '16'        => esc_html__( 'Layout 16 (5 items)', 'kayleen' ),
        '17'        => esc_html__( 'Layout 17 (5 items)', 'kayleen' ),
        '18'        => esc_html__( 'Layout 18 (5 items)', 'kayleen' ),
        '19'        => esc_html__( 'Layout 19 (4 items)', 'kayleen' ),
        '20'        => esc_html__( 'Layout 20 (5 items)', 'kayleen' ),
        '21'        => esc_html__( 'Layout 21 (4 items)', 'kayleen' ),
        '22'        => esc_html__( 'Layout 22 (3 items)', 'kayleen' ),
        '23'        => esc_html__( 'Layout 23 (6 items)', 'kayleen' ),
        '24'        => esc_html__( 'Layout 24 (4 items)', 'kayleen' ),
        '25'        => esc_html__( 'Layout 25 (5 items)', 'kayleen' ),
        '26'        => esc_html__( 'Layout 26 (6 items)', 'kayleen' ),
        '27'        => esc_html__( 'Layout 27 (3 items)', 'kayleen' ),
        '28'        => esc_html__( 'Layout 28 (2 items)', 'kayleen' ),
        '29'        => esc_html__( 'Layout 29 (2 items)', 'kayleen' ),
		'30'        => esc_html__( 'Layout 30 (4 items)', 'kayleen' ),
        '31'        => esc_html__( 'Layout 31 (4 items)', 'kayleen' ),
        '32'        => esc_html__( 'Layout 32 (3 items)', 'kayleen' ),
        '33'        => esc_html__( 'Layout 33 (3 items)', 'kayleen' ),
        '34'        => esc_html__( 'Layout 34 (5 items)', 'kayleen' ),
        '35'        => esc_html__( 'Layout 35 (5 items)', 'kayleen' ),
    ];

    return $layouts;
}


// Print post format icon in default archive
function rivax_print_post_format_icon() {

    $post_format = get_post_format() ? : 'standard';

    if ($post_format == 'standard') {
        return;
    }

    switch ($post_format) {
        case 'gallery':
            $post_format_icon = 'ri-images';
            break;
        case 'video':
            $post_format_icon = 'ri-youtube-line';
            break;
        case 'audio':
            $post_format_icon = 'ri-volume-up-line';
            break;
        case 'link':
            $post_format_icon = 'ri-link-solid';
            break;
        case 'quote':
            $post_format_icon = 'ri-double-quotes-l';
            break;
        default:
            $post_format_icon = 'ri-landscape-line';
    }

    ?>
    <div class="post-format-icon rivax-position-top-left">
        <i class="<?php echo esc_html($post_format_icon) ?>"></i>
    </div>
    <?php

}


// Get post views
if(!function_exists('rivax_get_post_views')) {
    function rivax_get_post_views($post_ID){
        $count_key = 'post_views';
        $count = intval( get_post_meta($post_ID, $count_key, true) );
        if($count > 999) {
            $count = substr($count,0, -2) / 10 . 'K';
        }
        return $count;
    }
}
