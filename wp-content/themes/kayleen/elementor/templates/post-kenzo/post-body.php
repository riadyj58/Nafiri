<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_html($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>
        <?php
        if($settings['link_wrapper']) {
            echo '<a class="item-link rivax-position-cover" href="' . get_permalink() . '"></a>';
        }
        ?>
        <div class="image-wrapper">
            <?php the_post_thumbnail($settings['thumbnail_size'], array( 'title' => get_the_title() )); ?>
        </div>
        <div class="content-wrapper rivax-position-<?php echo esc_html($settings['content_position']) . ' ' . esc_html($settings['content_style']); ?>">
            <div class="content-wrapper-inner">
                <?php $this->render_terms(); ?>
                <?php $this->render_title(); ?>
                <div class="meta-wrapper">
                    <?php $this->render_author(); ?>
                    <?php $this->render_date(); ?>
                </div>
                <?php if($settings['content_style'] == 'style-3'): ?>
                    <div class="read-more-wrap">
                        <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html($settings['read_more_text']) ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $this->render_post_format_icon(); ?>
    </article>
</div>