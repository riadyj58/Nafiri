<?php
/**
 * Template part for displaying header
 */

$cls = 'normal-header';
if(is_page()) {

    if(get_post_meta(get_the_ID(), 'rivax_page_header_type', true) == 'float') {
        $cls = 'float-header';
    }
}
elseif (is_single()) {

    if(rivax_get_option('single-post-float-header')) {
        $cls = 'float-header';
    }

    $header_type_meta = get_post_meta(get_the_ID(), 'rivax_page_header_type', true);

    if($header_type_meta == 'float') {
        $cls = 'float-header';
    }
    elseif ($header_type_meta == 'normal') {
        $cls = 'normal-header';
    }
}

?>
<header id="site-header" class="<?php echo esc_html($cls); ?>">
<?php
// Singular Custom Header
$header_id = rivax_get_layout_template_id('header');
$header = rivax_get_display_elementor_content($header_id);

if($header) {
    echo apply_filters('rivax_print_header_template', $header);
}
else { // Default header
    get_template_part('template-parts/header/header-default');
}
?>
</header>
