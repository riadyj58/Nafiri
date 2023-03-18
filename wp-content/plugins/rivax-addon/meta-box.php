<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Meta_Box {

    function __construct() {

        // Page Layout Aside Meta Box
        add_action( 'cmb2_admin_init', array( $this, 'page_layout_aside_meta_box' ) );

        // Post Layout Aside Meta Box
        add_action( 'cmb2_admin_init', array( $this, 'post_layout_aside_meta_box' ) );

        // Post Settings
        add_action( 'cmb2_admin_init', array( $this, 'post_meta_box' ) );

        // User Profile
        add_action( 'cmb2_admin_init', array( $this, 'user_profile_meta_box' ) );

        // User Profile
        add_action( 'cmb2_admin_init', array( $this, 'category_meta_box' ) );

    }

    // Page Layout Aside Meta Box
    function page_layout_aside_meta_box() {

        $cmb = new_cmb2_box( array(
            'id'            => 'rivax_page_layout_meta_box',
            'title'         => esc_html__('Page Layout', 'rivax-addon'),
            'object_types'  => ['page'],
            'context'       => 'side',
            'priority'      => 'high',
            'show_names'    => true,
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Header', 'rivax-addon'),
            'id'               => 'rivax_page_header',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Header Type', 'rivax-addon'),
            'id'               => 'rivax_page_header_type',
            'type'             => 'select',
            'options'          => array(
                ''          => esc_html__( 'Default', 'rivax-addon' ),
                'normal'    => esc_html__( 'Normal', 'rivax-addon' ),
                'float'     => esc_html__( 'Float', 'rivax-addon' ),
            ),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Sticky Header', 'rivax-addon'),
            'id'               => 'rivax_page_sticky_header',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Footer', 'rivax-addon'),
            'id'               => 'rivax_page_footer',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Layout', 'rivax-addon'),
            'id'               => 'rivax_page_sidebar',
            'type'             => 'select',
            'options'         => array(
                '0'       => esc_html__('Default', 'rivax-addon'),
                'left' => esc_html__('Left Sidebar', 'rivax-addon'),
                'right'        => esc_html__('Right Sidebar', 'rivax-addon'),
                'none'     => esc_html__('No Sidebar', 'rivax-addon'),
                'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'rivax-addon'),
                'elementor'     => esc_html__('Elementor Page Builder', 'rivax-addon'),
            ),
        ) );

    }


    // Post Layout Aside Meta Box
    function post_layout_aside_meta_box() {

        $cmb = new_cmb2_box( array(
            'id'            => 'rivax_post_layout_meta_box',
            'title'         => esc_html__('Page Layout', 'rivax-addon'),
            'object_types'  => ['post'],
            'context'       => 'side',
            'priority'      => 'high',
            'show_names'    => true,
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Header', 'rivax-addon'),
            'id'               => 'rivax_page_header',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Header Type', 'rivax-addon'),
            'id'               => 'rivax_page_header_type',
            'type'             => 'select',
            'options'          => array(
                ''          => esc_html__( 'Default', 'rivax-addon' ),
                'normal'    => esc_html__( 'Normal', 'rivax-addon' ),
                'float'     => esc_html__( 'Float', 'rivax-addon' ),
            ),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Sticky Header', 'rivax-addon'),
            'id'               => 'rivax_page_sticky_header',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Footer', 'rivax-addon'),
            'id'               => 'rivax_page_footer',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Layout', 'rivax-addon'),
            'id'               => 'rivax_page_sidebar',
            'type'             => 'select',
            'options'         => array(
                '0'       => esc_html__('Default', 'rivax-addon'),
                'left' => esc_html__('Left Sidebar', 'rivax-addon'),
                'right'        => esc_html__('Right Sidebar', 'rivax-addon'),
                'none'     => esc_html__('No Sidebar', 'rivax-addon'),
                'none-narrow' => esc_html__('No Sidebar + Narrow Content', 'rivax-addon'),
                'elementor'     => esc_html__('Elementor Page Builder', 'rivax-addon'),
            ),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Top Content', 'rivax-addon'),
            'id'               => 'rivax_page_top_content',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Page Bottom Content', 'rivax-addon'),
            'id'               => 'rivax_page_bottom_content',
            'type'             => 'select',
            'options'         => rivax_get_templates_list(),
        ) );

    }


    // Post Settings
    function post_meta_box() {

        $cmb = new_cmb2_box( array(
            'id'            => 'rivax_post_meta_box',
            'title'         => esc_html__('Post Hero Section Settings', 'rivax-addon'),
            'object_types'  => ['post'],
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Standard Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_standard_format',
            'type'             => 'title',
            'desc' => esc_html__('Settings for standard post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Post Hero Layout', 'rivax-addon'),
            'id'               => 'rivax_single_post_layout',
            'type'             => 'select',
            'options'         => array(
                '0'       => esc_html__('Default', 'rivax-addon'),
                '1' => esc_html__('Layout 1', 'rivax-addon'),
                '2' => esc_html__('Layout 2', 'rivax-addon'),
                '3' => esc_html__('Layout 3', 'rivax-addon'),
                '4' => esc_html__('Layout 4', 'rivax-addon'),
                '5' => esc_html__('Layout 5', 'rivax-addon'),
                '6' => esc_html__('Layout 6', 'rivax-addon'),
                '7' => esc_html__('Layout 7', 'rivax-addon'),
                '8' => esc_html__('Layout 8', 'rivax-addon'),
                '9' => esc_html__('Layout 9', 'rivax-addon'),
                '10' => esc_html__('Layout 10', 'rivax-addon'),
                '11' => esc_html__('Layout 11', 'rivax-addon'),
                '12' => esc_html__('Layout 12', 'rivax-addon'),
                '13' => esc_html__('Layout 13', 'rivax-addon'),
                '14' => esc_html__('Layout 14', 'rivax-addon'),
                '15' => esc_html__('Layout 15', 'rivax-addon'),
                '16' => esc_html__('Layout 16', 'rivax-addon'),
                '17' => esc_html__('Layout 17', 'rivax-addon'),
                '18' => esc_html__('Layout 18', 'rivax-addon'),
                '19' => esc_html__('Layout 19', 'rivax-addon'),
                '20' => esc_html__('Layout 20', 'rivax-addon'),
                '21' => esc_html__('Layout 21', 'rivax-addon'),
                '22' => esc_html__('Layout 22', 'rivax-addon'),
                '23' => esc_html__('Layout 23', 'rivax-addon'),
                '24' => esc_html__('Layout 24', 'rivax-addon'),
                '25' => esc_html__('Layout 25', 'rivax-addon'),
                '26' => esc_html__('Layout 26', 'rivax-addon'),
            ),

        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Gallery Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_gallery_format',
            'type'             => 'title',
            'desc' => esc_html__('Settings for gallery post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name' => esc_html__('Gallery Images', 'rivax-addon'),
            'id'   => 'rivax_single_gallery_images',
            'type' => 'file_list',
            'query_args' => array( 'type' => 'image' ), // Only images attachment
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Audio Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_audio_format',
            'type'             => 'title',
            'desc' => esc_html__('Settings for audio post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Audio URL', 'rivax-addon'),
            'id'               => 'rivax_single_audio_url',
            'type'             => 'text',
            'desc'        => esc_html__('From soundcloud ( Eg. https://soundcloud.com/millesimofficial/zara-larsson-uncover-j-art-madan )', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Video Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_video_format',
            'type'             => 'title',
            'desc'             => esc_html__('Settings for video post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Video URL', 'rivax-addon'),
            'id'               => 'rivax_single_video_url',
            'type'             => 'text',
            'desc'             => esc_html__('From Youtube or Vimeo ( Eg. https://www.youtube.com/watch?v=M1INNns-Vi8 )', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Link Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_link_format',
            'type'             => 'title',
            'desc'             => esc_html__('Settings for link post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Link URL', 'rivax-addon'),
            'id'               => 'rivax_single_link_url',
            'type'             => 'text',
            'desc'             => esc_html__('Eg. https://example.com', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Link Title', 'rivax-addon'),
            'id'               => 'rivax_single_link_title',
            'type'             => 'text',
            'desc'             => esc_html__('Eg. Rivax Studio', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Quote Post Format:', 'rivax-addon'),
            'id'               => 'rivax_title_quote_format',
            'type'             => 'title',
            'desc'             => esc_html__('Settings for quote post format', 'rivax-addon'),
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Quote Author', 'rivax-addon'),
            'id'               => 'rivax_single_quote_author',
            'type'             => 'text',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Quote Content', 'rivax-addon'),
            'id'               => 'rivax_single_quote_content',
            'type'             => 'textarea',
        ) );

    }


    // User Profile
    function user_profile_meta_box() {

        $cmb = new_cmb2_box( array(
            'id'            => 'rivax_user_profile_meta_box',
            'title'         => esc_html__('Avatar', 'rivax-addon'),
            'object_types'  => ['user'],
            'show_names'    => true,
            'new_user_section' => 'add-existing-user',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Extra Info From Theme', 'rivax-addon'),
            'id'               => 'rivax_user_profile_extra_info',
            'type'             => 'title',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Profile Image', 'rivax-addon'),
            'id'               => 'rivax_author_profile_image',
            'desc'             => esc_html__( 'Upload square image. 120px*120px', 'rivax-addon' ),
            'type'             => 'file',
            'query_args' => array( 'type' => 'image' ), // Only images attachment
            'preview_size' => 'thumbnail',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Email Address', 'rivax-addon'),
            'id'               => 'rivax_author_email',
            'type'             => 'text_email',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Website URL', 'rivax-addon'),
            'id'               => 'rivax_author_website',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Facebook URL', 'rivax-addon'),
            'id'               => 'rivax_author_facebook',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Twitter URL', 'rivax-addon'),
            'id'               => 'rivax_author_twitter',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Linkedin URL', 'rivax-addon'),
            'id'               => 'rivax_author_linkedin',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Whatsapp URL', 'rivax-addon'),
            'id'               => 'rivax_author_whatsapp',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Instagram URL', 'rivax-addon'),
            'id'               => 'rivax_author_instagram',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Pinterest URL', 'rivax-addon'),
            'id'               => 'rivax_author_pinterest',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Dribbble URL', 'rivax-addon'),
            'id'               => 'rivax_author_dribbble',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Telegram URL', 'rivax-addon'),
            'id'               => 'rivax_author_telegram',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Youtube URL', 'rivax-addon'),
            'id'               => 'rivax_author_youtube',
            'type'             => 'text_url',
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Github URL', 'rivax-addon'),
            'id'               => 'rivax_author_github',
            'type'             => 'text_url',
        ) );

    }


    // Category Meta Box
    function category_meta_box() {

        $cmb = new_cmb2_box( array(
            'id'            => 'rivax_category_meta_box',
            'title'         => esc_html__('Category Settings', 'rivax-addon'),
            'object_types'  => ['term'],
            'taxonomies'       => array( 'category', 'post_tag' ),
            'show_names'    => true,
            'new_term_section' => true,
        ) );

        $cmb->add_field( array(
            'name'             => esc_html__('Color', 'rivax-addon'),
            'id'               => 'rivax_term_color',
            'type'             => 'colorpicker',
        ) );

    }

}

// Call Rivax_Meta_Box
new Rivax_Meta_Box();