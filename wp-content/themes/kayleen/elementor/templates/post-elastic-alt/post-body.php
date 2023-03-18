<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_html($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>
        <div class="image-wrapper">
            <a class="rivax-position-cover rivax-z-index-10" href="<?php the_permalink(); ?>"></a>
            <?php the_post_thumbnail($settings['thumbnail_size'], array( 'title' => get_the_title() )); ?>
            <div class="date rivax-position-<?php echo esc_html($settings['date_position']); ?>">
                <span class="day"><?php echo get_the_date('d') ?></span>
                <span class="month"><?php echo get_the_date('M') ?></span>
            </div>
            <?php $this->render_post_format_icon(); ?>
        </div>
        <div class="content-wrapper">
            <?php $this->render_terms(); ?>
            <?php $this->render_title(); ?>
            <div class="meta-wrapper">
                <?php $this->render_author(); ?>
                <?php $this->render_comments(); ?>
            </div>
            <?php $this->render_excerpt(); ?>
            <?php $this->render_read_more(); ?>
        </div>
    </article>
</div>