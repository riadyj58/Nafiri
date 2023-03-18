<?php
/**
 * Template part for displaying single post Video hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_content = rivax_get_option('single-format-video-position'); // inside / outside
$position_to_meta = rivax_get_option('single-format-video-position-to-meta'); // before / after
$video_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_video_url', true));

$cls = ' ' . $position_to_meta . '-meta';

if($position_to_content == 'outside') {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-12">';
}

echo '<div class="single-hero-video">';

if($position_to_meta == 'after') {
    get_template_part('template-parts/post/hero/title-section-1');
}

?>

    <div class="single-hero-video-container<?php echo esc_html($cls); ?>">
        <?php if( $video_url ) echo wp_oembed_get($video_url , array('width' => '900')); ?>
    </div>

<?php
if($position_to_meta == 'before') {
    get_template_part('template-parts/post/hero/title-section-1');
}

echo '</div>'; // .single-hero-video

if($position_to_content == 'outside') {
    echo '</div>';
    echo '</div>';
    echo '</div>'; // .container
}