<?php
/**
 * Template part for displaying single post share box
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('single-post-share-box') ) {
    ?>
    <div class="single-share-box-container">
        <?php
        $social = rivax_get_option('single-post-share-box-options');
        $share_summary = get_the_excerpt();
        $share_url = wp_get_shortlink();
        $share_title = html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8');
        $share_media = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
        ?>
        <h4 class="title"><?php esc_html_e('Share Article', 'kayleen'); ?></h4>
        <div class="single-share-box">
            <?php if( $social['facebook'] ): ?>
                <a class="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-facebook-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['twitter'] ): ?>
                <a class="twitter" rel="nofollow"  href="http://twitter.com/share?text=<?php echo urlencode($share_title); ?>&url=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-twitter-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['linkedin'] ): ?>
                <a class="linkedin" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>&summary=<?php echo urlencode($share_summary); ?>" target="_blank"><i class="ri-linkedin-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['pinterest'] ): ?>
                <a class="pinterest" rel="nofollow"  href="//pinterest.com/pin/create/link/?url=<?php echo esc_url($share_url); ?>&media=<?php echo esc_url($share_media); ?>&description=<?php echo urlencode($share_title); ?>" target="_blank"><i class="ri-pinterest-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['telegram'] ): ?>
                <a class="telegram" rel="nofollow" href="https://telegram.me/share/url?url=<?php echo esc_url($share_url); ?>&text=<?php echo urlencode($share_title); ?>" target="_blank"><i class="ri-telegram-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['email'] ): ?>
                <a class="email" rel="nofollow"  href="mailto:?subject=<?php echo urlencode($share_title); ?>&body=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-mail-line"></i></a>
            <?php endif; ?>
            <?php if( $social['whatsapp'] ): ?>
                <a class="whatsapp" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php echo esc_url($share_url); ?>" data-action="share/whatsapp/share" target="_blank"><i class="ri-whatsapp-line"></i></a>
            <?php endif; ?>
        </div>

        <?php if( $social['link'] ): ?>
        <div class="single-share-box-link">
            <div class="form-content">
                <input type="text" name="url" value="<?php echo urldecode( get_the_permalink() ); ?>" class="share-link-text" readonly>
                <button type="submit" class="share-link-btn">
                    <i class="ri-file-copy-line"></i>
                    <span class="copied-popup-text"><?php esc_html_e('Link Copied!', 'kayleen') ?></span>
                </button>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <?php
}