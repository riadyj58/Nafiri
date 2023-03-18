<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Elementor_Sticky_Column_Extension {

    /**
     * Columns Data
     *
     * @var array
     */
    public $columns_data = array();

    /**
     * A reference to an instance of this class.
     */
    private static $instance = null;


    /**
     * Load Construct
     *
     */
    public function __construct(){

        add_action( 'elementor/element/column/section_advanced/after_section_end', array( $this, 'after_column_section_layout' ), 10, 2 );

        add_action( 'elementor/frontend/column/before_render',  array( $this, 'column_before_render' ) );

    }


    /**
     * After column_layout callback
     *
     * @param  object $obj
     * @param  array $args
     * @return void
     */
    public function after_column_section_layout( $obj, $args ) {

        $obj->start_controls_section(
            'rivax_sticky_column_sticky_section',
            array(
                'label' => __( 'Rivax Sticky', 'kayleen' ),
                'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
            )
        );

        $obj->add_control(
            'rivax_sticky_column_sticky_enable',
            array(
                'label'        => __( 'Sticky Column', 'kayleen' ),
                'type'         => Elementor\Controls_Manager::SWITCHER,
            )
        );

        $obj->add_control(
            'rivax_sticky_column_sticky_top_spacing',
            array(
                'label'   => __( 'Top Spacing', 'kayleen' ),
                'type'    => Elementor\Controls_Manager::NUMBER,
                'default' => 50,
                'min'     => 0,
                'max'     => 500,
                'step'    => 1,
                'condition' => array(
                    'rivax_sticky_column_sticky_enable!' => '',
                ),
            )
        );

        $obj->add_control(
            'rivax_sticky_column_sticky_bottom_spacing',
            array(
                'label'   => __( 'Bottom Spacing', 'kayleen' ),
                'type'    => Elementor\Controls_Manager::NUMBER,
                'default' => 50,
                'min'     => 0,
                'max'     => 500,
                'step'    => 1,
                'condition' => array(
                    'rivax_sticky_column_sticky_enable!' => '',
                ),
            )
        );

        $obj->end_controls_section();
    }

    /**
     * Before column render callback.
     *
     * @param object $element
     *
     * @return void
     */
    public function column_before_render( $element ) {
        $data     = $element->get_data();
        $type     = isset( $data['elType'] ) ? $data['elType'] : 'column';
        $settings = $data['settings'];

        if ( 'column' !== $type ) {
            return;
        }

        if ( isset( $settings['rivax_sticky_column_sticky_enable'] ) ) {

            if ( filter_var( $settings['rivax_sticky_column_sticky_enable'], FILTER_VALIDATE_BOOLEAN ) ) {

                $topSpacing = isset( $settings['rivax_sticky_column_sticky_top_spacing'] ) ? $settings['rivax_sticky_column_sticky_top_spacing'] : 50;
                $bottomSpacing = isset( $settings['rivax_sticky_column_sticky_bottom_spacing'] ) ? $settings['rivax_sticky_column_sticky_bottom_spacing'] : 50;

                $style = "--rivax-topSpacing: {$topSpacing}px; --rivax-bottomSpacing: {$bottomSpacing}px;";
                $element->add_render_attribute( '_wrapper', array(
                    'class' => 'rivax-sticky-column',
                    'style' => $style,
                ) );
            }

        }
    }

    /**
     * Returns the instance.
     *
     * @since  1.0.0
     * @access public
     * @return object
     */
    public static function get_instance() {
        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Rivax_Elementor_Sticky_Column_Extension::get_instance();
