<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Creative_Link_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-creative-link';
    }

    public function get_title() {
        return esc_html__('Creative Link', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-chain-broken';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Link Content', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_style',
            [
                'label'   => esc_html__( 'Animation Style', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'julia',
                'options' => [
                    'julia'     => esc_html__( 'Julia', 'kayleen' ),
                    'hera'      => esc_html__( 'Hera', 'kayleen' ),
                    'apollo'    => esc_html__( 'Apollo', 'kayleen' ),
                    'kira'      => esc_html__( 'Kira', 'kayleen' ),
                    'steve'     => esc_html__( 'Steve', 'kayleen' ),
                    'moses'     => esc_html__( 'Moses', 'kayleen' ),
                    'io'        => esc_html__( 'Io', 'kayleen' ),
                    'kale'      => esc_html__( 'Kale', 'kayleen' ),
                    'leda'      => esc_html__( 'Leda', 'kayleen' ),
                    'ming'      => esc_html__( 'Ming', 'kayleen' ),
                    'lexi'      => esc_html__( 'Lexi', 'kayleen' ),
                    'duke'      => esc_html__( 'Duke', 'kayleen' ),
                    'dexter'    => esc_html__( 'Dexter', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'link_text',
            [
                'label'       => esc_html__( 'Title', 'kayleen' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Animated Link', 'kayleen' ),
                'placeholder' => esc_html__( 'Type Link Title', 'kayleen' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'link_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rivax-creative-link' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label'         => esc_html__( 'Link', 'kayleen' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'kayleen' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_media_style',
            [
                'label' => esc_html__( 'Link Content', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Content Box Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-creative-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Link Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-creative-link a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Link Hover Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-creative-link a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-creative-link a',
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