<?php

namespace Elementor;

use RivaxStudio\Traits\Rivax_Group_Control_Query;
use RivaxStudio\Traits\Rivax_Global_Widget_Controls;
use RivaxStudio\Traits\Rivax_Post_skin_base;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Post_Stellar_Widget extends Widget_Base {

    use Rivax_Group_Control_Query;
    use Rivax_Global_Widget_Controls;
    use Rivax_Post_skin_base;

    public function get_name() {
        return 'rivax-post-stellar';
    }

    public function get_title() {
        return esc_html__('Post Stellar', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-image-rollover';
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
                'selectors' => [
                    '{{WRAPPER}} .post-item' => 'width: calc(100% / {{SIZE}});',
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
            'content_position',
            [
                'label'     => esc_html__( 'Content Position', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => [
                    'center-center'     => esc_html__( 'Center Center', 'kayleen' ),
                    'bottom-left'       => esc_html__( 'Bottom Left', 'kayleen' ),
                    'bottom-center'     => esc_html__( 'Bottom Center', 'kayleen' ),
                    'bottom-right'      => esc_html__( 'Bottom Right', 'kayleen' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label'     => esc_html__( 'Content Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units'=> [ 'px', '%' ],
                'range'     => [
					'px' => [
                        'min' => 50,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_style',
            [
                'label'     => esc_html__( 'Content Style', 'kayleen' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'style-1'     => esc_html__( 'Style 1', 'kayleen' ),
                    'style-2'     => esc_html__( 'Style 2', 'kayleen' ),
                    'style-3'     => esc_html__( 'Style 3', 'kayleen' ),
                    'style-4'     => esc_html__( 'Style 4', 'kayleen' ),
                    'style-5'     => esc_html__( 'Style 5', 'kayleen' ),
                    'style-6'     => esc_html__( 'Style 6', 'kayleen' ),
                ],
                'default'   => 'style-1',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Read More Text', 'kayleen' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'kayleen' ),
                'placeholder' => esc_html__( 'Read More', 'kayleen' ),
                'condition' => [
                    'content_style' => 'style-3',
                ],
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper-inner' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .meta-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
             'item_height',
            [
            'label'     => esc_html__( 'Item Height', 'kayleen' ),
            'type'      => Controls_Manager::SLIDER,
            'size_units'=> [ 'px', 'vw', 'vh' ],
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
                '{{WRAPPER}} .post-wrapper' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'exclude' => ['custom'],
            'default' => 'rivax-large',
			'separator' => 'before',
        ]);

        $this->register_title_controls();


        $this->register_terms_controls();

        $this->add_control('show_author', [
            'label' => esc_html__('Author', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
            'separator' => 'before',
        ]);

        $this->register_date_controls();

        $this->add_control('link_wrapper', [
            'label' => esc_html__('Item Wrapper Link', 'kayleen'),
            'description' => esc_html__('Add link to whole item.', 'kayleen'),
            'type' => Controls_Manager::SWITCHER,
            'separator' => 'before',
        ]);

        $this->end_controls_section();

    }


    protected function register_style_post_controls() {

        $this->start_controls_section('section_style_container',
            [
                'label' => esc_html__('Container', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'images_overlay_color',
                'label' => esc_html__('Overlay', 'kayleen'),
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .images-wrapper::after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .rivax-stellar-wrapper',
            ]);

        $this->add_responsive_control('container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rivax-stellar-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .rivax-stellar-wrapper',
            ]);

        $this->end_controls_section();
        
        

        $this->start_controls_section('section_style_post',
            [
            'label' => esc_html__('Items', 'kayleen'),
            'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control('content_padding',
            [
            'label' => esc_html__('Content Padding', 'kayleen'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .post-wrapper .content-wrapper-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);


        $this->add_control('item_content_background',
            [
                'label' => esc_html__('Content Background', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-wrapper-inner' => 'background: {{VALUE}};',
                ],
        ]);

        $this->add_control('read_more_text_color',
            [
                'label' => esc_html__('Read More Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .read-more' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'content_style' => 'style-3',
                ],
            ]);

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
                    '{{WRAPPER}} .post-wrapper .date::before' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .post-wrapper .date::before' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .post-wrapper .date::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('meta_divider_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .post-wrapper .date::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

        $this->end_controls_section();
    }


    protected function register_controls() {

        $this->register_layout_controls();
        $this->register_query_builder_controls();
        $this->register_post_controls();

        $this->register_style_post_controls();
        $this->register_style_title_controls();
        $this->register_style_terms_controls();

    }


    protected function render_author() {
        if ( !$this->get_settings( 'show_author' ) ) {
            return;
        }
        ?>
        <div class="author-wrapper">
			<span class="by"><?php echo esc_html__( 'by', 'kayleen' ) ; ?></span>
            <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ; ?>">
                <?php echo get_the_author() ; ?>
            </a>
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