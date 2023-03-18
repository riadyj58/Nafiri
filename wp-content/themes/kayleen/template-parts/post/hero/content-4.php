<?php
/**
 * Template part for displaying single post Standard hero content - Layout 4
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$position_to_meta = rivax_get_option('single-format-standard-layout-4-img-position'); // before / after

$cls = ' ' . $position_to_meta . '-meta';
$cls .= (rivax_get_option('single-format-standard-layout-4-radius'))? ' radius' : '';
$cls .= (rivax_get_option('single-format-standard-layout-4-shadow'))? ' shadow' : '';

$post_layout_meta = rivax_get_option('single-format-standard-layout-4-meta');
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

echo '<div class="single-hero-layout-4">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12">';

if($position_to_meta == 'after') {
    get_template_part('template-parts/post/hero/title-section-1', '', $meta_args);
}

?>

    <div class="image-container<?php echo esc_html($cls); ?>">
        <?php
        if(rivax_get_option('single-format-standard-layout-4-full-img'))
            the_post_thumbnail('full', array( 'title' => get_the_title() ));
        else
            the_post_thumbnail('rivax-large-wide', array( 'title' => get_the_title() ));
        ?>
    </div>

<?php
if($position_to_meta == 'before') {
    get_template_part('template-parts/post/hero/title-section-1', '', $meta_args);
}

echo '</div>';
echo '</div>';
echo '</div>'; // .container
echo '</div>'; // .single-hero-layout-2