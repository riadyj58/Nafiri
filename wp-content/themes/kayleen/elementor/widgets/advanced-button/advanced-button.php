<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Advanced_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-advanced-button';
    }

    public function get_title() {
        return esc_html__('Advanced Button', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-button';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_advanced_button',
            [
                'label' => esc_html__( 'Advanced Button', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label'   => esc_html__( 'Button Style', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'      => esc_html__( 'Style 1', 'kayleen' ),
                    '2'      => esc_html__( 'Style 2', 'kayleen' ),
                    '3'      => esc_html__( 'Style 3', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Title', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'kayleen' ),
                'placeholder' => esc_html__( 'Type Button Title', 'kayleen' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'         => esc_html__( 'Link', 'kayleen' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'kayleen' ),
            ]
        );

        $this->add_control(
            'button_icon',
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
            'icon_position',
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
                    'button_icon!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_align',
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
                    '{{WRAPPER}} .rivax-advanced-button-wrapper' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-advanced-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'kayleen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-advanced-button .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rivax-advanced-button',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Button Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-button i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_icon!' => 'none',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'kayleen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_hover_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-advanced-button:hover .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rivax-advanced-button:hover',
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Button Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-button:hover i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'button_icon!' => 'none',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .rivax-advanced-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon!' => 'none',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__( 'Icon Spacing', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-advanced-button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_shape_style',
            [
                'label' => esc_html__( 'Shape', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_style' => '1',
                ],
            ]
        );

        $this->add_control(
            'button_shape_position',
            [
                'label'     => esc_html__( 'shape position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'left',
                'options'   => [
                    'left'         => esc_html__( 'Left', 'kayleen' ),
                    'center'       => esc_html__( 'Center', 'kayleen' ),
                    'right'        => esc_html__( 'Right', 'kayleen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_width',
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
                    '{{WRAPPER}} .rivax-advanced-button.style-1::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'shape_height',
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
                    '{{WRAPPER}} .rivax-advanced-button.style-1::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shape_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-button.style-1::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'shape_border',
                'selector' => '{{WRAPPER}} .rivax-advanced-button.style-1::before',
            ]
        );

        $this->add_responsive_control(
            'shape_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-advanced-button.style-1::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}