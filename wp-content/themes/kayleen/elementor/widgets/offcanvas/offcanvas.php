<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Offcanvas_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-offcanvas';
    }

    public function get_title() {
        return esc_html__('Offcanvas', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-kit-parts';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'kayleen'),
            ]
        );

        $this->add_control(
            'icon_section',
            [
                'label' => esc_html__( 'Icon', 'kayleen' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'icon_width',
            [
                'label' => esc_html__('Width', 'kayleen'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener' => 'width: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'icon_height',
            [
                'label' => esc_html__('Height', 'kayleen'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_text_align', [
                'label' => esc_html__('Alignment', 'kayleen'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [

                    'left' => [
                        'title' => esc_html__('Left', 'kayleen'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'kayleen'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'kayleen'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener-wrapper' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'kayleen' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_width',
            [
                'label' => esc_html__('Width', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-wrapper .offcanvas-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_template',
            [
                'label' => esc_html__( 'Content Template', 'kayleen' ),
                'type' => Controls_Manager::SELECT,
                'options' => rivax_get_templates_list(),
                'description' => sprintf(esc_html__('Go to the %s Rivax Templates %s to manage your templates.', 'kayleen'), '<a href="' . admin_url('edit.php?post_type=rivax-template') . '" target="_blank">', '</a>'),
                'default' => '0',
            ]
        );

        $this->add_control(
            'content_position', [
                'label' => esc_html__('Position', 'kayleen'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [

                    'left' => [
                        'title' => esc_html__('Left', 'kayleen'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'kayleen'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_style_section',
            [
                'label' => esc_html__( 'Content', 'kayleen' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .offcanvas-container',
            ]
        );

        $this->add_control(
            'closer_color',
            [
                'label' => esc_html__('Close Icon Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-closer::before, {{WRAPPER}} .offcanvas-closer::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control('content_padding',
            [
                'label' => esc_html__('Container Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_control(
            'icon_style_section',
            [
                'label' => esc_html__( 'Icon', 'kayleen' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'kayleen' ),
                'selector' => '{{WRAPPER}} .offcanvas-opener',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .offcanvas-opener',
            ]
        );

        $this->start_controls_tabs('icon_color_tabs');
        # Normal State Tab
        $this->start_controls_tab(
            'icon_color_tab_normal_state',
            [
                'label' => esc_html__('Normal', 'kayleen'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener .hamburger span:before, {{WRAPPER}} .offcanvas-opener .hamburger span:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label' => esc_html__('Icon Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        # Hover State Tab
        $this->start_controls_tab(
            'icon_color_tab_hover_state',
            [
                'label' => esc_html__('Hover', 'kayleen'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__('Icon Color Hover', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener:hover .hamburger span:before, {{WRAPPER}} .offcanvas-opener:hover .hamburger span:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_hover',
            [
                'label' => esc_html__('Icon Background Hover', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-opener:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}