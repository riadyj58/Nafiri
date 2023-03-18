<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Current_Date_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-current-date';
    }

    public function get_title() {
        return esc_html__('Current Date', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-date';
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
            'section_content',
            [
                'label' => esc_html__('Content', 'kayleen'),
            ]
        );

        $this->add_control(
            'date_title',
            [
                'label' => esc_html__( 'Title', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'date_format',
            [
                'label' => esc_html__( 'Date Format', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'F j, Y',
            ]
        );

        $this->add_control(
            'date_format_info',
            [
                'type'      => Controls_Manager::RAW_HTML,
                'raw'       => sprintf(esc_html__('%s Date Format Documentation %s', 'kayleen'), '<a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank">', '</a>'),
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label' => esc_html__( 'Icon', 'kayleen' ),
                'type' => Controls_Manager::ICONS,
            ]
        );


        $this->add_control(
            'text_align', [
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
                    '{{WRAPPER}} .current-date-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .current-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .current-date',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'label' => esc_html__( 'Border', 'kayleen' ),
                'selector' => '{{WRAPPER}} .current-date',
            ]
        );


        $this->add_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .current-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'label' => esc_html__( 'Box Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .current-date',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__('Icon', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'date_icon[value]!' => ''
                ]
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_font_size',
            [
                'label'     => esc_html__( 'Font Size', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 8,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .icon',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => esc_html__( 'Border', 'kayleen' ),
                'selector' => '{{WRAPPER}} .icon',
            ]
        );


        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'date_title!' => ''
                ]
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .title',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'label' => esc_html__( 'Border', 'kayleen' ),
                'selector' => '{{WRAPPER}} .title',
            ]
        );


        $this->add_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .title',
            ]);

        $this->end_controls_section();



        $this->start_controls_section(
            'section_style_date',
            [
                'label' => esc_html__('Date', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'date_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'date_bg',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .date',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'date_border',
                'label' => esc_html__( 'Border', 'kayleen' ),
                'selector' => '{{WRAPPER}} .date',
            ]
        );


        $this->add_control(
            'date_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .date',
            ]);

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}