<?php
/**
 * Template part for displaying single post Link hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_content = rivax_get_option('single-format-link-position'); // inside / outside
$position_to_meta = rivax_get_option('single-format-link-position-to-meta'); // before / after
$link_url = esc_url(get_post_meta( get_the_ID(),'rivax_single_link_url', true));
$link_title = esc_attr(get_post_meta( get_the_ID(),'rivax_single_link_title', true));

$link_url_text = preg_replace('/https?:\/\/(www.)?/', '', $link_url);; // Remove http / www

$cls = ' ' . $position_to_meta . '-meta';
$cls .= (rivax_get_option('single-format-link-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-link-shadow'))? ' shadow' : '';

if($position_to_content == 'outside') {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
}

echo '<div class="single-hero-link">';

if($position_to_meta == 'after') {
    get_template_part('template-parts/post/hero/title-section-1');
}

$bg = rivax_get_option('single-format-link-bg')? : '';
$bg = $bg? '--link-bg: ' . $bg . ';' : '';
$color = rivax_get_option('single-format-link-color')? : '';
$color = $color? '--link-color: ' . $color . ';' : '';

?>

    <div class="single-hero-link-container<?php echo esc_attr($cls); ?>" style="<?php echo esc_html($bg) . esc_html($color); ?>">
        <div class="link-content">
            <div class="icon">
                <span class="link-icon"><i class="ri-link-solid"></i></span>
            </div>
            <div class="content">
                <a class="link" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_attr($link_url_text); ?></a>
                <p class="title"><?php echo esc_attr($link_title); ?></p>
            </div>
        </div>
    </div>

<?php
if($position_to_meta == 'before') {
    get_template_part('template-parts/post/hero/title-section-1');
}

echo '</div>'; // .single-hero-link

if($position_to_content == 'outside') {
    echo '</div>';
    echo '</div>';
    echo '</div>'; // .container
}