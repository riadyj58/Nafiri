<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$query = $this->get_query_result();
if ( ! $query->found_posts ) {

    ?>
    <div class="nothing-show">
        <h2><?php esc_html_e('Nothing found!', 'kayleen'); ?></h2>
        <p><?php esc_html_e('It looks like nothing was found here!', 'kayleen'); ?></p>
    </div>
    <?php

    return;
}
?>
<div class="rivax-stellar-container">
    <div class="rivax-stellar-wrapper">
        <div class="images-wrapper rivax-position-cover">
            <?php
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();

                    $active = $query->current_post == 0 ? ' active' : '';
                    ?>
                    <div class="image-item rivax-position-cover<?php echo esc_html($active); ?>" data-id="<?php the_ID(); ?>">
                        <?php the_post_thumbnail($settings['thumbnail_size'], array( 'title' => get_the_title() )); ?>
                    </div>
                <?php

                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="posts-wrapper">
            <?php
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();

                    $active = $query->current_post == 0 ? ' active' : '';
                    ?>
                    <div class="post-item<?php echo esc_html($active); ?>" data-id="<?php the_ID(); ?>">
                        <?php $this->render_post_body(); ?>
                    </div>
                <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
