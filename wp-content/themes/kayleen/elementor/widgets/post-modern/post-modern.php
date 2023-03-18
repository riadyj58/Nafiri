<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Modern_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-modern';
    }

    public function get_title() {
        return esc_html__('Post Modern', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }

    public function get_script_depends() {
        //return [ 'masonry' ];
        if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
            return ['masonry'];
        }

        if ( $this->get_settings_for_display( 'layout' ) == 'masonry' ) {
            return [ 'masonry' ];
        } else {
            return [];
        }
    }


    protected function register_layout_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'grid'     => esc_html__( 'Grid', 'kayleen' ),
                    'masonry'  => esc_html__( 'Masonry', 'kayleen' ),
                    'carousel' => esc_html__( 'Carousel', 'kayleen' ),
                ],
                'default'   => 'grid',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__( 'Columns', 'kayleen' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'render_type'    => 'template',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'width: calc(100% / {{SIZE}});',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'width: calc(100% / {{SIZE}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '20',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'render_type'    => 'template',
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rivax-posts-wrapper.layout-carousel .post-item' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry' => 'margin-left: calc({{SIZE}}{{UNIT}} * -.5); margin-right: calc({{SIZE}}{{UNIT}} * -.5);',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'padding-left: calc({{SIZE}}{{UNIT}} * .5); padding-right: calc({{SIZE}}{{UNIT}} * .5);',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '20',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rivax-posts-wrapper.layout-masonry .post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function register_post_controls() {

        $this->start_controls_section(
            'section_post_settings',
            [
                'label' => esc_html__( 'Post Settings', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'align_content',
            [
                'label'     => esc_html__( 'Content Alignment', 'kayleen' ),
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .meta-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
		
		
		$this->add_control(
            'hide_last_item_on_tablet',
            [
                'label'     => esc_html__( 'Hide Last Item On Tablet', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .post-item:last-of-type' => 'display: none;',
                ],
				'condition' => [
                    'layout' => 'grid',
                ],
				'separator' => 'before',
            ]
        );	

		$this->add_control(
            'disable_image_hover_effect',
            [
                'label'     => esc_html__( 'Disable Image Hover Effect', 'kayleen' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper:hover img' => 'transform: none;',
                ],
				'separator' => 'before',
            ]
        );		

        $this->add_responsive_control(
            'image_height',
            [
                'label'     => esc_html__( 'Image Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
				'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 200,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
					'vw' => [
                        'min' => 20,
                        'max' => 100,
                    ],
					'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'exclude' => ['custom'],
            'default' => 'medium',
        ]);

        $this->add_control('image_link', [
            'label' => esc_html__('Image Link', 'kayleen'),
            'description' => esc_html__('Add link to image.', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
        ]);

        $this->register_title_controls();

        $this->add_control(
            'title_position',
            [
                'label'     => esc_html__( 'Title Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'inside'     => esc_html__( 'Inside', 'kayleen' ),
                    'outside'  => esc_html__( 'Outside', 'kayleen' ),
                ],
                'default'   => 'outside',
            ]
        );

        $this->add_control(
            'inside_content_align',
            [
                'label'     => esc_html__( 'Inside Alignment', 'kayleen' ),
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rivax-position-bottom' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->register_terms_controls();

        $this->add_control(
            'terms_position',
            [
                'label'     => esc_html__( 'Terms Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'inside'     => esc_html__( 'Inside', 'kayleen' ),
                    'outside'  => esc_html__( 'Outside', 'kayleen' ),
                ],
                'default'   => 'outside',
                'condition' => [
                    'show_terms' => 'yes',
                ],
            ]
        );

        $this->add_control('show_author', [
            'label' => esc_html__('Author', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'separator' => 'before',
        ]);

        $this->add_control('show_author_image', [
            'label' => esc_html__('Author Image', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_author' => 'yes',
            ],
        ]);

        $this->add_control('show_author_prefix_by', [
            'label' => esc_html__('Author By', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_author' => 'yes',
            ],
        ]);

        $this->register_date_controls();

        $this->add_control('show_comments', [
            'label' => esc_html__('Comments', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ]);

        $this->register_excerpt_controls();

        $this->register_post_format_icon_controls();

        $this->register_read_more_controls();

        $this->add_control('show_top_content', [
            'label' => esc_html__('Top Content', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ]);

        $this->add_control('top_content_comments', [
            'label' => esc_html__('Comments', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

        $this->add_control('top_content_views', [
            'label' => esc_html__('Views', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

        $this->add_control('top_content_reading_time', [
            'label' => esc_html__('Reading Time', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'condition' => [
                'show_top_content' => 'yes',
            ],
        ]);

        $this->end_controls_section();

    }


    protected function register_style_post_controls() {

        $this->start_controls_section('section_style_post',
            [
                'label' => esc_html__('Items', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('item_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab('tab_item_normal',
            [
                'label' => esc_html__('Normal', 'kayleen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]);

        $this->add_responsive_control('item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_item_hover',
            [
                'label' => esc_html__('Hover', 'kayleen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'item_hover_background',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper:hover',
            ]
        );

        $this->add_control('item_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('item_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_hover_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper:hover',
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section('section_style_image',
            [
            'label' => esc_html__('Image', 'kayleen'),
            'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('image_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_image_style');

        $this->start_controls_tab('tab_image_normal',
            [
            'label' => esc_html__('Normal', 'kayleen'),
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay_color',
                'label' => esc_html__('Overlay Color', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .image-wrapper::before',
            ]
        );

        $this->add_control(
            'image_overlay_opacity',
            [
                'label'     => esc_html__( 'Overlay Opacity', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
             Group_Control_Border::get_type(),
            [
            'name' => 'image_border',
            'selector' => '{{WRAPPER}} .image-wrapper',
        ]);

        $this->add_responsive_control('image_border_radius',
            [
            'label' => esc_html__('Border Radius', 'kayleen'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
            'name' => 'image_box_shadow',
            'selector' => '{{WRAPPER}} .image-wrapper',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_image_hover',
            [
            'label' => esc_html__('Hover', 'kayleen'),
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay_hover_color',
                'label' => esc_html__('Overlay Color', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .image-wrapper:hover::before',
            ]
        );

        $this->add_control(
            'image_overlay_hover_opacity',
            [
                'label'     => esc_html__( 'Overlay Opacity', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper:hover::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control('image_hover_border_color',
            [
            'label' => esc_html__('Border Color', 'kayleen'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
                'image_border_border!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} .image-wrapper:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('image_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
             Group_Control_Box_Shadow::get_type(),
             [
            'name' => 'image_hover_box_shadow',
            'selector' => '{{WRAPPER}} .image-wrapper:hover',
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('section_style_content',
            [
                'label' => esc_html__('Content', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('content_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('content_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->start_controls_tabs('tabs_content_style');

        $this->start_controls_tab('tab_content_normal',
            [
                'label' => esc_html__('Normal', 'kayleen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .content-wrapper',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .content-wrapper',
            ]);

        $this->add_responsive_control('content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .content-wrapper',
            ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_content_hover',
            [
                'label' => esc_html__('Hover', 'kayleen'),
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_background',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper:hover .content-wrapper',
            ]
        );

        $this->add_control('content_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'content_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover .content-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control('content_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper:hover .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_hover_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper:hover .content-wrapper',
            ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section('section_style_meta',
            [
            'label' => esc_html__('Meta', 'kayleen'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('meta_color',
            [
            'label' => esc_html__('Color', 'kayleen'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .meta-wrapper' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('meta_hover_color',
            [
            'label' => esc_html__('Hover Color', 'kayleen'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .author-wrapper a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'name' => 'meta_typography',
            'label' => esc_html__('Typography', 'kayleen'),
            'selector' => '{{WRAPPER}} .meta-wrapper',
        ]);

        $this->add_control(
            'meta_divider_heading',
            [
                'label'     => esc_html__( 'Divider', 'kayleen' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('meta_divider_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .date::before, {{WRAPPER}} .post-wrapper .comments-wrapper::before' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_responsive_control(
            'meta_divider_width',
            [
                'label'     => esc_html__( 'Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .date::before, {{WRAPPER}} .post-wrapper .comments-wrapper::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_divider_height',
            [
                'label'     => esc_html__( 'Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .date::before, {{WRAPPER}} .post-wrapper .comments-wrapper::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('meta_divider_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .date::before, {{WRAPPER}} .post-wrapper .comments-wrapper::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);



        $this->end_controls_section();

        $this->start_controls_section('section_style_top_content',
            [
                'label' => esc_html__('Top Content', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_top_content' => 'yes',
                ],
            ]);

        $this->add_responsive_control('top_content_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('top_content_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_control(
            'top_content_items_gap',
            [
                'label'     => esc_html__( 'Items Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'top_content_background',
                'label' => esc_html__('Background', 'kayleen'),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .top-content',
            ]
        );

        $this->add_control('top_content_color',
            [
                'label' => esc_html__('Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .top-content, .top-content a' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'top_content_border',
                'selector' => '{{WRAPPER}} .top-content',
            ]);

        $this->add_responsive_control('top_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .top-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'top_content_shadow',
                'selector' => '{{WRAPPER}} .top-content',
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'top_content_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .top-content',
            ]);

        $this->end_controls_section();

    }


    protected function register_controls() {

        $this->register_layout_controls();
        $this->register_query_builder_controls();
        $this->register_post_controls();
        $this->register_pagination_controls();
        $this->register_carousel_controls();

        $this->register_style_post_controls();
        $this->register_style_title_controls();
        $this->register_style_terms_controls();
        $this->register_style_excerpt_controls();
        $this->register_style_post_format_icon_controls();
        $this->register_style_read_more_controls();
        $this->register_style_pagination_controls();
        $this->register_style_carousel_controls();

    }


    protected function render_author() {
        if ( !$this->get_settings( 'show_author' ) ) {
            return;
        }

        $settings = $this->get_settings_for_display();
        ?>
        <div class="author-wrapper">
            <?php
            if($settings['show_author_image']) {
                echo get_avatar( get_the_author_meta( 'user_email' ), 60 );
            }

            if($settings['show_author_prefix_by']) {
                ?>
                <span class="by"><?php echo esc_html__( 'by', 'kayleen' ) ; ?></span>
                <?php
            }
            ?>
            <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ; ?>">
                <?php echo get_the_author() ; ?>
            </a>
        </div>
        <?php
    }


    protected function render_comments() {
        if ( !$this->get_settings( 'show_comments' ) ) {
            return;
        }
        $comments_count = get_comments_number();
        ?>
        <div class="comments-wrapper">
            <span>
                <?php
                if( $comments_count == 0 ) {
                    esc_html_e('No Comment', 'kayleen');
                }
                elseif ( $comments_count == 1 ) {
                    esc_html_e('One Comment', 'kayleen');
                }
                else {
                    printf( esc_html__('%d Comments', 'kayleen'), $comments_count );
                }
                ?>
            </span>
        </div>
        <?php
    }


    protected function render_top_content() {
        if ( !$this->get_settings( 'show_top_content' ) ) {
            return;
        }

        $settings = $this->get_settings_for_display();
        ?>
        <div class="top-content">
            <?php if( $settings['top_content_comments'] ): ?>
            <span class="top-comments" title="<?php esc_html_e('Comments', 'kayleen') ?>"><i class="ri-chat-1-line"></i><?php echo get_comments_number(); ?></span>
            <?php endif; ?>

            <?php if( $settings['top_content_views'] ): ?>
                <span class="top-views" title="<?php esc_html_e('Views', 'kayleen') ?>"><i class="ri-fire-line"></i><?php echo rivax_get_post_views(get_the_ID()); ?></span>
            <?php endif; ?>

            <?php if( $settings['top_content_reading_time'] ): ?>
                <span class="top-reading-time" title="<?php esc_html_e('Reading Time', 'kayleen') ?>"><i class="ri-android-time"></i><?php echo rivax_get_reading_time(); ?></span>
            <?php endif; ?>
        </div>
        <?php
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}