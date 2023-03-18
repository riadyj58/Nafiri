<?php
/**
 * Template part for displaying single post Audio hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_content = rivax_get_option('single-format-audio-position'); // inside / outside
$position_to_meta = rivax_get_option('single-format-audio-position-to-meta'); // before / after
$audio_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_audio_url', true));

$cls = ' ' . $position_to_meta . '-meta';

if($position_to_content == 'outside') {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
}

echo '<div class="single-hero-audio">';

if($position_to_meta == 'after') {
    get_template_part('template-parts/post/hero/title-section-1');
}

?>

    <div class="single-hero-audio-container<?php echo esc_html($cls); ?>">
        <?php if($audio_url) echo wp_oembed_get($audio_url); ?>
    </div>

<?php
if($position_to_meta == 'before') {
    get_template_part('template-parts/post/hero/title-section-1');
}

echo '</div>'; // .single-hero-audio

if($position_to_content == 'outside') {
    echo '</div>';
    echo '</div>';
    echo '</div>'; // .container
}