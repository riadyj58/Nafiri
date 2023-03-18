<div class="default-archive-container">
    <?php
    if( have_posts() ) {
        while(have_posts()) {
            the_post();
            ?>
            <article <?php post_class( 'default-post-list-item' ); ?>>
                <div class="image-container">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('rivax-large', array( 'title' => get_the_title() )); ?>
                        </a>
                        <?php rivax_print_post_format_icon(); ?>
                    <?php endif; ?>
                </div>
                <div class="content-container">
                    <?php
                    $meta_args = array(
                        'category' => true,
                        'author-avatar' => true,
                        'author-name' => true,
                        'date' => true,
                        'reading-time' => true,
                        'views' => false,
                        'comments' => true,
                        'excerpt' => false,
                    );
                    get_template_part('template-parts/post/hero/title-section-2', '', $meta_args);
                    ?>
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'kayleen'); ?></a>
                </div>
            </article>
            <?php
        }

        // Pagination
        global $wp_query;
        if ( $wp_query->max_num_pages > 1 ) :
            ?>
            <nav class="default-post-list-pagination">
                <?php
                $paginate_args = array(
                    'current'   => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
                    'total'     => $wp_query->max_num_pages,
                    'prev_next' => true,
                );

                echo paginate_links( $paginate_args );
                ?>
            </nav>
        <?php endif;

    }
    else {
        ?>
        <div class="nothing-show">
            <h2><?php esc_html_e('Nothing found!', 'kayleen'); ?></h2>
            <p><?php esc_html_e('It looks like nothing was found here!', 'kayleen'); ?></p>
        </div>
        <?php
    }
    ?>
</div>