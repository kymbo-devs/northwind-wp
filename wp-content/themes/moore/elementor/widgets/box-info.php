<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Box_Info extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_box_info';
	}

	
	public function get_title() {
		return esc_html__( 'Box Info', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-icon-box';
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
				'link_to',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none' => esc_html__( 'None', 'moore' ),
						'custom' => esc_html__( 'Custom URL', 'moore' ),
					],
					'default' => 'custom',
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
					'condition' => [
						'link_to' => 'custom',
					],
					'show_label' => false,
				]
			);

			$this->add_control(
				'class_icon',
				[
					'label' => esc_html__( 'Icon', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'flaticon-autumn', 'moore' ),
					
				]
			);
            
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'row' => 5,
					'default' => esc_html__('luxury lifestyle','moore'),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'moore' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'moore' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'moore' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'moore' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);
		$this->end_controls_section();
       
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-box-info .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-info .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-info:hover .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_title',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-info .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-info .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'color_icon',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-info .icon i' => 'color : {{VALUE}};',
					],
				]
		    );
            
			$this->add_control(
				'color_icon_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-info:hover .icon i' => 'color : {{VALUE}};',
					],
				]
			);    

			$this->add_responsive_control(
				'size_icon',
				[
					'label' => esc_html__( 'Size', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-box-info .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_info_style',
			[
				'label' => esc_html__( 'Box Info', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

			$this->add_control(
				'background_color',
					[
						'label' => esc_html__( 'Background Color', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-box-info' => 'background-color : {{VALUE}};',
						],
					]
			);
            
			$this->add_control(
				'border_color',
					[
						'label' => esc_html__( 'Border Color', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-box-info' => 'border-color : {{VALUE}};',
						],
					]
			);
			
			$this->add_control(
				'background_color_hover',
					[
						'label' => esc_html__( 'Background Color Hover', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
						'{{WRAPPER}} .ova-box-info:hover' => 'background-color : {{VALUE}};',
						],
					]
			);
			
			$this->add_control(
				'border_color_hover',
					[
						'label' => esc_html__( 'Border Color Hover', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-box-info:hover' => 'border-color : {{VALUE}};',
						],
					]
			);
			
			$this->add_responsive_control(
				'box_info_padding',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		
	}
    private function get_link_url( $settings ) {

		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return false;
		
	}
	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$title               =    $settings['title'];
		$class_icon          =    $settings['class_icon'];
		$link                =    $this->get_link_url( $settings );
		 ?>

		 <?php if ( $link ) : ?>
			<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
			<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		 <?php endif; ?>
            <div class="ova-box-info">
			    <?php if (!empty($class_icon)) : ?>
				
					<div class="icon">
						<i class="<?php echo esc_attr($class_icon)?>"></i>
					</div>

				<?php endif; ?>
				<?php if (!empty($title)) : ?>

					<h3 class="title">
						<?php echo esc_html($title) ?>
				    </h3>

				<?php endif; ?>
			</div>
		  <?php if ( $link ) : ?>
			</a>
		  <?php endif; ?>
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Box_Info() );