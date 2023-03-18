<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Helper {

    public static $_instance;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Load Construct
     *
     */
    public function __construct(){

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }


        // Custom Elementor Controller for rivax-select2
        add_action('wp_ajax_rivax_select2_search_query', [$this, 'rivax_select2_search_query']);
        add_action('wp_ajax_nopriv_rivax_select2_search_query', [$this, 'rivax_select2_search_query']);

        add_action('wp_ajax_rivax_select2_get_title', [$this, 'rivax_select2_get_title']);
        add_action('wp_ajax_nopriv_rivax_select2_get_title', [$this, 'rivax_select2_get_title']);


        // Load more posts
        add_action('wp_ajax_rivax_get_load_more_posts', [$this, 'rivax_get_load_more_posts']);
        add_action('wp_ajax_nopriv_rivax_get_load_more_posts', [$this, 'rivax_get_load_more_posts']);

    }

    /*
     * $posts_source = post type
     * $source_type = post, taxonomy, author
     * */
    public function rivax_select2_search_query() {
        $posts_source = 'post';
        $source_type = 'post';

        if ( !empty( $_GET[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_GET[ 'source_type' ] );
        }

        if ( !empty( $_GET[ 'posts_source' ] ) ) {
            $posts_source = sanitize_text_field( $_GET[ 'posts_source' ] );
        }

        $search = !empty( $_GET[ 'term' ] ) ? sanitize_text_field( $_GET[ 'term' ] ) : '';
        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => $posts_source,
                'numberposts' => '5',
                's'           => $search,
                'orderby'     => 'title',
                'order'     => 'ASC',
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $taxonomies = get_object_taxonomies( $posts_source );

            if($taxonomies) {
                $args = [
                    'hide_empty' => false,
                    'taxonomy' => $taxonomies,
                    'number'     => '5',
                    'search'     => $search,
                    'fields'     => 'all',
                ];

                $terms_result = get_terms($args);
                foreach ($terms_result as $term_item) {
                    $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
                }
            }

        }
        elseif($source_type == 'author') {
            $search = $search? '*' . $search . '*' : '';
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'orderby' => 'display_name',
                'has_published_posts' => true,
                'number'     => '5',
                'search'     => $search,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        if ( !empty( $query_result ) ) {
            foreach ( $query_result as $key => $item ) {
                $results[] = [ 'text' => $item, 'id' => $key ];
            }
        }

        wp_send_json( [ 'results' => $results ] );
        wp_die();
    }


    public function rivax_select2_get_title() {

        if ( empty( $_POST[ 'id' ] ) ) {
            wp_send_json_error( [] );
        }

        if ( empty( array_filter($_POST[ 'id' ]) ) ) {
            wp_send_json_error( [] );
        }
        $ids          = array_map('intval',$_POST[ 'id' ]);

        $source_type = 'post';

        if ( !empty( $_POST[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_POST[ 'source_type' ] );
        }

        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => 'any',
                'numberposts' => '-1',
                'orderby'     => 'title',
                'order'     => 'ASC',
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $args = [
                'hide_empty' => false,
                'include'    => $ids,
                'fields'     => 'all',
            ];

            $terms_result = get_terms($args);
            foreach ($terms_result as $term_item) {
                $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
            }
        }
        elseif($source_type == 'author') {
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        $results = $query_result;

        if ( !empty( $results ) ) {
            wp_send_json_success( [ 'results' => $results ] );
        } else {
            wp_send_json_error( [] );
        }
        wp_die();

    }



    /**
     * Get load more ajax posts
     */
    public function rivax_get_load_more_posts() {

        $post_id   = esc_attr($_POST['postId']);
        $widget_id = esc_attr($_POST['widgetId']);

        $data = array(
            'data'              => '',
            'no_more'           => true,
            'msg'       => __( 'No more posts found!', 'kayleen' ),
        );

        $elementor = \Elementor\Plugin::$instance;
        $elements      = $elementor->documents->get( $post_id )->get_elements_data();

        if($elements) {

            $widget_data = $this->find_element_recursive( $elements, $widget_id );

            if($widget_data) {
                $widget = $elementor->elements_manager->create_element_instance( $widget_data );
                $rendered_widget = $widget->render_ajax_posts();
                $data = array(
                    'data'          => $rendered_widget['data'],
                    'no_more'       => $rendered_widget['no_more'],
                    'msg'           => $rendered_widget['msg'],
                );
            }

        }

        wp_send_json( $data );
    }


    public function find_element_recursive( $elements, $form_id ) {

        foreach ( $elements as $element ) {
            if ( $form_id === $element['id'] ) {
                return $element;
            }

            if ( ! empty( $element['elements'] ) ) {
                $element = $this->find_element_recursive( $element['elements'], $form_id );

                if ( $element ) {
                    return $element;
                }
            }
        }

        return false;
    }


}
Rivax_Helper::get_instance();