<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Direction_Slider extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_direction_slider';
	}

	
	public function get_title() {
		return esc_html__( 'Direction Slider', 'moore' );
	}

	
	public function get_icon() {
		return ' eicon-google-maps';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.css' );
		wp_enqueue_script( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'moore-elementor-direction-slider' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);	
			
			
			// Add Class control
			$repeater = new \Elementor\Repeater();

            $repeater->add_control(
				'direction',
				[
					'label'   => esc_html__( 'Direction', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'Apartment ', 'moore' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Choose Image', 'moore' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Direction tabs', 'moore' ),
					'type'		=> Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'direction' 		=> esc_html__('W', 'moore'),
						],
						[
							'direction' 		=> esc_html__('N', 'moore'),	
						],
						[
							'direction' 		=> esc_html__('E', 'moore'),
						],
						[
							'direction' 		=> esc_html__('S', 'moore'),
						],
					],
					'title_field' => '{{{ direction }}}',
				]
			);

		$this->end_controls_section();

        /*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'moore' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'moore' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 0,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'moore' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'moore' ),
					'default'     => 1,
				]
			);

	

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'moore' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'moore' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);


			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'moore' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => false,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'moore' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/

        /**************************** BUTTON CONTROL STYLE SECTION	 *********************/
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button Control', 'moore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'button_position_top',
				[
					'label' 		=> esc_html__( 'Top Position', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> -500,
							'max' 	=> 100,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);
			
			$this->add_control(
				'button_text_color',
				[
					'label'     => esc_html__( 'Color Direction', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots .owl-dot button' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bg',
				[
					'label'     => esc_html__( 'Background Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots .owl-dot button' => 'background-color : {{VALUE}};',
					],
				]
			);  
			
			$this->add_responsive_control(
				'button_pading',
				[
					'label'      => esc_html__( 'Padding', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots .owl-dot button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_active_pading',
				[
					'label'      => esc_html__( 'Active Padding', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots .owl-dot.active button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'border_radius_button',
				[
					'label' => esc_html__( 'Border Radius', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-direction-slider .slide-direction-slider .owl-dots .owl-dot button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$tab_item = $settings['tab_item'];

		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['rtl']				= is_rtl() ? true: false;

		 ?>
            <div class="ova-direction-slider">

				<div class="slide-direction-slider owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
					<?php if(!empty($tab_item)) : foreach ($tab_item as $items) : 
					
						$img_url 	= $items['image']['url'];
						$img_alt 	= isset( $items['image']['alt'] ) ? $items['image']['alt'] : $items['direction'];
						$direction  = $items['direction'];
						$data_dot   = "<button>" .$direction. "</button>";
						?>

							<div class="item" data-dot="<?php echo ''.$data_dot; ?> ">

								<div class="direction-slider-img">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
								</div>

							</div>	

					<?php endforeach; endif; ?>

				</div>

			</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Direction_Slider() );