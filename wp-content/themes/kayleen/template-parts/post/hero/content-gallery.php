<?php
/**
 * Template part for displaying single post Gallery hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_content = rivax_get_option('single-format-gallery-position'); // inside / outside
$position_to_meta = rivax_get_option('single-format-gallery-position-to-meta'); // before / after
$gallery_images = get_post_meta( get_the_ID(), 'rivax_single_gallery_images', true);


$cls = ' ' . $position_to_meta . '-meta';
$cls .= (rivax_get_option('single-format-gallery-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-gallery-shadow'))? ' shadow' : '';


echo '<div class="single-hero-gallery">';

if($position_to_meta == 'after') {
    if($position_to_content == 'outside') {
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-12">';
    }

    get_template_part('template-parts/post/hero/title-section-1');

    if($position_to_content == 'outside') {
        echo '</div>';
        echo '</div>';
        echo '</div>'; // .container
    }
}

?>

    <div class="single-hero-gallery-container<?php echo esc_html($cls); ?>">
        <?php
        if(is_array($gallery_images)) {
            ?>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php
                foreach ($gallery_images as $id => $gallery_image) {

                    $image_url = wp_get_attachment_image_url($id, 'rivax-large');
                    if($image_url) {
                        echo '<div class="single-hero-gallery-item swiper-slide">';
                        echo '<img src="' . $image_url . '" alt="' . get_the_title() . '">';
                        echo '</div>';
                    }
                }
                ?>
                </div>
                <div class="swiper-button-next"><i class="ri-arrow-right-line"></i></div>
                <div class="swiper-button-prev"><i class="ri-arrow-left-line"></i></div>
            </div>
            <?php
        }
        ?>
    </div>

<?php
if($position_to_meta == 'before') {
    if($position_to_content == 'outside') {
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-12">';
    }

    get_template_part('template-parts/post/hero/title-section-1');

    if($position_to_content == 'outside') {
        echo '</div>';
        echo '</div>';
        echo '</div>'; // .container
    }
}

echo '</div>'; // .single-hero-gallery