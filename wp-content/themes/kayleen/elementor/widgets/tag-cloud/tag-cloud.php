<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Tag_Cloud_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-tag-cloud';
    }

    public function get_title() {
        return esc_html__('Tag cloud', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-tags';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__( 'Layout', 'kayleen' ),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__( 'Columns', 'kayleen' ),
                'type'           => Controls_Manager::SELECT,
                'default'        => 'auto',
                'options'        => [
                    'auto' => 'Auto',
                    '100%' => '1',
                    '50%' => '2',
                    '33.3333%' => '3',
                    '25%' => '4',
                    '20%' => '5',
                    '16.6666%' => '6',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .rivax-tag-cloud-item-wrapper' => 'flex-basis: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud' => '--item-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_height',
            [
                'label'     => esc_html__( 'Item Height(px)', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 30,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
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
                    'space-between'  => [
                        'title' => esc_html__( 'justify', 'kayleen' ),
                        'icon'  => 'eicon-text-align-justify',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'     => esc_html__( 'Show Count', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'Query', 'kayleen' ),
            ]
        );

        $this->add_control(
            'item_limit',
            [
                'label' => esc_html__('Item Limit', 'kayleen'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'taxonomy',
            [
                'label'   => esc_html__( 'Taxonomy', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'post_tag',
                'options' => [
                    'post_tag'       => esc_html__( 'Tags', 'kayleen' ),
                    'category'  => esc_html__('Categories', 'kayleen'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order By', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'name',
                'options' => [
                    'name'       => esc_html__( 'Name', 'kayleen' ),
                    'count'  => esc_html__('Post Count', 'kayleen'),
                ],
            ]
        );



        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'kayleen' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'asc',
                'options' => [
                    'asc'  => esc_html__( 'ASC', 'kayleen' ),
                    'desc' => esc_html__( 'DESC', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'include',
            [
                'label'       => esc_html__( 'Include', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12,3,1', 'kayleen' ),
            ]
        );

        $this->add_control(
            'exclude',
            [
                'label'       => esc_html__( 'Exclude', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12,3,1', 'kayleen' ),
            ]
        );

        $this->add_control(
            'parent',
            [
                'label'       => esc_html__( 'Parent', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Tag ID: 12', 'kayleen' ),
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_style_items',
            [
                'label' => esc_html__( 'Items', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_item_style' );

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__( 'Normal', 'kayleen' ),
            ]
        );

        $this->add_control(
            'single_background',
            [
                'label'   => esc_html__( 'Single Background', 'kayleen' ),
                'type'    => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
                'exclude' => [ 'image' ],
                'condition' => [
                    'single_background' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'multiple_background',
            [
                'label'       => esc_html__( 'Multiple Background', 'kayleen' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => '#000000, #f5f5f5, #999999',
                'condition' => [
                    'single_background' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__( 'Hover', 'kayleen' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'itam_background_hover',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item:hover',
            ]
        );

        $this->add_control(
            'item_border_color_hover',
            [
                'label'     => esc_html__( 'Border Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover' => 'border-color: {{VALUE}};'
                ],
                'condition' => [
                    'item_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-item:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_category_name',
            [
                'label' => esc_html__( 'Name', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'category_name_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_name_color_hover',
            [
                'label'     => esc_html__( 'Hover Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_name_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-name',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_count',
            [
                'label' => esc_html__( 'Count', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label'     => esc_html__( 'Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_color_hover',
            [
                'label'     => esc_html__( 'Hover Color', 'kayleen' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-item:hover .rivax-tag-cloud-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'count_background',
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'count_border',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_responsive_control(
            'count_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'count_padding',
            [
                'label'      => esc_html__( 'Padding', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'count_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typography',
                'label'    => esc_html__( 'Typography', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-tag-cloud-count',
            ]
        );

        $this->add_responsive_control(
            'count_spacing',
            [
                'label'     => esc_html__( 'Spacing', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-tag-cloud-count' => 'margin-left: {{SIZE}}px;'
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