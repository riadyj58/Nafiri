<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_html($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>
        <?php if(has_post_thumbnail()): ?>
        <div class="image-wrapper">
            <?php the_post_thumbnail($settings['thumbnail_size'], array( 'title' => get_the_title() )); ?>
            <?php
            if($settings['image_link']) {
                echo '<a class="image-link rivax-position-cover" href="' . get_permalink() . '"></a>';
            }
            ?>
            <div class="rivax-position-bottom">
                <?php if($settings['terms_position'] == 'inside') { $this->render_terms(); } ?>
                <?php if($settings['title_position'] == 'inside') { $this->render_title(); } ?>
            </div>
            <?php $this->render_top_content(); ?>
            <?php $this->render_post_format_icon(); ?>
        </div>
        <?php endif; ?>
        <div class="content-wrapper">
            <?php if($settings['terms_position'] == 'outside') { $this->render_terms(); } ?>
            <?php if($settings['title_position'] == 'outside') { $this->render_title(); } ?>
            <div class="meta-wrapper">
                <?php $this->render_author(); ?>
                <?php $this->render_date(); ?>
                <?php $this->render_comments(); ?>
            </div>
            <?php $this->render_excerpt(); ?>
            <?php $this->render_read_more(); ?>
        </div>
    </article>
</div>