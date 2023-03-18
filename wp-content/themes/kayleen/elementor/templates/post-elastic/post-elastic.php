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

$this->add_render_attribute('wrapper', 'class', 'rivax-posts-wrapper');
$this->add_render_attribute('wrapper', 'class', 'layout-' . $settings['layout']);

?>
<div class="rivax-posts-container">
    <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <?php $this->render_carousel_header(); ?>
        <?php
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
                $query->the_post();

                $this->render_post_body();

            endwhile;
        endif;
        wp_reset_postdata();
        ?>
        <?php $this->render_carousel_footer(); ?>
    </div>
    <?php $this->render_pagination(); ?>
</div>
