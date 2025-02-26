<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Heading extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_heading';
	}

	
	public function get_title() {
		return esc_html__( 'Heading', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-t-letter';
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
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'moore' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Add Your Heading', 'moore' ),
				]
			);

			$this->add_control(
				'header_size',
				[
					'label' 	=> esc_html__( 'HTML Tag', 'moore' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'h1' 	=> 'H1',
						'h2' 	=> 'H2',
						'h3' 	=> 'H3',
						'h4' 	=> 'H4',
						'h5' 	=> 'H5',
						'h6' 	=> 'H6',
						'div' 	=> 'div',
						'span' 	=> 'span',
						'p' 	=> 'p',
					],
					'default' 	=> 'h2',
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'moore' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'moore' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'moore' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'moore' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'moore' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'default' 	=> 'center',
					'selectors' => [
						'{{WRAPPER}} .ova-heading' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();
        /* Begin heading Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'moore' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'moore' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title' 	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'moore' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title:hover' 	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-heading .title',
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End heading style */
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$title 		=   $settings['title'];
	    $size		=   $settings['header_size'];

		 ?>
         <div class="ova-heading">

			<<?php echo esc_html( $size ); ?> class="title"><?php echo esc_html( $title ); ?></<?php echo esc_html( $size ); ?>>
		 	
	    </div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Heading() );