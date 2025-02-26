<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Moore_Shortcode') ){
    
    class Moore_Shortcode {

        public function __construct() {

            add_shortcode( 'moore-elementor-template', array( $this, 'moore_elementor_template' ) );
            
        }

        public function moore_elementor_template( $atts ){

            $atts = extract( shortcode_atts(
            array(
                'id'  => '',
            ), $atts) );

            $args = array(
                'id' => $id
                
            );

            if( did_action( 'elementor/loaded' ) ){
                return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id );    
            }
            return;

            
        }

        

    }
}



return new Moore_Shortcode();

