<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Promo_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'rivax-promo-box';
    }

    public function get_title() {
        return esc_html__('Promo Box', 'kayleen');
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

    protected function register_controls() {

        // Content Controls
        $this->start_controls_section(
            'section_promo_content',
            [
                'label' => esc_html__('Promo Content', 'kayleen'),
            ]
        );

        $this->add_control(
            'promo_image',
            [
                'label' => esc_html__('Promo Image', 'kayleen'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'promo_image_size',
                'default' => 'large',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'promo_heading',
            [
                'label' => esc_html__('Promo Heading', 'kayleen'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('I am a Promo Box', 'kayleen'),
                'placeholder' => esc_html__('Enter heading for the promo', 'kayleen'),
            ]
        );

        $this->add_control(
            'promo_content',
            [
                'label' => esc_html__('Promo Content', 'kayleen'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('This is a simple content.', 'kayleen'),
            ]
        );

        $this->add_control(
            'promo_link',
            [
                'label' => esc_html__( 'Link', 'kayleen' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'section_promo_settings',
            [
                'label' => esc_html__('Promo Effects', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'promo_effect',
            [
                'label' => esc_html__('Promo Effect', 'kayleen'),
                'type' => Controls_Manager::SELECT,
                'default' => 'effect-lily',
                'options' => [
                    'effect-lily' => esc_html__('Lily', 'kayleen'),
                    'effect-sadie' => esc_html__('Sadie', 'kayleen'),
                    'effect-layla' => esc_html__('Layla', 'kayleen'),
                    'effect-oscar' => esc_html__('Oscar', 'kayleen'),
                    'effect-marley' => esc_html__('Marley', 'kayleen'),
                    'effect-ruby' => esc_html__('Ruby', 'kayleen'),
                    'effect-roxy' => esc_html__('Roxy', 'kayleen'),
                    'effect-bubba' => esc_html__('Bubba', 'kayleen'),
                    'effect-romeo' => esc_html__('Romeo', 'kayleen'),
                    'effect-sarah' => esc_html__('Sarah', 'kayleen'),
                    'effect-chico' => esc_html__('Chico', 'kayleen'),
                    'effect-milo' => esc_html__('Milo', 'kayleen'),
                    'effect-apollo' => esc_html__('Apolo', 'kayleen'),
                    'effect-jazz' => esc_html__('Jazz', 'kayleen'),
                    'effect-ming' => esc_html__('Ming', 'kayleen'),
                    'effect-bingo' => esc_html__('Bingo', 'kayleen'),
                ],
            ]
        );

        $this->add_control(
            'promo_container_width',
            [
                'label' => esc_html__('Set max width for the container?', 'kayleen'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'promo_container_width_value',
            [
                'label' => esc_html__('Container Max Width', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 480,
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-promo-box' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'promo_container_width' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'promo_border',
                'selector' => '{{WRAPPER}} .rivax-promo-box figure',
            ]
        );

        $this->add_control(
            'promo_border_radius',
            [
                'label' => esc_html__('Border Radius', 'kayleen'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rivax-promo-box figure' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_promo_styles',
            [
                'label' => esc_html__('Colors and Typography', 'kayleen'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_control(
		    'title_heading',
		    [
			    'label' => esc_html__( 'Heading', 'kayleen' ),
			    'type' => Controls_Manager::HEADING,
		    ]
	    );

        $this->add_control(
            'promo_heading_color',
            [
                'label' => esc_html__('Promo Heading Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-promo-box figure figcaption .promo-title' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
			    'name' => 'promo_heading_background',
			    'label' => esc_html__('Background', 'kayleen'),
			    'exclude' => [ 'image' ],
			    'selector' => '{{WRAPPER}} .rivax-promo-box figure figcaption .promo-title span',
		    ]
	    );

	    $this->add_responsive_control(
		    'promo_heading_padding',
		    [
			    'label' => esc_html__( 'Padding', 'kayleen' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors' => [
				    '{{WRAPPER}} .rivax-promo-box figure figcaption .promo-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'promo_heading_border_radius',
		    [
			    'label'      => esc_html__( 'Border Radius', 'kayleen' ),
			    'type'       => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%' ],
			    'selectors'  => [
				    '{{WRAPPER}} .rivax-promo-box figure figcaption .promo-title span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'promo_title_typography',
                'selector' => '{{WRAPPER}} .rivax-promo-box figure figcaption .promo-title',
            ]
        );

	    $this->add_control(
		    'title_content',
		    [
			    'label' => esc_html__( 'Content', 'kayleen' ),
			    'type' => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

        $this->add_control(
            'promo_content_color',
            [
                'label' => esc_html__('Promo Content Color', 'kayleen'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rivax-promo-box figure p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'promo_content_typography',
                'selector' => '{{WRAPPER}} .rivax-promo-box figure p',
            ]
        );

	    $this->add_control(
		    'title_container',
		    [
			    'label' => esc_html__( 'Container', 'kayleen' ),
			    'type' => Controls_Manager::HEADING,
			    'separator' => 'before',
		    ]
	    );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'promo_overlay_color',
                'label' => esc_html__('Background', 'kayleen'),
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .rivax-promo-box figure',
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