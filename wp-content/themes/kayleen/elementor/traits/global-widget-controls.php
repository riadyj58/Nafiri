<?php
namespace RivaxStudio\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


trait Rivax_Global_Widget_Controls {

    protected function register_pagination_controls() {

        $this->start_controls_section( 'section_pagination', [
            'label' => esc_html__( 'Pagination', 'kayleen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout!' => 'carousel',
            ],
        ] );

        $this->add_control(
            'pagination_type',
            [
                'label'     => esc_html__( 'Pagination', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'                  => esc_html__( 'None', 'kayleen' ),
                    'numbers'               => esc_html__( 'Numbers', 'kayleen' ),
                    'prev_next'             => esc_html__( 'Previous/Next', 'kayleen' ),
                    'numbers_and_prev_next' => esc_html__( 'Numbers + Previous/Next', 'kayleen' ),
                    'load_more'             => esc_html__( 'Load More Button', 'kayleen' ),
                    'infinite_scroll'       => esc_html__( 'Infinite scroll', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'pagination_page_limit',
            [
                'label'     => esc_html__( 'Page Limit', 'kayleen' ),
                'type'      => Controls_Manager::NUMBER,
                'condition' => [
                    'pagination_type!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'pagination_numbers_shorten',
            [
                'label'     => esc_html__( 'Shorten', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => '',
                'condition' => [
                    'pagination_type' => ['numbers', 'numbers_and_prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_load_more_label',
            [
                'label'     => esc_html__( 'Button Label', 'kayleen' ),
                'default'   => esc_html__( 'Load More', 'kayleen' ),
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_prev_label',
            [
                'label'     => esc_html__( 'Previous Label', 'kayleen' ),
                'default'   => esc_html__( '&laquo; Previous', 'kayleen' ),
                'condition' => [
                    'pagination_type' => ['numbers_and_prev_next', 'prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_next_label',
            [
                'label'     => esc_html__( 'Next Label', 'kayleen' ),
                'default'   => esc_html__( 'Next &raquo;', 'kayleen' ),
                'condition' => [
                    'pagination_type' => ['numbers_and_prev_next', 'prev_next'],
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
            [
                'label'     => esc_html__( 'Alignment', 'kayleen' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'kayleen' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'kayleen' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'kayleen' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination-wrap' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_style_pagination_controls() {
        $this->start_controls_section(
            'section_pagination_style',
            [
                'label'     => esc_html__( 'Pagination', 'kayleen' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination_type!' => 'none',
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_margin_top',
            [
                'label'     => esc_html__( 'Gap between Posts & Pagination', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'load_more_button_size',
            [
                'label'     => esc_html__( 'Size', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'sm',
                'options'   => [
                    'xs' => esc_html__( 'Extra Small', 'kayleen' ),
                    'sm' => esc_html__( 'Small', 'kayleen' ),
                    'md' => esc_html__( 'Medium', 'kayleen' ),
                    'lg' => esc_html__( 'Large', 'kayleen' ),
                    'xl' => esc_html__( 'Extra Large', 'kayleen' ),
                ],
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pagination_typography',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',
            ]
        );

        $this->start_controls_tabs( 'tabs_pagination' );

        $this->start_controls_tab(
            'tab_pagination_normal',
            [
                'label'     => esc_html__( 'Normal', 'kayleen' ),
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_normal',
            [
                'label'     => esc_html__( 'Background Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'pagination_link_border_normal',
                'label'       => esc_html__( 'Border', 'kayleen' ),
                'selector'    => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',

            ]
        );

        $this->add_responsive_control(
            'pagination_link_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_link_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers, {{WRAPPER}} .rivax-posts-pagination a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_hover',
            [
                'label'     => esc_html__( 'Hover', 'kayleen' ),
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_hover',
            [
                'label'     => esc_html__( 'Background Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_color_hover',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_hover',
            [
                'label'     => esc_html__( 'Border Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow_hover',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_active',
            [
                'label'     => esc_html__( 'Active', 'kayleen' ),
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_link_bg_color_active',
            [
                'label'     => esc_html__( 'Background Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_color_active',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color_active',
            [
                'label'     => esc_html__( 'Border Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'pagination_link_box_shadow_active',
                'selector'  => '{{WRAPPER}} .rivax-posts-pagination .page-numbers.current',
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label'     => esc_html__( 'Space Between', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_item_width',
            [
                'label'     => esc_html__( 'Item Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_item_height',
            [
                'label'     => esc_html__( 'Item Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-pagination .page-numbers' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pagination_type!' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'heading_loader',
            [
                'label'     => esc_html__( 'Loader', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_control(
            'loader_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-post-load-more-loader' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->add_responsive_control(
            'loader_size',
            [
                'label'      => esc_html__( 'Size', 'kayleen' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 80,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'size' => 45,
                ],
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-post-load-more-loader' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'pagination_type' => ['load_more', 'infinite_scroll'],
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_carousel_controls() {

        $this->start_controls_section( 'section_carousel_settings', [
            'label' => esc_html__( 'Carousel Settings', 'kayleen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout' => 'carousel',
            ],
        ] );

        $this->add_control(
            'carousel_direction',
            [
                'label'       => esc_html__( 'Direction', 'kayleen' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'horizontal',
                'options'     => [
                    'horizontal' => esc_html__( 'Horizontal', 'kayleen' ),
                    'vertical'   => esc_html__( 'Vertical', 'kayleen' ),
                ],
                'render_type'    => 'template',
            ]
        );

        $this->add_responsive_control(
            'carousel_vertical_height',
            [
                'label'       => esc_html__( 'Container Height', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 1200,
                        'step' => 10
                    ],
                ],
                'default'     => [
                    'size' => 300,
                ],
                'selectors'   => [
                    '{{WRAPPER}} .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'carousel_direction' => 'vertical',
                ],
            ]
        );

        $this->add_control(
            'carousel_effect',
            [
                'label'        => esc_html__( 'Effect', 'kayleen' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'slide',
                'options'      => [
                    'slide'    => esc_html__( 'Slide', 'kayleen' ),
                    //'creative' => esc_html__( 'Creative', 'kayleen' ), // Need update swiperjs in Elementor
                    'fade'     => esc_html__( 'Fade', 'kayleen' ),
                ],
                'prefix_class' => 'rivax-carousel-effect-',
                'separator'    => 'before',
                'render_type'    => 'template',
            ]
        );

        $this->add_control(
            'carousel_creative_toggle',
            [
                'label'        => esc_html__( 'Creative Effect', 'kayleen' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition'    => [
                    'carousel_effect' => 'creative'
                ]
            ]
        );

        $this->start_popover();

        $this->start_controls_tabs(
            'carousel_creative_tabs'
        );

        $this->start_controls_tab(
            'carousel_creative_next_tab',
            [
                'label' => esc_html__( 'Next Slide', 'kayleen' ),
            ]
        );

        $this->add_control(
            'carousel_creative_next_translateX',
            [
                'label'       => esc_html__( 'Translate X (%)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 100,
                ],
                'range'       => [
                    '%' => [
                        'min'  => -180,
                        'max'  => 180,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'carousel_creative_next_translateY',
            [
                'label'       => esc_html__( 'Translate Y (px)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 0,
                ],
                'range'       => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'carousel_creative_next_translateZ',
            [
                'label'       => esc_html__( 'Translate Z (px)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 0,
                ],
                'range'       => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'carousel_creative_prev_tab',
            [
                'label' => esc_html__( 'Previews Slide', 'kayleen' ),
            ]
        );

        $this->add_control(
            'carousel_creative_prev_translateX',
            [
                'label'       => esc_html__( 'Translate X (%)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 0,
                ],
                'range'       => [
                    '%' => [
                        'min'  => -180,
                        'max'  => 180,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'carousel_creative_prev_translateY',
            [
                'label'       => esc_html__( 'Translate Y (px)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => 0,
                ],
                'range'       => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'carousel_creative_prev_translateZ',
            [
                'label'       => esc_html__( 'Translate Z (px)', 'kayleen' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size' => -100,
                ],
                'range'       => [
                    'px' => [
                        'min'  => -500,
                        'max'  => 500,
                        'step' => 10,
                    ],
                ],
                'condition'   => [
                    'carousel_creative_toggle' => 'yes'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_popover();

        $this->add_control(
            'hr_58745',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'carousel_effect' => 'creative'
                ]
            ]
        );

        $this->add_control(
            'carousel_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'kayleen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'carousel_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', 'kayleen' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'carousel_autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', 'kayleen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'carousel_slides_to_scroll',
            [
                'type'           => Controls_Manager::SELECT,
                'label'          => esc_html__( 'Slides to Scroll', 'kayleen' ),
                'default'        => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_control(
            'carousel_centered_slides',
            [
                'label'       => esc_html__( 'Center Slide', 'kayleen' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_grab_cursor',
            [
                'label' => esc_html__( 'Grab Cursor', 'kayleen' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_loop',
            [
                'label'   => esc_html__( 'Loop', 'kayleen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'carousel_auto_height',
            [
                'label'   => esc_html__( 'Auto Height', 'kayleen' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'carousel_speed',
            [
                'label'   => esc_html__( 'Animation Speed (ms)', 'kayleen' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range'   => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 5000,
                        'step' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'carousel_observer',
            [
                'label'       => esc_html__( 'Observer', 'kayleen' ),
                'description' => esc_html__( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'kayleen' ),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section( 'section_carousel_navigation', [
            'label' => esc_html__( 'Navigation', 'kayleen' ) ,
            'tab'   => Controls_Manager::TAB_CONTENT,
            'condition' => [
                'layout' => 'carousel',
            ],
        ] );

        $this->add_control(
            'carousel_arrows',
            [
                'label'     => esc_html__( 'Arrows', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_arrows_icon',
            [
                'label'     => esc_html__( 'Arrows Icon', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ri-angle-right-solid',
                'options'   => [
                    'ri-angle-right-solid'              => esc_html__( 'Style 1', 'kayleen' ),
                    'ri-angle-double-right-solid'       => esc_html__( 'Style 2', 'kayleen' ),
                    'ri-arrow-alt-circle-right'         => esc_html__( 'Style 3', 'kayleen' ),
                    'ri-arrow-circle-right-solid'       => esc_html__( 'Style 4', 'kayleen' ),
                    'ri-arrow-right-solid'              => esc_html__( 'Style 5', 'kayleen' ),
                    'ri-caret-right-solid'              => esc_html__( 'Style 6', 'kayleen' ),
                    'ri-caret-square-right'             => esc_html__( 'Style 7', 'kayleen' ),
                    'ri-chevron-right-solid'            => esc_html__( 'Style 8', 'kayleen' ),
                    'ri-long-arrow-alt-right-solid'     => esc_html__( 'Style 9', 'kayleen' ),
                    'ri-arrow-right-b'                  => esc_html__( 'Style 10', 'kayleen' ),
                    'ri-arrow-right-c'                  => esc_html__( 'Style 11', 'kayleen' ),
                    'ri-android-arrow-dropright-circle' => esc_html__( 'Style 12', 'kayleen' ),
                    'ri-chevron-right'                  => esc_html__( 'Style 13', 'kayleen' ),
                    'ri-arrow-right-a'                  => esc_html__( 'Style 14', 'kayleen' ),
                    'ri-ios-arrow-thin-right'           => esc_html__( 'Style 15', 'kayleen' ),
                    'ri-chevron-circle-right-solid'     => esc_html__( 'Style 16', 'kayleen' ),
                    'ri-ios-redo-outline'               => esc_html__( 'Style 17', 'kayleen' ),
                    'ri-android-share'                  => esc_html__( 'Style 18', 'kayleen' ),
                    'ri-arrow-right-line'               => esc_html__( 'Style 19', 'kayleen' ),
                    'ri-arrow-right-circle-line'        => esc_html__( 'Style 20', 'kayleen' ),
                    'ri-arrow-right-fill'               => esc_html__( 'Style 21', 'kayleen' ),
                    'ri-arrow-right-circle-fill'        => esc_html__( 'Style 22', 'kayleen' ),
                    'ri-arrow-right-s-line'             => esc_html__( 'Style 23', 'kayleen' ),
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_position',
            [
                'label'     => esc_html__( 'Arrows Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => [
                    'top'               => esc_html__( 'Top', 'kayleen' ),
                    'bottom'            => esc_html__( 'Bottom', 'kayleen' ),
                    'center'            => esc_html__( 'Center', 'kayleen' ),
                    'top-left'          => esc_html__( 'Top Left', 'kayleen' ),
                    'top-center'        => esc_html__( 'Top Center', 'kayleen' ),
                    'top-right'         => esc_html__( 'Top Right', 'kayleen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'kayleen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'kayleen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'kayleen' ),
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_show_on_hover',
            [
                'label'     => esc_html__( 'Show Arrows on Hover', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_hide_arrow_mobile',
            [
                'label'     => esc_html__( 'Hide Arrows on Mobile', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );


        $this->add_control(
            'carousel_pagination',
            [
                'label'     => esc_html__( 'Pagination', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'carousel_pagination_type',
            [
                'label'        => esc_html__( 'Pagination Type', 'kayleen' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'bullets',
                'options'      => [
                    'bullets'     => esc_html__( 'Bullets', 'kayleen' ),
                    'fraction' => esc_html__( 'Fraction', 'kayleen' ),
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_dynamic_bullets',
            [
                'label'     => esc_html__( 'Dynamic Bullets', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_pagination_position',
            [
                'label'     => esc_html__( 'Pagination Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'kayleen' ),
                    'top-center'        => esc_html__( 'Top Center', 'kayleen' ),
                    'top-right'         => esc_html__( 'Top Right', 'kayleen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'kayleen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'kayleen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'kayleen' ),
                    'center-left'       => esc_html__( 'Center Left', 'kayleen' ),
                    'center-right'      => esc_html__( 'Center Right', 'kayleen' ),
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->end_controls_section();


    }


    protected function register_style_carousel_controls() {

        $this->start_controls_section(
            'section_carousel_navigation_style',
            [
                'label'      => esc_html__( 'Navigation', 'kayleen' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'carousel_navigation_style_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => esc_html__( 'Navigation and Pagination are disabled from navigation setting.', 'kayleen' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'carousel_arrows' => '',
                    'carousel_pagination' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_heading',
            [
                'label'     => esc_html__( 'Arrows', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_vertical_offset',
            [
                'label'     => esc_html__( 'Arrows Vertical Offset', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_left_offset',
            [
                'label'     => esc_html__( 'Arrow Left Offset', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_right_offset',
            [
                'label'     => esc_html__( 'Arrow Right Offset', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );


        $this->start_controls_tabs( 'tabs_carousel_arrows_style' );

        $this->start_controls_tab(
            'tabs_carousel_arrows_normal',
            [
                'label'     => esc_html__( 'Normal', 'kayleen' ),
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_background',
            [
                'label'     => esc_html__( 'Background', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'carousel_arrows_border',
                'selector'  => '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next',
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-nav-prev, {{WRAPPER}} .carousel-nav-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_arrows_size',
            [
                'label'     => esc_html__( 'Size', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_carousel_arrows_hover',
            [
                'label'     => esc_html__( 'Hover', 'kayleen' ),
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_background',
            [
                'label'     => esc_html__( 'Background', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrows_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .carousel-nav-prev:hover, {{WRAPPER}} .carousel-nav-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'carousel_arrows_border_border!' => '',
                    'carousel_arrows!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'hr_847456',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'carousel_arrows!' => '',
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_control(
            'carousel_bullets_heading',
            [
                'label'     => esc_html__( 'Bullets', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'carousel_pagination_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'carousel_pagination_border',
                'selector'  => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_pagination_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .carousel-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_pagination_shadow',
                'selector' => '{{WRAPPER}} .carousel-pagination',
                'condition' => [
                    'carousel_pagination!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_carousel_bullets_style' );

        $this->start_controls_tab(
            'tabs_carousel_bullets_normal',
            [
                'label'     => esc_html__( 'Normal', 'kayleen' ),
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_bullets_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_space_between',
            [
                'label'     => esc_html__( 'Space Between', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .carousel-pagination-wrapper.type-bullets .carousel-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_width_size',
            [
                'label'     => esc_html__( 'Width(px)', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_height_size',
            [
                'label'     => esc_html__( 'Height(px)', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'kayleen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_bullets_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_carousel_bullets_active',
            [
                'label'     => esc_html__( 'Active', 'kayleen' ),
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_bullet_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_width',
            [
                'label'     => esc_html__( 'Width(px)', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_height',
            [
                'label'     => esc_html__( 'Height(px)', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_active_bullet_radius',
            [
                'label'      => esc_html__('Border Radius', 'kayleen'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'carousel_bullet_active_box_shadow',
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'bullets',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'carousel_fraction_heading',
            [
                'label'     => esc_html__( 'Fraction', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_fraction_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'carousel_active_fraction_color',
            [
                'label'     => esc_html__( 'Active Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'carousel_fraction_typography',
                'label'     => esc_html__( 'Typography', 'kayleen' ),
                'selector'  => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition' => [
                    'carousel_pagination!' => '',
                    'carousel_pagination_type' => 'fraction',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_date_controls() {

        $this->add_control(
            'show_date',
            [
                'label'     => esc_html__( 'Date', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'human_diff_time',
            [
                'label'     => esc_html__( 'Human Different Time', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'show_date' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_time',
            [
                'label'     => esc_html__( 'Show Time', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'human_diff_time' => '',
                    'show_date'       => 'yes'
                ]
            ]
        );
    }


    protected function register_terms_controls() {

        $this->add_control(
            'show_terms',
            [
                'label'     => esc_html__( 'Terms', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'terms_taxonomy',
            [
                'label'         => esc_html__( 'Term Taxonomy', 'kayleen' ),
                'description'   => esc_html__( 'Select taxonomy related to your post type.', 'kayleen' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => wp_list_pluck(get_taxonomies( ['public'=>true, 'show_ui'=>true], 'objects' ), "label", "name"),
                'condition' => [
                    'show_terms' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'term_limit',
            [
                'label'         => esc_html__( 'Max Terms', 'kayleen' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 1,
                'min'           => 1,
                'condition' => [
                    'show_terms' => 'yes'
                ]
            ]
        );
    }


    protected function register_style_terms_controls() {
        $this->start_controls_section('section_style_term',
            [
                'label' => esc_html__('Term', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_terms' => 'yes',
                ],
            ]);

        $this->add_responsive_control('term_wrapper_margin',
            [
                'label' => esc_html__('Section Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .terms-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('term_margin',
            [
                'label' => esc_html__('Item Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('term_padding',
            [
                'label' => esc_html__('Item Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_term_style');
        $this->start_controls_tab('tab_term_normal',
            [
                'label' => esc_html__('Normal', 'kayleen'),
            ]);

        $this->add_control('term_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'term_background',
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->add_control('term_multi_background',
            [
                'label'         => esc_html__( 'Multi Background', 'kayleen' ),
                'description'   => esc_html__( 'Edit terms and set color for them.', 'kayleen' ),
                'type'          => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'term_border',
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->add_responsive_control('term_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'term_shadow',
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'term_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .term-item',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_term_hover',
            [
                'label' => esc_html__('Hover', 'kayleen'),
            ]);

        $this->add_control('term_hover_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'color: {{VALUE}};',
                ],
            ]);


        $this->add_control('term_hover_background',
            [
                'label' => esc_html__('Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'background: {{VALUE}} !important;',
                ],
            ]);

        $this->add_control('term_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'term_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('term_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .term-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'term_hover_shadow',
                'selector' => '{{WRAPPER}} .term-item:hover',
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'term_hover_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .term-item:hover',
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function register_title_controls() {

        $this->add_control(
            'title_tag',
            [
                'label'     => esc_html__( 'Title HTML Tag', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'h3',
                'options'   => rivax_title_tags(),
                'separator' => 'before',
            ]
        );

    }


    protected function register_style_title_controls() {
        $this->start_controls_section('section_style_title',
            [
                'label' => esc_html__('Title', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

        $this->add_control(
            'title_hover_style',
            [
                'label'   => esc_html__( 'Hover Style', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'          => esc_html__( 'Default', 'kayleen' ),
                    'underline-fix'    => esc_html__( 'Underline Fix', 'kayleen' ),
                    'overline-fix'     => esc_html__( 'Overline Fix', 'kayleen' ),
                    'middle-fix'       => esc_html__( 'Middle Fix', 'kayleen' ),
                    'underline'        => esc_html__( 'Underline', 'kayleen' ),
                    'middle-underline' => esc_html__( 'Middle Underline', 'kayleen' ),
                    'overline'         => esc_html__( 'Overline', 'kayleen' ),
                    'middle-overline'  => esc_html__( 'Middle Overline', 'kayleen' ),
                    'underline-in-out' => esc_html__( 'Underline In Out', 'kayleen' ),
                    'middle-in-out'    => esc_html__( 'Middle In Out', 'kayleen' ),
                    'overline-in-out'  => esc_html__( 'Overline In Out', 'kayleen' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape_hover_background',
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper .title a, {{WRAPPER}} .post-wrapper .title a::after',
                'condition' => [
                    'title_hover_style!' => ['default', 'underline-fix', 'overline-fix', 'middle-fix']
                ]
            ]
        );

        $this->add_responsive_control('title_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('title_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .post-wrapper .title a',
            ]);

        $this->add_control(
            'title_grid_tiles_sm_font_size',
            [
                'label'     => esc_html__( 'Small Titles Font Size', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'rem', 'em' ],
                'range'     => [
                    'px' => [
                        'min'  => 13,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min'  => 1,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                    'em' => [
                        'min'  => 1,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => '--sm-tiles-font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout'             => 'grid',
                    'grid_tiles_layout!' => '0',
                ],
            ]
        );

        $this->add_control(
            'title_grid_tiles_sm_line_height',
            [
                'label'     => esc_html__( 'Small Titles Line Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range'     => [
                    'px' => [
                        'min'  => 13,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0.8,
                        'max'  => 4,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => '--sm-tiles-line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout'             => 'grid',
                    'grid_tiles_layout!' => '0',
                ],
            ]
        );

        $this->start_controls_tabs(
            'title_style_tabs'
        );

        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'kayleen' ),
            ]
        );

        $this->add_control('title_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_background',
            [
                'label' => esc_html__('Section Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_background',
            [
                'label' => esc_html__('Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .post-wrapper .title a',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'kayleen' ),
            ]
        );

        $this->add_control('title_hover_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a:hover' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_section_hover_background',
            [
                'label' => esc_html__('Section Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_control('title_hover_background',
            [
                'label' => esc_html__('Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .title a:hover' => 'background-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_hover_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .post-wrapper .title a:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function register_excerpt_controls() {

        $this->add_control('show_excerpt',
            [
            'label'     => esc_html__( 'Excerpt', 'kayleen' ),
            'type'      => Controls_Manager::SWITCHER,
            'separator' => 'before',
            ]
        );

        $this->add_control( 'excerpt_length',
            [
            'label'       => esc_html__( 'Excerpt Limit Characters', 'kayleen' ),
            'type'        => Controls_Manager::NUMBER,
            'default'     => 100,
            'min'         => 30,
            'step'        => 5,
            'condition'   => [
                'show_excerpt' => 'yes',
                ],
            ]
        );

    }


    protected function register_style_excerpt_controls() {

        $this->start_controls_section('section_style_excerpt',
            [
                'label' => esc_html__('Excerpt', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]);

        $this->add_control('excerpt_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .excerpt',
            ]);

        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label'      => esc_html__( 'Margin', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function register_read_more_controls() {

        $this->add_control('show_read_more',
            [
                'label'     => esc_html__( 'Read More Button', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Read More Text', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'kayleen' ),
                'placeholder' => esc_html__( 'Read More', 'kayleen' ),
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

    }


    protected function register_style_read_more_controls() {

        $this->start_controls_section(
            'section_read_more_style',
            [
                'label' => esc_html__( 'Read More', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_style',
            [
                'label'   => esc_html__( 'Button Style', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'      => esc_html__( 'Style default', 'kayleen' ),
                    '1'            => esc_html__( 'Style 1', 'kayleen' ),
                    '2'            => esc_html__( 'Style 2', 'kayleen' ),
                    '3'            => esc_html__( 'Style 3', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'     => esc_html__( 'Button Icon', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'   => [
                    'none'                              => esc_html__( 'No Icon', 'kayleen' ),
                    'ri-angle-right-solid'              => esc_html__( 'Style 1', 'kayleen' ),
                    'ri-angle-double-right-solid'       => esc_html__( 'Style 2', 'kayleen' ),
                    'ri-arrow-alt-circle-right'         => esc_html__( 'Style 3', 'kayleen' ),
                    'ri-arrow-circle-right-solid'       => esc_html__( 'Style 4', 'kayleen' ),
                    'ri-arrow-right-solid'              => esc_html__( 'Style 5', 'kayleen' ),
                    'ri-caret-right-solid'              => esc_html__( 'Style 6', 'kayleen' ),
                    'ri-caret-square-right'             => esc_html__( 'Style 7', 'kayleen' ),
                    'ri-chevron-right-solid'            => esc_html__( 'Style 8', 'kayleen' ),
                    'ri-long-arrow-alt-right-solid'     => esc_html__( 'Style 9', 'kayleen' ),
                    'ri-arrow-right-b'                  => esc_html__( 'Style 10', 'kayleen' ),
                    'ri-arrow-right-c'                  => esc_html__( 'Style 11', 'kayleen' ),
                    'ri-android-arrow-dropright-circle' => esc_html__( 'Style 12', 'kayleen' ),
                    'ri-chevron-right'                  => esc_html__( 'Style 13', 'kayleen' ),
                    'ri-arrow-right-a'                  => esc_html__( 'Style 14', 'kayleen' ),
                    'ri-ios-arrow-thin-right'           => esc_html__( 'Style 15', 'kayleen' ),
                    'ri-chevron-circle-right-solid'     => esc_html__( 'Style 16', 'kayleen' ),
                    'ri-ios-redo-outline'               => esc_html__( 'Style 17', 'kayleen' ),
                    'ri-android-share'                  => esc_html__( 'Style 18', 'kayleen' ),
                    'ri-arrow-right-line'               => esc_html__( 'Style 19', 'kayleen' ),
                    'ri-arrow-right-circle-line'        => esc_html__( 'Style 20', 'kayleen' ),
                    'ri-arrow-right-fill'               => esc_html__( 'Style 21', 'kayleen' ),
                    'ri-arrow-right-circle-fill'        => esc_html__( 'Style 22', 'kayleen' ),
                    'ri-arrow-right-s-line'             => esc_html__( 'Style 23', 'kayleen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_position',
            [
                'label' => esc_html__( 'Icon position', 'kayleen' ),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'options' => [
                    'before' => [
                        'title' => esc_html__( 'before', 'kayleen' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'after' => [
                        'title' => esc_html__( 'after', 'kayleen' ),
                        'icon' => 'eicon-h-align-left',
                    ]
                ],
                'default' => 'after',
                'condition' => [
                    'read_more_icon!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_align',
            [
                'label' => esc_html__( 'Alignment', 'kayleen' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'kayleen' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'kayleen' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'kayleen' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_margin',
            [
                'label'      => esc_html__( 'Margin', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs(
            'read_more_style_tabs'
        );

        $this->start_controls_tab(
            'read_more_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'kayleen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-read-more .read-more-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'read_more_border',
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]
        );

        $this->add_responsive_control(
            'read_more_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-read-more',
            ]);

        $this->add_control(
            'read_more_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_icon!' => 'none',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'kayleen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_hover_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-read-more:hover .read-more-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read_more_hover_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rivax-read-more:hover',
            ]
        );

        $this->add_control('read_more_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'read_more_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'read_more_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-read-more:hover',
            ]);

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_icon!' => 'none',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_responsive_control(
            'read_more_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'read_more_icon!' => 'none',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_spacing',
            [
                'label'      => esc_html__( 'Icon Spacing', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'read_more_icon!' => 'none',
                ],
            ]
        );
        

        // Style 1 Shape
        $this->add_control(
            'read_more_shape',
            [
                'label'     => esc_html__( 'Shape', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->add_control(
            'read_more_shape_position',
            [
                'label'     => esc_html__( 'shape position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'         => esc_html__( 'Left', 'kayleen' ),
                    'center'       => esc_html__( 'Center', 'kayleen' ),
                    'right'        => esc_html__( 'Right', 'kayleen' ),
                ],
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_shape_width',
            [
                'label'     => esc_html__( 'Shape Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more.style-1::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );


        $this->add_responsive_control(
            'read_more_shape_height',
            [
                'label'     => esc_html__( 'Shape Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more.style-1::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->add_control(
            'read_more_shape_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-read-more.style-1::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'read_more_shape_border',
                'selector' => '{{WRAPPER}} .rivax-read-more.style-1::before',
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_shape_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-read-more.style-1::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'read_more_style' => '1',
                ],
            ]
        );

        $this->end_controls_section();

    }
















    protected function register_post_format_icon_controls() {

        $this->add_control('show_post_format_icon',
            [
                'label'     => esc_html__( 'Post Format Icon', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

    }


    protected function register_style_post_format_icon_controls() {

        $this->start_controls_section(
            'section_post_format_icon_style',
            [
                'label' => esc_html__( 'Post Format Icon', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_post_format_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_position',
            [
                'label'     => esc_html__( 'Icon Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'top-left',
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'kayleen' ),
                    'top-center'        => esc_html__( 'Top Center', 'kayleen' ),
                    'top-right'         => esc_html__( 'Top Right', 'kayleen' ),
                    'center-center'     => esc_html__( 'Center Center', 'kayleen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_margin',
            [
                'label'      => esc_html__( 'Margin', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .post-format-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_padding',
            [
                'label'     => esc_html__( 'Padding', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 2,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_font_size',
            [
                'label'     => esc_html__( 'Icon Size', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 8,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_background',
            [
                'label'     => esc_html__( 'Background', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'post_format_icon_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-format-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_format_icon_border',
                'selector' => '{{WRAPPER}} .post-format-icon',
            ]
        );

        $this->add_responsive_control(
            'post_format_icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .post-format-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_format_icon_box_shadow',
                'selector' => '{{WRAPPER}} .post-format-icon',
            ]);


        $this->end_controls_section();

    }





}

