
<?php $this->load_parts( [ 'header' ] ); ?>
<div class="container">
    <article class="amp-wp-article">
        <header class="amp-wp-article-header">
            <style>
                <?php
                $cats = wp_get_post_categories(get_the_ID());
                foreach($cats as $cat) {
                    $term_color = get_term_meta($cat, 'rivax_term_color', true);
                    if($term_color) {
                        echo '.term-id-' . esc_attr($cat) . '{--term-color: ' . esc_attr($term_color) . ';}';
                    }
                }
                ?>
            </style>
            <?php get_template_part('template-parts/post/hero/title-section-2'); ?>
        </header>

        <?php $this->load_parts( [ 'featured-image' ] ); ?>

        <div class="amp-wp-article-content">
            <?php echo apply_filters('rivax_post_amp_content', $this->get( 'post_amp_content' ) ); ?>
        </div>

        <footer class="amp-wp-article-footer">
            <?php
            /**
             * Filters the template parts to load in the footer area of the AMP legacy post template.
             *
             * @since 0.4
             * @param string[] Templates to load.
             */
            $this->load_parts( apply_filters( 'amp_post_article_footer_meta', [ 'meta-taxonomy', 'meta-comments-link' ] ) );
            ?>
        </footer>
    </article>
</div>

<?php $this->load_parts( [ 'footer' ] ); ?>

