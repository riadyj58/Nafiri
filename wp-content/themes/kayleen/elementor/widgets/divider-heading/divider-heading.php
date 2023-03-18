<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Divider_Heading_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-divider-heading';
    }

    public function get_title() {
        return esc_html__('Divider Heading', 'kayleen');
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
            'title',
            [
                'label' => esc_html__( 'Title', 'kayleen' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title', 'kayleen' ),
                'placeholder' => esc_html__( 'Title', 'kayleen' ),
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
                'selectors_dictionary' => [
                    'left' => 'justify-content: left; text-align: left;',
                    'center' => 'justify-content: center; text-align: center;',
                    'right' => 'justify-content: right; text-align: right;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading, {{WRAPPER}} .subtitle-text-wrap' => '{{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'title_url',
            [
                'label'         => esc_html__( 'Link', 'kayleen' ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__( 'https://your-link.com', 'kayleen' ),
            ]
        );

	    $this->add_control(
		    'title_icon',
		    [
			    'label' => esc_html__( 'Icon', 'kayleen' ),
			    'type' => Controls_Manager::ICONS,
		    ]
	    );

	    $this->add_control(
		    'subtitle_heading',
		    [
			    'label'     => esc_html__( 'Subtitle', 'kayleen' ),
			    'type'      => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

	    $this->add_control(
		    'subtitle',
		    [
			    'label' => esc_html__( 'Subtitle', 'kayleen' ),
			    'type' => Controls_Manager::TEXT,
			    'placeholder' => esc_html__( 'Subtitle', 'kayleen' ),
			    'dynamic' => [
				    'active' => true,
			    ]
		    ]
	    );

	    $this->add_control(
		    'subtitle_position',
		    [
			    'label' => esc_html__( 'Position', 'kayleen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'row' => [
					    'title' => esc_html__( 'Side', 'kayleen' ),
					    'icon' => 'eicon-h-align-right',
				    ],
				    'column-reverse' => [
					    'title' => esc_html__( 'Top', 'kayleen' ),
					    'icon' => 'eicon-v-align-top',
				    ],
				    'column' => [
					    'title' => esc_html__( 'Bottom', 'kayleen' ),
					    'icon' => 'eicon-v-align-bottom',
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-inner' => 'flex-direction: {{VALUE}};'
			    ]
		    ]
	    );


	    $this->add_control(
		    'subtitle_v_position',
		    [
			    'label' => esc_html__( 'Vertical Position', 'kayleen' ),
			    'type' => Controls_Manager::CHOOSE,
			    'options' => [
				    'start' => [
					    'title' => esc_html__( 'Top', 'kayleen' ),
					    'icon' => 'eicon-justify-start-v',
				    ],
				    'center' => [
					    'title' => esc_html__( 'Center', 'kayleen' ),
					    'icon' => 'eicon-justify-center-v',
				    ],
				    'baseline' => [
					    'title' => esc_html__( 'Baseline', 'kayleen' ),
					    'icon' => 'eicon-align-center-h',
				    ],
				    'end' => [
					    'title' => esc_html__( 'Bottom', 'kayleen' ),
					    'icon' => 'eicon-justify-end-v',
				    ]
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-inner' => 'align-items: {{VALUE}};'
			    ],
			    'condition' => [
				    'subtitle_position!' => ['column', 'column-reverse'],
			    ],
		    ]
	    );

	    $this->add_control(
		    'subtitle_spacing',
		    [
			    'label'     => esc_html__( 'Spacing', 'kayleen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 1,
					    'max' => 30,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-inner' => 'gap: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Title', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->add_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'kayleen' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'label' => esc_html__( 'Text Shadow', 'kayleen' ),
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading .title-inner' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'selector' => '{{WRAPPER}} .rivax-divider-heading .title-inner',
            ]
        );

        $this->end_controls_section();




	    $this->start_controls_section(
		    'section_style_title_icon',
		    [
			    'label' => esc_html__( 'Title Icon', 'kayleen' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_margin',
		    [
			    'label' => esc_html__( 'Margin', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_padding',
		    [
			    'label' => esc_html__( 'Padding', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'title_icon_border',
			    'selector' => '{{WRAPPER}} .title-text .icon',
		    ]
	    );

	    $this->add_control(
		    'title_icon_border_radius',
		    [
			    'label' => esc_html__( 'Border Radius', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );


	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'title_icon_text_shadow',
			    'label' => esc_html__( 'Text Shadow', 'kayleen' ),
			    'selector' => '{{WRAPPER}} .title-text .icon',
		    ]
	    );

	    $this->add_control(
		    'title_icon_color',
		    [
			    'label' => esc_html__( 'Color', 'kayleen' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'title_icon_background',
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .title-text .icon',
		    ]
	    );

	    $this->add_responsive_control(
		    'title_icon_font_size',
		    [
			    'label'     => esc_html__( 'Size', 'kayleen' ),
			    'type'      => Controls_Manager::SLIDER,
			    'range'     => [
				    'px' => [
					    'min' => 10,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .title-text .icon' => 'font-size: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->end_controls_section();



	    $this->start_controls_section(
		    'section_style_subtitle',
		    [
			    'label' => esc_html__( 'Subtitle', 'kayleen' ),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
			    'name' => 'subtitle_border',
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

	    $this->add_control(
		    'subtitle_border_radius',
		    [
			    'label' => esc_html__( 'Border Radius', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'subtitle_padding',
		    [
			    'label' => esc_html__( 'Padding', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .subtitle-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
			    'name' => 'subtitle_typography',
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Text_Shadow::get_type(),
		    [
			    'name' => 'subtitle_text_shadow',
			    'label' => esc_html__( 'Text Shadow', 'kayleen' ),
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

	    $this->add_control(
		    'subtitle_color',
		    [
			    'label' => esc_html__( 'Color', 'kayleen' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .subtitle-text' => 'color: {{VALUE}}',
			    ],
		    ]
	    );

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'subtitle_background',
			    'selector' => '{{WRAPPER}} .subtitle-text',
		    ]
	    );

	    $this->end_controls_section();



        $this->start_controls_section(
            'section_style_divider',
            [
                'label' => esc_html__( 'Divider', 'kayleen' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => esc_html__( 'Divider Style', 'kayleen' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1'  => esc_html__( 'Style 1', 'kayleen' ),
                    '2'  => esc_html__( 'Style 2', 'kayleen' ),
                    '3'  => esc_html__( 'Style 3', 'kayleen' ),
                    '4'  => esc_html__( 'Style 4', 'kayleen' ),
                    '5'  => esc_html__( 'Style 5', 'kayleen' ),
                    '6'  => esc_html__( 'Style 6', 'kayleen' ),
                    '7'  => esc_html__( 'Style 7', 'kayleen' ),
                    '8'  => esc_html__( 'Style 8', 'kayleen' ),
                    '9'  => esc_html__( 'Style 9', 'kayleen' ),
                    '10'  => esc_html__( 'Style 10', 'kayleen' ),
                    '11'  => esc_html__( 'Style 11', 'kayleen' ),
                    '12'  => esc_html__( 'Style 12', 'kayleen' ),
                    '13'  => esc_html__( 'Style 13', 'kayleen' ),
                    '14'  => esc_html__( 'Style 14', 'kayleen' ),
                    '15'  => esc_html__( 'Style 15', 'kayleen' ),
                    '16'  => esc_html__( 'Style 16', 'kayleen' ),
                    '17'  => esc_html__( 'Style 17', 'kayleen' ),
                    '18'  => esc_html__( 'Style 18', 'kayleen' ),
                    '19'  => esc_html__( 'Style 19', 'kayleen' ),
                    '20'  => esc_html__( 'Style 20', 'kayleen' ),
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Color', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading' => '--divider-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color_2',
            [
                'label' => esc_html__( 'Color 2', 'kayleen' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-divider-heading' => '--divider-color-2: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_height',
            [
                'label'     => esc_html__( 'Height', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'height: {{SIZE}}{{UNIT}}; border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_1_width',
            [
                'label'     => esc_html__( 'Divider 1 Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-1' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_2_width',
            [
                'label'     => esc_html__( 'Divider 2 Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-2' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_3_width',
            [
                'label'     => esc_html__( 'Divider 3 Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-3' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_4_width',
            [
                'label'     => esc_html__( 'Divider 4 Width', 'kayleen' ),
                'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-4' => 'width: {{SIZE}}{{UNIT}};',
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