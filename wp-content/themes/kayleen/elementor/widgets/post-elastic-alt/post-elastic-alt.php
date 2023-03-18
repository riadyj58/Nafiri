<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Elastic_Alt_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-elastic-alt';
    }

    public function get_title() {
        return esc_html__('Post Elastic Alt', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
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
                'default'            => '2',
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
                ],
                'condition' => [
                    'layout!' => 'carousel',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function register_post_controls(){

        $this->start_controls_section(
            'section_post_settings',
            [
                'label' => esc_html__( 'Post Settings', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
                'default' => 'medium',
            ]
        );

        $this->add_responsive_control(
            'thumbnail_position',
            [
                'label' => esc_html__( 'Image Position', 'kayleen' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Left', 'kayleen' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Right', 'kayleen' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Top', 'kayleen' ),
                        'icon' => ' eicon-v-align-top',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Bottom', 'kayleen' ),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper' => 'flex-direction: {{VALUE}}'
                ],
            ]
        );
		
		$this->add_responsive_control(
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
				'separator' => 'before',
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
            'date_position',
            [
                'label'     => esc_html__( 'Date Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'top-left'          => esc_html__( 'Top Left', 'kayleen' ),
                    'top-right'         => esc_html__( 'Top Right', 'kayleen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'kayleen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'kayleen' ),
                ],
                'default'   => 'bottom-right',
                'separator' => 'before',
            ]
        );

        $this->register_title_controls();

        $this->register_terms_controls();

        $this->add_control('show_author', [
            'label' => esc_html__('Author', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'separator' => 'before',
        ]);

        $this->add_control('show_comments', [
            'label' => esc_html__('Comments', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ]);

        $this->register_excerpt_controls();

        $this->register_post_format_icon_controls();

        $this->register_read_more_controls();

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
                'label' => esc_html__('Item Padding', 'kayleen'),
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
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .post-wrapper',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .post-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_hover_box_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper:hover',
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

        $this->add_responsive_control('content_padding',
            [
                'label' => esc_html__('Padding', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_responsive_control('content_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .post-wrapper .content-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'selector' => '{{WRAPPER}} .post-wrapper .content-wrapper',
            ]);

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => esc_html__( 'Image', 'kayleen' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control('item_image_margin',
            [
                'label' => esc_html__('Margin', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .image-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_image_border',
                'selector' => '{{WRAPPER}} .image-wrapper',
            ]
        );

        $this->add_responsive_control(
            'item_image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'kayleen' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_image_width',
            [
                'label'     => esc_html__( 'Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
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
                    '{{WRAPPER}} .image-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_image_height',
            [
                'label'     => esc_html__( 'Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%', 'vw', 'vh' ],
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 600,
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
            ]
        );

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

        $this->add_control('meta_divider_color',
            [
                'label' => esc_html__('Divider Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .comments-wrapper::before' => 'background: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .meta-wrapper',
            ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style_date',
            [
                'label' => esc_html__('Date', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);


        $this->add_responsive_control('date_width',
            [
                'label' => esc_html__('Width', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .date' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('date_height',
            [
                'label' => esc_html__('Height', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .date' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('date_spacing',
            [
                'label' => esc_html__('Spacing', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .day' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('day_color',
            [
                'label' => esc_html__('Day Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .day' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_control('month_color',
            [
                'label' => esc_html__('Month Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .month' => 'color: {{VALUE}};',
                ],
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'day_typography',
                'label' => esc_html__('Day Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .day',
            ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'month_typography',
                'label' => esc_html__('Month Typography', 'kayleen'),
                'selector' => '{{WRAPPER}} .month',
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
        ?>
        <div class="author-wrapper">
            <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ; ?>">
                <i class="ri-user-3-line"></i>
                <span class="name"> <?php echo get_the_author() ; ?></span>
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


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/' . $widget_path_name . '.php';
    }

}