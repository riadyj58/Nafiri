<?php
/**
 * Template part for displaying single post fixed next/prev posts
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('single-post-fixed-next-prev-posts') ) {
    $previous_post = get_previous_post();
    $next_post = get_next_post();

    if( $next_post || $previous_post ) {
        ?>
        <div class="single-fixed-next-prev-posts">
            <?php
            if( $next_post ) {
                ?>
                <div class="fixed-post next-post">
                    <div class="post-label">
                        <span class="text"><?php esc_html_e('Next', 'kayleen'); ?></span>
                        <span class="icon"><i class="ri-arrow-down-line"></i></span>
                    </div>
                    <div class="post-wrapper">
                        <div class="image">
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                            <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', array( 'title' => get_the_title() )); ?>
                            </a>
                        </div>
                        <div class="content">
                            <span class="date"><?php echo get_the_date('', $next_post->ID); ?></span>
                            <h3 class="title">
                                <a class="title-animation-underline" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html(get_the_title($next_post->ID)); ?></a>
                            </h3>
                        </div>
                    </div>
                </div>
                <?php
            }

            if( $previous_post ) {
                ?>
                <div class="fixed-post prev-post">
                    <div class="post-label">
                        <span class="icon"><i class="ri-arrow-up-line"></i></span>
                        <span class="text"><?php esc_html_e('Previews', 'kayleen'); ?></span>
                    </div>
                    <div class="post-wrapper">
                        <div class="content">
                            <span class="date"><?php echo get_the_date('', $previous_post->ID); ?></span>
                            <h3 class="title">
                                <a class="title-animation-underline" href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>"><?php echo esc_html(get_the_title($previous_post->ID)); ?></a>
                            </h3>
                        </div>
                        <div class="image">
                            <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>">
                                <?php echo get_the_post_thumbnail($previous_post->ID, 'thumbnail', array( 'title' => get_the_title() )); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}