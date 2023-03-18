<?php
/**
 * Template part for displaying single post Standard hero content - Layout 10
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_meta = rivax_get_option('single-format-standard-layout-10-img-position'); // before / after

$cls = ' ' . $position_to_meta . '-meta';

$post_layout_meta = rivax_get_option('single-format-standard-layout-10-meta');
$meta_args = array(
    'category' => $post_layout_meta['category'],
    'author-name' => $post_layout_meta['author-name'],
    'author-avatar' => $post_layout_meta['author-avatar'],
    'date' => $post_layout_meta['date'],
    'reading-time' => $post_layout_meta['reading-time'],
    'views' => $post_layout_meta['views'],
    'comments' => $post_layout_meta['comments'],
    'excerpt' => $post_layout_meta['excerpt'],
);

?>
<div class="single-hero-layout-10">
    <?php
    if($position_to_meta == 'after') {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-container">
                        <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="image-container<?php echo esc_html($cls); ?>">
        <?php
        if(rivax_get_option('single-format-standard-layout-10-full-img')) {
            the_post_thumbnail('full', array( 'title' => get_the_title() ));
        }
        else {
            echo '<div class="layout-10-bg" style="background-image: url(' . esc_url(get_the_post_thumbnail_url(NULL, 'full')) . ');"></div>';
        }
        ?>
    </div>
    <?php
    if($position_to_meta == 'before') {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-container">
                        <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

