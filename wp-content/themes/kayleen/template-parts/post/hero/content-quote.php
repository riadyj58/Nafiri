<?php
/**
 * Template part for displaying single post Quote hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_content = rivax_get_option('single-format-quote-position'); // inside / outside
$position_to_meta = rivax_get_option('single-format-quote-position-to-meta'); // before / after
$quote_content = esc_attr(get_post_meta( get_the_ID(), 'rivax_single_quote_content', true));
$quote_author = esc_attr(get_post_meta( get_the_ID(), 'rivax_single_quote_author', true));

$cls = ' ' . $position_to_meta . '-meta';
$cls .= ' style-' . rivax_get_option('single-format-quote-style');
$cls .= (rivax_get_option('single-format-quote-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-quote-shadow'))? ' shadow' : '';

if($position_to_content == 'outside') {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
}


echo '<div class="single-hero-quote">';

if($position_to_meta == 'after') {
    get_template_part('template-parts/post/hero/title-section-1');
}

$bg = rivax_get_option('single-format-quote-bg')? : '';
$bg = $bg? '--quote-bg: ' . $bg . ';' : '';
$color = rivax_get_option('single-format-quote-color')? : '';
$color = $color? '--quote-color: ' . $color . ';' : '';

?>

<div class="single-hero-quote-container<?php echo esc_html($cls); ?>" style="<?php echo esc_html($bg) . esc_html($color); ?>">
    <div class="quote-content">
        <span class="icon"><i class="ri-double-quotes-l"></i></span>
        <p class="content"><?php echo esc_attr($quote_content); ?></p>
        <p class="author"><?php echo esc_attr($quote_author); ?></p>
    </div>
</div>

<?php
if($position_to_meta == 'before') {
    get_template_part('template-parts/post/hero/title-section-1');
}

echo '</div>'; // .single-hero-quote

if($position_to_content == 'outside') {
    echo '</div>';
    echo '</div>';
    echo '</div>'; // .container
}
