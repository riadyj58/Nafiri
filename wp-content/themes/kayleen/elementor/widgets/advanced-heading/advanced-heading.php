<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Advanced_Heading_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-advanced-heading';
    }

    public function get_title() {
        return esc_html__('Advanced Heading', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'kayleen' ),
            ]
        );

        $this->add_control(
            'heading_one',
            [
                'label' => esc_html__( 'Text One', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Rivax Studio', 'kayleen' ),
                'placeholder' => esc_html__( 'Text One', 'kayleen' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'heading_two',
            [
                'label' => esc_html__( 'Text Two', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Creative', 'kayleen' ),
                'placeholder' => esc_html__( 'Text Two', 'kayleen' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'heading_three',
            [
                'label' => esc_html__( 'Text three', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Company', 'kayleen' ),
                'placeholder' => esc_html__( 'Text three', 'kayleen' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'show_background_text',
            [
                'label' => esc_html__( 'Background Text', 'kayleen' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'background_text',
            [
                'label' => esc_html__( 'Text', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Background', 'kayleen' ),
                'placeholder' => esc_html__( 'Background Text', 'kayleen' ),
                'condition' => [
                    'show_background_text' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'kayleen' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com/',
                'separator' => 'after',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'kayleen' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'h2',
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'kayleen' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'kayleen' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'kayleen' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'kayleen' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'kayleen' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'kayleen' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'heading_align',
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
                'toggle' => false,
                'prefix_class' => 'rivax-align-',
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-tag' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'heading_position',
            [
                'label' => esc_html__( 'Layout', 'kayleen' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'kayleen' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'kayleen' ),
                        'icon' => 'eicon-menu-bar',
                    ]
                ],
                'toggle' => false,
                'selectors_dictionary' => [
                    'inline' => 'flex-direction: row',
                    'block' => 'flex-direction: column',
                ],
                'default' => 'inline',
                'prefix_class' => 'rivax-layout-',
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-wrap' => '{{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_text_one',
            [
                'label' => esc_html__( 'Text One', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_one_padding',
            [
                'label' => esc_html__( 'Padding', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_one_spacing',
            [
                'label' => esc_html__( 'Spacing', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.rivax-layout-inline .rivax-advanced-heading-one' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.rivax-layout-block .rivax-advanced-heading-one' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'text_one_border',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-one',
            ]
        );

        $this->add_control(
            'text_one_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_one_typography',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-one',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_one_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-one',
            ]
        );

        $this->add_control(
            'text_one_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-one' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_one_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-one',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_text_two',
            [
                'label' => esc_html__( 'Text Two', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_two_padding',
            [
                'label' => esc_html__( 'Padding', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_two_spacing',
            [
                'label' => esc_html__( 'Spacing', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.rivax-layout-inline .rivax-advanced-heading-two' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.rivax-layout-block .rivax-advanced-heading-two' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'text_two_border',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-two',
            ]
        );

        $this->add_control(
            'text_two_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_two_typography',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-two',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_two_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-two',
            ]
        );

        $this->add_control(
            'text_two_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-two' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_two_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-two',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_text_three',
            [
                'label' => esc_html__( 'Text Three', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_three_padding',
            [
                'label' => esc_html__( 'Padding', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_three_spacing',
            [
                'label' => esc_html__( 'Spacing', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}}.rivax-layout-inline .rivax-advanced-heading-three' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.rivax-layout-block .rivax-advanced-heading-three' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'text_three_border',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-three',
            ]
        );

        $this->add_control(
            'text_three_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-three' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_three_typography',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-three',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_three_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-three',
            ]
        );

        $this->add_control(
            'text_three_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-three' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_three_background',
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-three',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_border',
            [
                'label' => esc_html__( 'Border', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_type',
            [
                'label' => esc_html__( 'Border Type', 'kayleen' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'kayleen' ),
                    'solid' => esc_html__( 'Solid', 'kayleen' ),
                    'double' => esc_html__( 'Double', 'kayleen' ),
                    'dotted' => esc_html__( 'Dotted', 'kayleen' ),
                    'dashed' => esc_html__( 'Dashed', 'kayleen' ),
                    'groove' => esc_html__( 'Groove', 'kayleen' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'border-bottom-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label' => esc_html__( 'Width', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_height',
            [
                'label' => esc_html__( 'Height', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'border_type!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'border_offset_toggle',
            [
                'label' => esc_html__( 'Offset', 'kayleen' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'kayleen' ),
                'label_on' => esc_html__( 'Custom', 'kayleen' ),
                'return_value' => 'yes',
                'condition' => [
                    'border_type!' => 'none',
                ],
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'border_horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -20,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'border_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'border_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-border:after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_background',
            [
                'label' => esc_html__( 'Background Text', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_background_text' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'background_text_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-wrap:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'background_text_typography',
                'selector' => '{{WRAPPER}} .rivax-advanced-heading-wrap:before',
            ]
        );

        $this->add_control(
            'background_offset_toggle',
            [
                'label' => esc_html__( 'Offset', 'kayleen' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'None', 'kayleen' ),
                'label_on' => esc_html__( 'Custom', 'kayleen' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'background_horizontal_position',
            [
                'label' => esc_html__( 'Horizontal Position', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-wrap:before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'background_vertical_position',
            [
                'label' => esc_html__( 'Vertical Position', 'kayleen' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                ],
                'condition' => [
                    'background_offset_toggle' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-advanced-heading-wrap:before' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}