<?php
/**
 * Template part for displaying single post Standard hero content - Layout 9
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = (rivax_get_option('single-format-standard-layout-9-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-9-shadow'))? ' shadow' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-9-meta');
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
<div class="single-hero-layout-9">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="image-container<?php echo esc_html($cls); ?>">
                    <?php
                    if(rivax_get_option('single-format-standard-layout-9-full-img'))
                        the_post_thumbnail('full', array( 'title' => get_the_title() ));
                    else
                        the_post_thumbnail('rivax-large-wide', array( 'title' => get_the_title() ));
                    ?>
                </div>
                <div class="content-container">
                    <?php get_template_part('template-parts/post/hero/title-section-1', '', $meta_args); ?>
                </div>
            </div>
        </div>
    </div>
</div>

