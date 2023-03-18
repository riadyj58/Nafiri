<?php
namespace RivaxStudio\Traits;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


trait Rivax_Post_skin_base {

    /*
     * Check Elementor Edit Mode
     * */
    protected function rivax_is_edit_mode(){
        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
            return true;
        }
        return false;
    }


    protected function render_pagination() {
        $settings  = $this->get_settings_for_display();

        $pagination_type    = $settings[ 'pagination_type' ];
        $page_limit         = $settings[ 'pagination_page_limit' ];
        $pagination_shorten = $settings[ 'pagination_numbers_shorten' ];

        if ( 'none' === $pagination_type ) {
            return;
        }

        if($settings['layout'] == 'carousel') {
            return;
        }

        // Get current page number.
        $current_page = $this->get_paged();

        $query       = $this->get_query_result();
        $total_pages = $query->max_num_pages;


        // Limit pages
        if ( $page_limit ) {
            $total_pages = min( $page_limit, $total_pages );
        }

        if ( 2 > $total_pages ) {
            return;
        }


        if ( in_array($pagination_type, ['load_more', 'infinite_scroll']) ) {
            $load_more_label                = $settings[ 'pagination_load_more_label' ]?: esc_html__( 'Load More', 'kayleen' );
            $load_more_button_size          = $settings[ 'load_more_button_size' ];

            $document_id             = '';
            if ( null !== \Elementor\Plugin::$instance->documents->get_current() ) {
                $document_id = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();
            }

            if($settings[ 'posts_source' ] == 'current_query') {
                $q_vars = $this->validate_load_more_current_query_args( $GLOBALS['wp_query']->query_vars );
                $q_vars = json_encode($q_vars);
                if(!empty($q_vars)) {
                    ?>
                    <script>const rivaxLoadMoreQVars = <?php echo sanitize_text_field($q_vars); ?>;</script>
                    <?php
                }
            }

            $infinite_scroll_cls = ($pagination_type == 'infinite_scroll')? 'infinite-scroll' : '';

            ?>
            <div class="rivax-posts-pagination-wrap">
                <div class="rivax-posts-pagination load-more-pagination">
                    <a class="rivax-post-load-more elementor-button elementor-size-<?php echo esc_attr( $load_more_button_size . ' ' . $infinite_scroll_cls ); ?>" href="#"
                       data-widget-id="<?php echo esc_html($this->get_id()); ?>" data-current-page="1"
                       data-post-id="<?php echo esc_html($document_id); ?>">
                        <span class="rivax-button-text">
							<?php echo esc_html( $load_more_label ); ?>
						</span>
                    </a>
                    <span class="rivax-post-load-more-loader"></span>
                </div>
            </div>
            <?php
        }
        else {

            $has_numbers   = in_array( $pagination_type, [ 'numbers', 'numbers_and_prev_next' ] );
            $has_prev_next = in_array( $pagination_type, [ 'prev_next', 'numbers_and_prev_next' ] );

            $paginate_args = array(
                'type'      => 'array',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_next' => false,
                'show_all'  => 'yes' !== $pagination_shorten,
            );

            if ( $has_prev_next ) {
                $prev_label = $settings[ 'pagination_prev_label' ];
                $next_label = $settings[ 'pagination_next_label' ];

                $paginate_args['prev_next'] = true;

                if ( $prev_label ) {
                    $paginate_args['prev_text'] = $prev_label;
                }
                if ( $next_label ) {
                    $paginate_args['next_text'] = $next_label;
                }
            }

            if ( is_singular() && ! is_front_page() ) {
                global $wp_rewrite;
                if ( $wp_rewrite->using_permalinks() ) {
                    $paginate_args['base']   = trailingslashit( get_permalink() ) . '%_%';
                    $paginate_args['format'] = user_trailingslashit( 'page/%#%', 'single_paged' ); // Change Occurs For Fixing Pagination Issue.
                } else {
                    $paginate_args['format'] = '?page=%#%';
                }
            }

            $links = paginate_links( $paginate_args );

            if( $pagination_type == 'prev_next' ) { // Remove numbers from pagination
                $prev_next_links = [];
                if($current_page != 1) {
                    $prev_next_links[] = $links[0];
                }

                if($current_page != $total_pages) {
                    $prev_next_links[] = end($links);
                }

                $links = $prev_next_links;
            }

            ?>
            <div class="rivax-posts-pagination-wrap">
                <nav class="rivax-posts-pagination standard-pagination elementor-pagination" aria-label="<?php esc_attr_e( 'Pagination', 'kayleen' ); ?>" data-total="<?php echo esc_html( $total_pages ); ?>">
                    <?php echo implode( PHP_EOL, $links ); ?>
                </nav>
            </div>
            <?php
        }

    }


    protected function render_post_body() {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/post-body.php';
    }


    public function render_ajax_posts() {

        $data = '';
        $no_more_posts = true;
        $msg = esc_html__( 'No more posts found!', 'kayleen' );

        $query = $this->get_query_result();

        if ( $query->have_posts() ) :
            if(intval($query->query["paged"] < $query->max_num_pages)) {
                $no_more_posts = false;
                $msg = '';
            }

            ob_start();
            while ( $query->have_posts() ) :
                $query->the_post();

                $this->render_post_body();

            endwhile;
            $data = ob_get_clean();
        endif;
        wp_reset_postdata();


        $return = array(
            'data'          => $data,
            'no_more'       => $no_more_posts,
            'msg'           => $msg,
        );

        return $return;
    }


    protected function render_carousel_header() {
        $settings        = $this->get_settings_for_display();

        if($settings['layout'] != 'carousel') {
            return;
        }

        $id = 'rivax-carousel-' . $this->get_id();
        $elementor_vp_lg = get_option( 'elementor_viewport_lg' );
        $elementor_vp_md = get_option( 'elementor_viewport_md' );
        $viewport_lg     = ! empty( $elementor_vp_lg ) ? intval($elementor_vp_lg) - 1 : 1023;
        $viewport_md     = ! empty( $elementor_vp_md ) ? intval($elementor_vp_md) - 1 : 767;

        $this->add_render_attribute( 'carousel', 'id', $id );
        $this->add_render_attribute( 'carousel', 'class', 'rivax-posts-carousel-wrapper' );

        if ( $settings['carousel_pagination'] ) {
            $pagination_type = $settings['carousel_pagination_type'];
        } else {
            $pagination_type = '';
        }

        $carousel_settings = [
            "autoplay"              => ( "yes" == $settings["carousel_autoplay"] ) ? [ "delay" => $settings["carousel_autoplay_speed"] ] : false,
            "loop"                  => ( $settings["carousel_loop"] == "yes" ),
            "speed"                 => $settings["carousel_speed"]["size"],
            "pauseOnMouseEnter"     => ( $settings["carousel_pauseonhover"] == "yes" ),
            "slidesPerView"         => !empty($settings["columns_mobile"]) ? intval($settings["columns_mobile"]) : 1,
            "slidesPerGroup"        => !empty($settings["carousel_slides_to_scroll_mobile"]) ? intval($settings["carousel_slides_to_scroll_mobile"]) : 1,
            "spaceBetween"          => !empty($settings["column_gap_mobile"]["size"]) ? $settings["column_gap_mobile"]["size"] : 20,
            "centeredSlides"        => ( $settings["carousel_centered_slides"] == "yes" ),
            "grabCursor"            => ( $settings["carousel_grab_cursor"] == "yes" ),
            "effect"                => $settings["carousel_effect"],
            "autoHeight"            => ( $settings["carousel_auto_height"] == "yes" ),
            "observer"              => ( $settings["carousel_observer"] == "yes" ),
            "observeParents"        => ( $settings["carousel_observer"] == "yes" ),
            "direction"             => $settings['carousel_direction'],
            "breakpoints"           => [
                $viewport_md => [
                    "slidesPerView"  => !empty($settings["columns_tablet"]) ? (int)$settings["columns_tablet"] : 2,
                    "spaceBetween"   => !empty($settings["column_gap_tablet"]["size"]) ? (int)$settings["column_gap_tablet"]["size"] : 20,
                    "slidesPerGroup" => !empty($settings["carousel_slides_to_scroll_tablet"]) ? (int)$settings["carousel_slides_to_scroll_tablet"] : 1,
                ],
                $viewport_lg => [
                    "slidesPerView"  => !empty($settings["columns"]) ? (int)$settings["columns"] : 3,
                    "spaceBetween"   => !empty($settings["column_gap"]["size"]) ? $settings["column_gap"]["size"] : 20,
                    "slidesPerGroup" => !empty($settings["carousel_slides_to_scroll"]) ? (int)$settings["carousel_slides_to_scroll"] : 1,
                ]
            ],
            "navigation"            => [
                "nextEl" => "#" . $id . " .carousel-nav-next",
                "prevEl" => "#" . $id . " .carousel-nav-prev",
            ],
            "pagination"            => [
                "el"             => "#" . $id . " .carousel-pagination",
                "type"           => $pagination_type,
                "clickable"      => "true",
                'dynamicBullets' => ( "yes" == $settings["carousel_dynamic_bullets"] ),
            ],
            "a11y"            => [
                "enabled"             => "false",
            ],
            "fadeEffect"            => [
                "crossFade" => true,
            ],

        ];


        $this->add_render_attribute('carousel', 'data-settings', wp_json_encode(array_filter($carousel_settings)) );

        ?>
        <div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
            <div class="swiper-container">
                <div class="swiper-wrapper">
        <?php
    }


    protected function render_carousel_footer() {
        $settings = $this->get_settings_for_display();

        if($settings['layout'] != 'carousel') {
            return;
        }

        ?>
            </div> <!-- .swiper-wrapper -->
        </div><!-- .swiper-container -->
        <?php
        // Arrows
        if ( $settings['carousel_arrows'] ) {
            $carousel_nav_cls = 'carousel-nav-wrapper';
            $carousel_nav_cls .= ' rivax-position-' . esc_html($settings['carousel_arrows_position']);
            $carousel_nav_cls .= $settings['carousel_arrow_show_on_hover']? ' show-on-hover' : '';
            $carousel_nav_cls .= $settings['carousel_hide_arrow_mobile']? ' elementor-hidden-mobile' : '';

            ?>
            <div class="<?php echo esc_html($carousel_nav_cls); ?>">
                <a href="" class="carousel-nav-prev">
                    <i class="<?php echo esc_html($settings['carousel_arrows_icon']); ?>"></i>
                </a>
                <a href="" class="carousel-nav-next">
                    <i class="<?php echo esc_html($settings['carousel_arrows_icon']); ?>"></i>
                </a>
            </div>
            <?php
        }

        // Pagination
        if ( $settings['carousel_pagination'] ) {
            $pagination_cls = 'carousel-pagination-wrapper';
            $pagination_cls .= ' type-' . esc_html($settings['carousel_pagination_type']);
            $pagination_cls .= ' rivax-position-' . esc_html($settings['carousel_pagination_position']);

            ?>
            <div class="<?php echo esc_html($pagination_cls); ?>">
                <div class="carousel-pagination"></div>
            </div>
            <?php
        }

        ?>


        </div><!-- .rivax-posts-carousel-wrapper -->
    <?php
    }


    protected function render_date() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_date']) {
            return;
        }
        ?>
        <div class="date">
            <i class="ri-calendar-2-line"></i>
            <?php if ($settings['human_diff_time'] == 'yes') {
                printf( esc_html__( '%s ago', 'kayleen' ), human_time_diff( get_the_time('U'), current_time('timestamp') ) );
            } else {
                echo get_the_date();
            } ?>
        </div>

        <?php if ($settings['show_time']) : ?>
            <div class="time">
                <i class="ri-android-time"></i>
                <?php echo get_the_time(); ?>
            </div>
        <?php endif; ?>
        <?php
    }


    protected function render_terms() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_terms'] || !$settings['terms_taxonomy']) {
            return;
        }

        $terms = get_the_terms( get_the_ID(), $settings['terms_taxonomy'] );
        if(!empty($terms)) {
            echo '<div class="terms-wrapper">';

            $term_limit = max(1, $settings['term_limit']);
            $i = 0;

            foreach ($terms as $term) {
                if($i >= $term_limit) break; $i++;
                $bg = '';
                if($settings['term_multi_background']) {
                    $term_bg = get_term_meta($term->term_id, 'rivax_term_color', true);
                    if($term_bg) {
                        $bg = 'style="background-color: ' . esc_html($term_bg) . '"';
                    }
                }
                echo '<a class="term-item" href="' . esc_url(get_term_link($term->term_id)) . '" ' . $bg . '>' . esc_html($term->name) . '</a>';
            }

            echo '</div>';
        }

    }


    protected function render_title() {
        $settings = $this->get_settings_for_display();
        ?>
        <<?php echo esc_attr($settings['title_tag']); ?> class="title">
        <a href="<?php echo esc_url(get_permalink()) ?>" class="title-animation-<?php echo esc_attr($settings['title_hover_style']); ?>" title="<?php echo esc_html(get_the_title()) ?>">
            <?php echo get_the_title();  ?>
        </a>
        </<?php echo esc_attr($settings['title_tag']); ?>>
        <?php
    }


    protected function render_excerpt() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_excerpt']) {
            return;
        }
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            $excerpt = wp_strip_all_tags($excerpt);
            $excerpt = substr($excerpt, 0, absint($settings['excerpt_length']));
            $result = substr($excerpt, 0, strrpos($excerpt, ' '));
            $result .= '...';
            echo '<p class="excerpt">' . $result . '</p>';
        }
    }


    protected function render_read_more() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_read_more']) {
            return;
        }

        $read_more_text = esc_attr($settings['read_more_text']);

        $this->add_render_attribute('read_more', 'class', "rivax-read-more style-" . $settings['read_more_style']);

        if($settings['read_more_icon'] != 'none') {
            $this->add_render_attribute('read_more', 'class', "icon-" . $settings['read_more_icon_position']);
        }

        if($settings['read_more_style'] == '1') {
            $this->add_render_attribute('read_more', 'class', "shape-" . $settings['read_more_shape_position']);
        }

        ?>
        <div class="rivax-read-more-wrapper">
            <a href="<?php the_permalink(); ?>" <?php $this->print_render_attribute_string( 'read_more' ); ?>>
                <span class="read-more-title"><?php echo esc_attr($read_more_text); ?></span>
                <?php if($settings['read_more_icon'] != 'none'): ?>
                    <i class="<?php echo esc_attr($settings['read_more_icon']); ?>"></i>
                <?php endif; ?>
            </a>
        </div>
        <?php

    }


    protected function render_post_format_icon() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_post_format_icon']) {
            return;
        }

        $post_format = get_post_format() ? : 'standard';

        if ($post_format == 'standard') {
            return;
        }

        switch ($post_format) {
            case 'gallery':
                $post_format_icon = 'ri-images';
                break;
            case 'video':
                $post_format_icon = 'ri-youtube-line';
                break;
            case 'audio':
                $post_format_icon = 'ri-volume-up-line';
                break;
            case 'link':
                $post_format_icon = 'ri-link-solid';
                break;
            case 'quote':
                $post_format_icon = 'ri-double-quotes-l';
                break;
            default:
                $post_format_icon = 'ri-landscape-line';
        }

        ?>
        <div class="post-format-icon rivax-position-<?php echo esc_html($settings['post_format_icon_position']) ?>">
            <i class="<?php echo esc_html($post_format_icon) ?>"></i>
        </div>
        <?php
    }


}

