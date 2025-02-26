<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Button_Scrolldown extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_button_scrolldown';
	}

	
	public function get_title() {
		return esc_html__( 'Button Scrolldown', 'moore' );
	}

	
	public function get_icon() {
		return ' eicon-scroll';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		return [ '' ];
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
			$this->add_control(
				'anchor_id',
				[
					'label' => esc_html__( 'Anchor Tag ID', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => '#',
					'description' => 'Id Anchor Tag target for Scroll down example #id1'
				]
			);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_scrolldown_style',
			[
				'label' => esc_html__( 'Scroll Down Btn', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'color_border_btn',
				[
					'label' => esc_html__( 'Color Border', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-button-scrolldown .scroll-btn .mouse' => 'border-color : {{VALUE}};',
					],
				]
		    ); 

			$this->add_control(
				'color_animation_span',
				[
					'label' => esc_html__( 'Color Animation', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-button-scrolldown .scroll-btn .mouse > * ' => 'background : {{VALUE}};',
					],
				]
		    );

			$this->add_responsive_control(
				'width_btn',
				[
					'label' => esc_html__( 'Width', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px','%'],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-button-scrolldown .scroll-btn .mouse' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'height_btn',
				[
					'label' => esc_html__( 'Height', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px','%'],
					'range' => [
						'px' => [
							'min' => 5,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-button-scrolldown .scroll-btn .mouse' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

        $anchor_id = $settings['anchor_id'];
		 ?>

		 <div class="ova-button-scrolldown">
			<span class="scroll-btn">
				<a href="<?php  if( $anchor_id !='') { echo esc_html( $anchor_id );} ?>">
					<span class="mouse">
					<span>
					</span>
					</span>
				</a>
			</span>
			
		 </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Button_Scrolldown() );