<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Social_Icons_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-social-icons';
    }

    public function get_title() {
        return esc_html__('Social Icons', 'kayleen');
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    protected function get_html_wrapper_class() {
        return $this->get_name() . '-widget';
    }

    public function get_categories() {
        return ['rivax-elements'];
    }



    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

	    $this->add_control(
		    'icon_position',
		    [
			    'label'   => esc_html__( 'Icon Position', 'kayleen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'left',
			    'options' => [
				    'left'              => esc_html__( 'Left', 'kayleen' ),
				    'top'            => esc_html__( 'Top', 'kayleen' ),
			    ],
			    'prefix_class' => 'social-icon-',
		    ]
	    );

	    $this->add_control(
		    'subtitle_position',
		    [
			    'label'   => esc_html__( 'Subtitle Position', 'kayleen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'right',
			    'options' => [
				    'right'              => esc_html__( 'Right', 'kayleen' ),
				    'bottom'            => esc_html__( 'Bottom', 'kayleen' ),
			    ],
			    'prefix_class' => 'social-subtitle-',
		    ]
	    );

	    $this->add_control(
		    'display_type',
		    [
			    'label'   => esc_html__( 'Display', 'kayleen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'grid',
			    'options' => [
				    'grid'               => esc_html__( 'Grid', 'kayleen' ),
				    'inline'            => esc_html__( 'Inline', 'kayleen' ),
			    ],
			    'prefix_class' => 'social-layout-',
		    ]
	    );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__( 'Columns', 'kayleen' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => '2',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-social-icons' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
                'condition' => [
	                'display_type' => 'grid'
                ]
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
			    'selectors' => [
				    '{{WRAPPER}} .rivax-social-icons' => 'justify-content: {{VALUE}};',
			    ],
			    'condition' => [
				    'display_type' => 'inline'
			    ]
		    ]
	    );


        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '10',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-social-icons' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => '10',
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-social-icons' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_social_icons',
            [
                'label' => esc_html__( 'Social Icons', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

	    $this->add_control(
		    'open_link_new_tab',
		    [
			    'label'     => esc_html__( 'Open Link In New Tab', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
		    ]
	    );

	    $this->add_control(
		    'move_up_animation',
		    [
			    'label'   => esc_html__( 'Move Up Animation', 'kayleen' ),
			    'type'    => Controls_Manager::SELECT,
			    'default' => 'item',
			    'options' => [
				    'none'               => esc_html__( 'None', 'kayleen' ),
				    'icon'            => esc_html__( 'Social Icon', 'kayleen' ),
				    'item'            => esc_html__( 'Social Item', 'kayleen' ),
			    ],
			    'prefix_class' => 'social-move-up-',
		    ]
	    );


        $social_media_list = array(
			'facebook'      => esc_html__( 'Facebook', 'kayleen' ),
			'twitter'      => esc_html__( 'Twitter', 'kayleen' ),
			'linkedin'      => esc_html__( 'Linkedin', 'kayleen' ),
			'whatsapp'      => esc_html__( 'Whatsapp', 'kayleen' ),
			'instagram'      => esc_html__( 'Instagram', 'kayleen' ),
			'pinterest'      => esc_html__( 'Pinterest', 'kayleen' ),
			'dribbble'      => esc_html__( 'Dribbble', 'kayleen' ),
			'telegram'      => esc_html__( 'Telegram', 'kayleen' ),
			'youtube'      => esc_html__( 'Youtube', 'kayleen' ),
			'github'      => esc_html__( 'Github', 'kayleen' ),

        );


        $repeater = new Repeater();

        $repeater->add_control(
            'social_media',
            [
                'label'         => esc_html__( 'Social Media', 'kayleen' ),
                'description'   => esc_html__( 'Select a social media.', 'kayleen' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => $social_media_list,

            ]
        );

	    $repeater->add_control(
		    'social_link',
		    [
			    'label'      => esc_html__( 'Link', 'kayleen' ),
			    'type'       => Controls_Manager::TEXT,
			    'input_type' => 'url',
		    ]
	    );

	    $repeater->add_control(
		    'social_title',
		    [
			    'label' => esc_html__( 'Title', 'kayleen' ),
			    'type' => Controls_Manager::TEXT,
		    ]
	    );

	    $repeater->add_control(
		    'social_subtitle',
		    [
			    'label' => esc_html__( 'Sub Title', 'kayleen' ),
			    'type' => Controls_Manager::TEXT,
		    ]
	    );


        $this->add_control(
            'social_media_items',
            [
                'label' => esc_html__( 'Social Media Items', 'kayleen' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ social_media }}}',
            ]
        );


        $this->end_controls_section();




	    $this->start_controls_section('section_style_official',
		    [
			    'label' => esc_html__('Official Color', 'kayleen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]);

	    $this->add_control(
		    'official_icon_heading',
		    [
			    'label'     => esc_html__( 'Icon', 'kayleen' ),
			    'type'      => Controls_Manager::HEADING,
		    ]
	    );

	    $this->start_controls_tabs('tabs_official_icon_style');

	    $this->start_controls_tab('tab_official_icon_normal',
		    [
			    'label' => esc_html__('Normal', 'kayleen'),
		    ]);

	    $this->add_control(
		    'official_icon_color',
		    [
			    'label'     => esc_html__( 'Color', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-color-',
		    ]
	    );

	    $this->add_control(
		    'official_icon_bg',
		    [
			    'label'     => esc_html__( 'Background', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-bg-',
		    ]
	    );

	    $this->add_control(
		    'official_icon_shadow',
		    [
			    'label'     => esc_html__( 'Shadow', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-shadow-',
		    ]
	    );

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_official_icon_hover',
		    [
			    'label' => esc_html__('Hover', 'kayleen'),
		    ]);

	    $this->add_control(
		    'official_icon_hover_color',
		    [
			    'label'     => esc_html__( 'Color', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-hover-color-',
		    ]
	    );

	    $this->add_control(
		    'official_icon_hover_bg',
		    [
			    'label'     => esc_html__( 'Background', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-hover-bg-',
		    ]
	    );

	    $this->add_control(
		    'official_icon_hover_shadow',
		    [
			    'label'     => esc_html__( 'Shadow', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-icon-hover-shadow-',
		    ]
	    );


	    $this->end_controls_tab();
	    $this->end_controls_tabs();



	    $this->add_control(
		    'official_item_heading',
		    [
			    'label'     => esc_html__( 'Item', 'kayleen' ),
			    'type'      => Controls_Manager::HEADING,
		    ]
	    );

	    $this->start_controls_tabs('tabs_official_item_style');

	    $this->start_controls_tab('tab_official_item_normal',
		    [
			    'label' => esc_html__('Normal', 'kayleen'),
		    ]);

	    $this->add_control(
		    'official_item_color',
		    [
			    'label'     => esc_html__( 'Color', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-color-',
		    ]
	    );

	    $this->add_control(
		    'official_item_bg',
		    [
			    'label'     => esc_html__( 'Background', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-bg-',
		    ]
	    );

	    $this->add_control(
		    'official_item_shadow',
		    [
			    'label'     => esc_html__( 'Shadow', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-shadow-',
		    ]
	    );

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_official_item_hover',
		    [
			    'label' => esc_html__('Hover', 'kayleen'),
		    ]);

	    $this->add_control(
		    'official_item_hover_color',
		    [
			    'label'     => esc_html__( 'Color', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-hover-color-',
		    ]
	    );

	    $this->add_control(
		    'official_item_hover_bg',
		    [
			    'label'     => esc_html__( 'Background', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-hover-bg-',
		    ]
	    );

	    $this->add_control(
		    'official_item_hover_shadow',
		    [
			    'label'     => esc_html__( 'Shadow', 'kayleen' ),
			    'type'      => Controls_Manager::SWITCHER,
			    'prefix_class' => 'official-item-hover-shadow-',
		    ]
	    );


	    $this->end_controls_tab();
	    $this->end_controls_tabs();


	    $this->end_controls_section();




	    $this->start_controls_section('section_style_item',
		    [
			    'label' => esc_html__('Item', 'kayleen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control('item_padding',
		    [
			    'label' => esc_html__('Padding', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .social-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			    'label' => esc_html__('background', 'kayleen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .social-item',
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'item_border',
			    'selector' => '{{WRAPPER}} .social-item',
		    ]);

	    $this->add_responsive_control('item_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .social-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_group_control(Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'item_box_shadow',
			    'selector' => '{{WRAPPER}} .social-item',
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
			    'label' => esc_html__('background', 'kayleen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .social-item:hover',
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
				    '{{WRAPPER}} .social-item:hover' => 'border-color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'item_hover_box_shadow',
			    'selector' => '{{WRAPPER}} .social-item:hover',
		    ]);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();



	    $this->end_controls_section();



	    $this->start_controls_section('section_style_icon',
		    [
			    'label' => esc_html__('Icon', 'kayleen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control('icon_padding',
		    [
			    'label' => esc_html__('Padding', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('icon_margin',
		    [
			    'label' => esc_html__('Margin', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control(
		    'icon_size',
		    [
			    'label'     => esc_html__( 'Size', 'kayleen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 20,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'icon_width',
		    [
			    'label'     => esc_html__( 'Width', 'kayleen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 20,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );


	    $this->start_controls_tabs('tabs_icon_style');

	    $this->start_controls_tab('tab_icon_normal',
		    [
			    'label' => esc_html__('Normal', 'kayleen'),
		    ]);

	    $this->add_control('icon_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'icon_background',
			    'label' => esc_html__('background', 'kayleen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .icon',
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'icon_border',
			    'selector' => '{{WRAPPER}} .icon',
		    ]);

	    $this->add_responsive_control('icon_border_radius',
		    [
			    'label' => esc_html__('Border Radius', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px', '%'],
			    'selectors' => [
				    '{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_group_control(Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'icon_box_shadow',
			    'selector' => '{{WRAPPER}} .icon',
		    ]);

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_icon_hover',
		    [
			    'label' => esc_html__('Hover', 'kayleen'),
		    ]);

	    $this->add_control('icon_hover_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .icon' => 'color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'icon_hover_background',
			    'label' => esc_html__('background', 'kayleen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .social-item:hover .icon',
		    ]
	    );


	    $this->add_control('icon_hover_border_color',
		    [
			    'label' => esc_html__('Border Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'condition' => [
				    'icon_border_border!' => '',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .icon' => 'border-color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
			    'name' => 'icon_hover_box_shadow',
			    'selector' => '{{WRAPPER}} .social-item:hover .icon',
		    ]);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();

	    $this->end_controls_section();




	    $this->start_controls_section('section_style_title',
		    [
			    'label' => esc_html__('Title', 'kayleen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control('title_padding',
		    [
			    'label' => esc_html__('Padding', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('title_margin',
		    [
			    'label' => esc_html__('Margin', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'title_typography',
			    'label' => esc_html__('Typography', 'kayleen'),
			    'selector' => '{{WRAPPER}} .title',
		    ]);


	    $this->start_controls_tabs('tabs_title_style');

	    $this->start_controls_tab('tab_title_normal',
		    [
			    'label' => esc_html__('Normal', 'kayleen'),
		    ]);

	    $this->add_control('title_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'title_border',
			    'selector' => '{{WRAPPER}} .title',
		    ]);


	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_title_hover',
		    [
			    'label' => esc_html__('Hover', 'kayleen'),
		    ]);

	    $this->add_control('title_hover_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .title' => 'color: {{VALUE}};',
			    ],
		    ]);


	    $this->add_control('title_hover_border_color',
		    [
			    'label' => esc_html__('Border Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'condition' => [
				    'title_border_border!' => '',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .title' => 'border-color: {{VALUE}};',
			    ],
		    ]);

	    $this->end_controls_tab();
	    $this->end_controls_tabs();

	    $this->end_controls_section();


	    $this->start_controls_section('section_style_subtitle',
		    [
			    'label' => esc_html__('Subtitle', 'kayleen'),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_control('subtitle_padding',
		    [
			    'label' => esc_html__('Padding', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_control('subtitle_margin',
		    [
			    'label' => esc_html__('Margin', 'kayleen'),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => ['px'],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]);

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'subtitle_typography',
			    'label' => esc_html__('Typography', 'kayleen'),
			    'selector' => '{{WRAPPER}} .subtitle',
		    ]);


	    $this->start_controls_tabs('tabs_subtitle_style');

	    $this->start_controls_tab('tab_subtitle_normal',
		    [
			    'label' => esc_html__('Normal', 'kayleen'),
		    ]);

	    $this->add_control('subtitle_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
			    ],
		    ]);


	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'subtitle_border',
			    'selector' => '{{WRAPPER}} .subtitle',
		    ]);

	    $this->end_controls_tab();

	    $this->start_controls_tab('tab_subtitle_hover',
		    [
			    'label' => esc_html__('Hover', 'kayleen'),
		    ]);

	    $this->add_control('subtitle_hover_color',
		    [
			    'label' => esc_html__('Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .subtitle' => 'color: {{VALUE}};',
			    ],
		    ]);

	    $this->add_control('subtitle_hover_border_color',
		    [
			    'label' => esc_html__('Border Color', 'kayleen'),
			    'type' => Controls_Manager::COLOR,
			    'condition' => [
				    'subtitle_border_border!' => '',
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .social-item:hover .subtitle' => 'border-color: {{VALUE}};',
			    ],
		    ]);

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